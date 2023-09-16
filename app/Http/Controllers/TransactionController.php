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
        $customer = Transaction::where('user_id',auth()->user()->id)->all();
        switch (auth()->user()->type) {
        case "admin":
            return view('admin.transactions.index');
            break;
        case "rider":
            break;
        case "teller":
            return view('teller.transactions.index');
            break;
        }
    }

    public function store(Request $request)
    {
        switch (auth()->user()->type) {
        case "admin":
            return view('admin.transactions.index');
            break;
        case "rider":

            break;
        case "client":
            $request->validate([
                'order_msg' => 'required|max:255',
            ]);
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
            break;
        case "teller":
            return view('teller.transactions.index');
            break;
        }

        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
