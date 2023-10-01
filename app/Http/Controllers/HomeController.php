<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Customer,Rider,Transaction};
use App\Charts\SaleChart;
use Carbon\Carbon;

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
        $mon_now = Carbon::now()->format('Y-m');
        $current_yr = request('filter', Carbon::now()->format('Y'));
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'
        ];
        $chart = new SaleChart;
        $salesCounts = [];
        foreach ($months as $month) {
            $current_yr_month = Carbon::parse("{$current_yr}-{$month}")->format('Y-m');
            $salesCounts[] = Transaction::where('status', 'Completed')->where('updated_at','like',"%{$current_yr_month}%")
            ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
            ->value('total_sales');
        }
        $chart->dataset('Sales', 'bar', $salesCounts);
        $chart->labels($months);

        $yearMonth = \Carbon\Carbon::now()->format('Y-m');
        
        return view('adminHome', [
            'chart' => $chart,
            'customer_count' => User::where('role','client')->count(),
            'rider_count' => User::where('role','rider')->count(),
            'total_sales' => Transaction::where('status', 'Completed')->where('updated_at','like','%'.$yearMonth.'%')
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
        $yearMonth = \Carbon\Carbon::now()->subMonths(1)->format('Y-m');
        return view('tellerHome',[
            'count_transaction' => Transaction::get(),
            'customer_count' => User::where('role','client')->count(),
            'rider_count' => User::where('role','rider')->count(),
            'total_sales' => Transaction::where('status', 'Completed')->where('updated_at','like','%'.$yearMonth.'%')
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
