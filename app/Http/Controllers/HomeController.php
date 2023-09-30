<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Customer,Rider,Transaction};


class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function adminHome()
    {
        return view('adminHome', [
            'customer_count' => User::where('role','client')->count(),
            'rider_count' => User::where('role','rider')->count(),
            'total_sales' => Transaction::where('status', 'Completed')->where('updated_at','like','%'.\Carbon\Carbon::today()->format('Y-m').'%')
                            ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
                            ->value('total_sales'),
        ]);
    }

    public function riderHome()
    {
        return view('riderHome');
    }

    public function tellerHome()
    {
        return view('tellerHome',[
            'count_transaction' => Transaction::get(),
            'customer_count' => User::where('role','client')->count(),
            'rider_count' => User::where('role','rider')->count(),
            'total_sales' => Transaction::where('status', 'Completed')->where('updated_at','like','%'.\Carbon\Carbon::today()->format('Y-m').'%')
                            ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
                            ->value('total_sales'),
        ]);
    }

    public function redirectHome()
    {
        switch (auth()->user()->role) {
            case "admin":
                return redirect()->route('admin.home');
                break;
            case "client":
                return redirect()->route('client.home');
                break;
            case "rider":
                return redirect()->route('rider.home');
                break;
            case "teller":
                return redirect()->route('teller.home');
                break;
        }
    }
}
