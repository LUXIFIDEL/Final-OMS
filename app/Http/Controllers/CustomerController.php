<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Rider,Transaction,Customer};

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        switch (auth()->user()->role) {
        case "admin":
            return view('admin.customers.index');
            break;
        case "teller":
            return view('teller.customers.index');
            break;
        }
    }

    public function show($id)
    {
        switch (auth()->user()->role) {
        case "admin":
            return view('admin.customers.show',[
                'get_rider' => Rider::with('user')->get(),
                'get_transaction' => Transaction::orderBy('id', 'DESC')->get(),
                'get_count_rider' => Transaction::where('updated_at', 'LIKE', \Carbon\Carbon::now()->format('Y-m-d') . '%')->get(),
                'get_user' => User::findOrFail($id),
                'get_customer' => Customer::get(),
            ]);
            break;
        case "teller":
            return view('teller.customers.show',[
                'get_rider' => Rider::with('user')->get(),
                'get_transaction' => Transaction::orderBy('id', 'DESC')->get(),
                'get_count_rider' => Transaction::where('updated_at', 'LIKE', \Carbon\Carbon::now()->format('Y-m-d') . '%')->get(),
                'get_user' => User::findOrFail($id),
                'get_customer' => Customer::get(),
            ]);
            break;
        }
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('message','Successfully Deleted!');
    }
    
}
