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
                'get_transaction' => Transaction::orderBy('id', 'DESC')->get(),
                'get_count_rider' => Transaction::where('updated_at', 'LIKE', \Carbon\Carbon::now()->format('Y-m-d') . '%')->get(),
                'get_user' => User::get(),
                'get_customer' => Customer::get(),
            ]);
        case "client":
            return view('customer.orderstatus',[
                'get_rider' => Rider::with('user')->get(),
                'get_customer' => Customer::where('user_id',auth()->user()->id)->first(),
                'get_transaction' => Transaction::where('user_id',auth()->user()->id)->get(),
            ]);
            break;
        case "rider":
            return view('riders.oderstatus',[
                'get_rider' => Rider::with('user')->get(),
                'get_transaction' => Transaction::orderBy('id', 'DESC')->get(),
                'get_user' => User::get(),
                'get_customer' => Customer::get(),
            ]);
            break;
        case "teller":
            return view('teller.transactions.index',[
                'get_rider' => Rider::with('user')->get(),
                'get_transaction' => Transaction::orderBy('id', 'DESC')->get(),
                'get_count_rider' => Transaction::where('updated_at', 'LIKE', \Carbon\Carbon::now()->format('Y-m-d') . '%')->get(),
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
            $request->validate([
                'user_id' => 'required|max:255',
                'order_msg' => 'required|max:255',
                'rider' => 'required|max:255',
                'amount' => 'nullable|numeric|min:0',
                'delivery_fee' => 'required|numeric|min:0',
            ]);
            $already_transac = Transaction::where('user_id',$request->user_id)->where('status','Pending')->first();
            if(!$already_transac){
                $now = Carbon::now();
                $datePart = $now->format('Ymd');
                $timePart = $now->format('His');
                $gentransno = $datePart . $timePart;

                $notification = new \MBarlow\Megaphone\Types\Important(
                    'Transaction Approved!',
                    'Your order is currently being processed and has been assigned to rider '.$riderName.'! Transaction no.:'.$gentransno,
                    '',
                    ''
                );
                $user = \App\Models\User::find($request->user_id);
                $user->notify($notification);
                
                Transaction::create([
                    'trans_no' => $gentransno,
                    'user_id' => $request->user_id,
                    'rider_id' => $request->rider,
                    'order' => $request->order_msg,
                    'prin_amount' => $request->amount,
                    'delivery_fee' => $request->delivery_fee,
                    'status' => 'Inprocess',
                ]);

                $riderName = User::join('riders', 'users.id', '=', 'riders.user_id')
                ->where('riders.user_id', $request->rider)
                ->value('users.name');
              

                return redirect()->back()->with('message','Successfully added to inprocess status!');
            }
            return redirect()->back()->with('error','This user has pending transaction. Please check in pending status!');
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
                'user_id' => 'required|max:255',
                'order_msg' => 'required|max:255',
                'rider' => 'required|max:255',
                'amount' => 'nullable|numeric|min:0',
                'delivery_fee' => 'required|numeric|min:0',
            ]);
            $already_transac = Transaction::where('user_id',$request->user_id)->where('status','Pending')->first();
            if(!$already_transac){
                $now = Carbon::now();
                $datePart = $now->format('Ymd');
                $timePart = $now->format('His');
                $gentransno = $datePart . $timePart;

                $notification = new \MBarlow\Megaphone\Types\Important(
                    'Transaction Approved!',
                    'Your order is currently being processed and has been assigned to rider '.$riderName.'! Transaction no.:'.$gentransno,
                    '',
                    ''
                );
                $user = \App\Models\User::find($request->user_id);
                $user->notify($notification);
                
                Transaction::create([
                    'trans_no' => $gentransno,
                    'user_id' => $request->user_id,
                    'rider_id' => $request->rider,
                    'order' => $request->order_msg,
                    'prin_amount' => $request->amount,
                    'delivery_fee' => $request->delivery_fee,
                    'status' => 'Inprocess',
                ]);

                $riderName = User::join('riders', 'users.id', '=', 'riders.user_id')
                ->where('riders.user_id', $request->rider)
                ->value('users.name');
               
                return redirect()->back()->with('message','Successfully added to inprocess status!');
            }
            return redirect()->back()->with('error','This user has pending transaction. Please check in pending status!');
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

        $riderName = User::join('riders', 'users.id', '=', 'riders.user_id')
        ->where('riders.user_id', $gentransno->rider)
        ->value('users.name');
        $notification = new \MBarlow\Megaphone\Types\Important(
            'Transaction Cancelled!',
            'Your order has been cancelled! Transaction no.:'.$gentransno,
            '',
            ''
        );
        $user = \App\Models\User::find($gentransno->user_id);
        $user->notify($notification);

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

        $riderName = User::join('riders', 'users.id', '=', 'riders.user_id')
        ->where('riders.user_id', $gentransno->rider)
        ->value('users.name');
        $notification = new \MBarlow\Megaphone\Types\Important(
            'Transaction Completed!',
            'Your order has been successfully delivered by '.$riderName.'! We appreciate your order. Transaction no.:'.$gentransno->trans_no,
            '',
            ''
        );
        $user = \App\Models\User::find($gentransno->user_id);
        $user->notify($notification);
        if(auth()->user()->role == 'rider'){
            return redirect()
                    ->back()
                    ->with('success','Successfully Completed!');
        }else{
            return redirect()
                    ->route('teller.transaction.index',['status_active' => 'completed'])
                    ->with('message','Successfully Completed!');
        }
      
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
                    'get_transaction' => Transaction::orderBy('id', 'DESC')->get(),
                    'get_count_rider' => Transaction::where('updated_at', 'LIKE', \Carbon\Carbon::now()->format('Y-m-d') . '%')->get(),
                    'get_user' => User::get(),
                    'get_customer' => Customer::get(),
                ]);
                break;
            case "teller":
                return view('teller.transactions.edit',[
                    'gen_trans_select' => $gen_trans_select,
                    'get_rider' => Rider::with('user')->get(),
                    'get_transaction' => Transaction::orderBy('id', 'DESC')->get(),
                    'get_count_rider' => Transaction::where('updated_at', 'LIKE', \Carbon\Carbon::now()->format('Y-m-d') . '%')->get(),
                    'get_user' => User::get(),
                    'get_customer' => Customer::get(),
                ]);
                break;
            }
    }

    public function update(Request $request, $id) # para sa Inprocess
    {
        $request->validate([
            'rider' => 'required|max:255',
            'order' => 'required|max:255',
            'amount' => 'nullable|numeric|min:0',
            'delivery_fee' => 'required|numeric|min:0',
        ]);
        $gentransno = Transaction::findOrFail($id);
        $gentransno->update([
            'rider_id' => $request->rider,
            'order' => $request->order,
            'prin_amount' => $request->amount,
            'delivery_fee' => $request->delivery_fee,
            'status' => 'Inprocess',
        ]);

        $riderName = User::join('riders', 'users.id', '=', 'riders.user_id')
        ->where('riders.user_id', $request->rider)
        ->value('users.name');
        $notification = new \MBarlow\Megaphone\Types\Important(
            'Transaction Approved!',
            'Your order is currently being processed and has been assigned to rider '.$riderName.'! Transaction no.:'.$gentransno->trans_no,
            '',
            ''
        );
        $user = \App\Models\User::find($gentransno->user_id);
        $user->notify($notification);

        switch (auth()->user()->role) {
            case "admin":
                return redirect()
                        ->route('admin.transaction.index',['status_active' => 'inprocess'])
                        ->with('message','Successfully Approved!');
                break;

            case "teller":
                return redirect()
                        ->route('teller.transaction.index',['status_active' => 'inprocess'])
                        ->with('message','Successfully Approved!');
                break;
            }
    }

    public function transactionSubmitFeedBack(Request $request){
        $request->validate([
            'id' => 'required',
            'feedback_msg' => 'required|max:255',
        ]);
        $gentransno = Transaction::findOrFail($request->id);
        $gentransno->update([
            'feedback_msg' => $request->feedback_msg,
        ]);
        return redirect()->back()->with('message','Successfully Cancelled!');
        
    }

    public function transactionFeedBackList(){
        return view('customer.feedback',[
            'get_feedback' => Transaction::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get(),
            'get_rider' => Rider::with('user')->get(),
            'get_customer' => Customer::where('user_id',auth()->user()->id)->first(),
            'get_transaction' => Transaction::where('user_id',auth()->user()->id)->get(),
        ]);
    }
}
