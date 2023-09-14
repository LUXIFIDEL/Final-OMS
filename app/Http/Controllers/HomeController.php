<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rider;


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
            'customer_count' => User::where('type','client')->count(),
            'rider_count' => User::where('type','rider')->count(),
        ]);
    }

    public function riderHome()
    {
        return view('riders.home');
    }

    public function tellerHome()
    {
        return view('tellerHome');
    }

    public function redirectHome()
    {
        switch (auth()->user()->type) {
            case "admin":
                return redirect()->route('admin.home');
                break;
            case "client":
                return redirect()->route('client.home');
                break;
            case "rider":
                return redirect()->route('riders.home');
                break;
            case "teller":
                return redirect()->route('teller.home');
                break;
        }
    }
}
