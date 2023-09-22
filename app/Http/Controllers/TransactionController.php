<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Customer,Rider,Transaction};
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        switch (auth()->user()->role) {
        case "admin":
            return view('admin.transactions.index',[
                'get_rider' => Rider::with('user')->get(),
                'get_transaction' => Transaction::with('assign_rider_transaction')->orderBy('id', 'DESC')->get(),
                'get_user' => User::get(),
                'get_customer' => Customer::get(),
            ]);
        case "client":
            return view('customer.orderstatus',[
                'get_customer' => Customer::where('user_id',auth()->user()->id)->first(),
                'get_transaction' => Transaction::where('user_id',auth()->user()->id)->get(),
            ]);
            break;
        case "rider":
            return view('riders.oderstatus',[
                'get_rider' => Rider::with('user')->findOrFail(auth()->user()->id),
                'get_transaction' => Transaction::with('assign_rider_transaction')->orderBy('id', 'DESC')->get(),
                'get_user' => User::get(),
                'get_customer' => Customer::get(),
            ]);
            break;
        case "teller":
            return view('teller.transactions.index',[
                'get_rider' => Rider::with('user')->get(),
                'get_transaction' => Transaction::with('assign_rider_transaction')->orderBy('id', 'DESC')->get(),
                'get_user' => User::get(),
                'get_customer' => Customer::get(),
            ]);
            break;
        }
    }

    public function store(Request $request)
    {
        switch (auth()->user()->role) {
        case "admin":
            return view('admin.transactions.index');
            break;
        case "rider":

            break;
        case "client":
            $request->validate([
                'order_msg' => 'required|max:255',
            ]);

            $already_transac = Transaction::where('user_id',auth()->user()->id)->where('status','Pending')->first();
            if(!$already_transac){
                $now = Carbon::now();
                $datePart = $now->format('Ymd');
                $timePart = $now->format('His');
                $gentransno = $datePart . $timePart;
                Transaction::create([
                    'trans_no' => $gentransno,
                    'user_id' => auth()->user()->id,
                    'order' => $request->order_msg,
                ]);
                return redirect()->route('client.msg',['transno'=>$gentransno,'str'=>'success']);
            }
            return redirect()->route('client.msg',['transno'=>$already_transac->trans_no,'str'=>'error']);
            
            break;
        case "teller":
            $request->validate([
                'order_msg' => 'required|max:255',
            ]);

            $already_transac = Transaction::where('user_id',auth()->user()->id)->where('status','Pending')->first();
            if(!$already_transac){
                $now = Carbon::now();
                $datePart = $now->format('Ymd');
                $timePart = $now->format('His');
                $gentransno = $datePart . $timePart;
                Transaction::create([
                    'trans_no' => $gentransno,
                    'user_id' => auth()->user()->id,
                    'order' => $request->order_msg,
                ]);
                return redirect()->route('client.msg',['transno'=>$gentransno,'str'=>'success']);
            }
            return redirect()->back()->with('message','Successfully added to Inprocess!');
            break;
        }

    }

    public function changeCancelledStatus(Request $request){
        $request->validate([
            'id' => 'required',
            'reason' => 'required|max:255',
        ]);
        $gentransno = Transaction::findOrFail($request->id);
        $gentransno->update([
            'status' => 'Cancelled',
            'reason' => $request->reason,
        ]);
        return redirect()->back()->with('message','Successfully Cancelled!');

    }

    public function changeCompletedStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $gentransno = Transaction::findOrFail($request->id);
        $gentransno->update([
            'status' => 'Completed',
        ]);
        return redirect()
                ->route('teller.transaction.index',['status_active' => 'completed'])
                ->with('message','Successfully Completed!');
    }

    public function create() 
    {
        return view('customer.transactionform');
    }

    public function edit($id)
    {
        
        $gen_trans_select = Transaction::with('user')->findOrFail($id);
        switch (auth()->user()->role) {
            case "admin":
                return view('admin.transactions.edit',[
                    'gen_trans_select' => $gen_trans_select,
                    'get_rider' => Rider::with('user')->get(),
                    'get_transaction' => Transaction::with('assign_rider_transaction')->orderBy('id', 'DESC')->get(),
                    'get_user' => User::get(),
                    'get_customer' => Customer::get(),
                ]);
                break;
            case "teller":
                return view('teller.transactions.edit',[
                    'gen_trans_select' => $gen_trans_select,
                    'get_rider' => Rider::with('user')->get(),
                    'get_transaction' => Transaction::with('assign_rider_transaction')->orderBy('id', 'DESC')->get(),
                    'get_user' => User::get(),
                    'get_customer' => Customer::get(),
                ]);
                break;
            }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rider' => 'required|max:255',
            'order' => 'required|max:255',
            'amount' => 'nullable|max:255',
            'delivery_fee' => 'required|max:255',
        ]);

        $gentransno = Transaction::findOrFail($id);
        $gentransno->update([
            'order' => $request->order,
            'prin_amount' => $request->amount,
            'delivery_fee' => $request->delivery_fee,
            'status' => 'Inprocess',
        ]);
        $gentransno->assign_rider_transaction()->create([
            'riders_id' => $request->rider,
        ]);
        switch (auth()->user()->role) {
            case "admin":
                return redirect()
                        ->route('admin.transaction.index',['status_active' => 'inprocess'])
                        ->with('message','Successfully Approved!');

            case "teller":
                return redirect()
                        ->route('teller.transaction.index',['status_active' => 'inprocess'])
                        ->with('message','Successfully Approved!');
                break;
            }
    }

    public function destroy($id)
    {
        //
    }
}
