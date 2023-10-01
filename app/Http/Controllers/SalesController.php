<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Customer,Rider,Transaction};
use App\Charts\SaleChart;
use Carbon\Carbon;
use DB;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (auth()->user()->role) {
            case "admin":
                $inputFilter = request('filter');

                if($inputFilter == 'last_30_days'){

                    $endDate = Carbon::now();
                    $startDate = $endDate->copy()->subDays(29);
            
                    $days = [];
                    $salesCounts = [];
            
                    $currentDate = $startDate;
                    while ($currentDate <= $endDate) {
                        $formattedDate = $currentDate->format('Y-m-d');
                        
                        $totalSales = DB::table('transactions')
                            ->where('status', 'Completed')
                            ->whereDate('updated_at', $formattedDate)
                            ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
                            ->value('total_sales') ?? 0;
            
                        $days[] = $currentDate->format('M d');
                        $salesCounts[] = $totalSales;
            
                        $currentDate->addDay();
                    }
            
                    $chart = new SaleChart;
                    $chart->dataset('Sales', 'bar', $salesCounts);
                    $chart->labels($days);

                }elseif($inputFilter == 'this_mo'){
                    $currentMonth = Carbon::now();

                    $totalSales = DB::table('transactions')
                        ->where('status', 'Completed')
                        ->whereYear('updated_at', $currentMonth->year)
                        ->whereMonth('updated_at', $currentMonth->month)
                        ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
                        ->value('total_sales') ?? 0;

                    $chart = new SaleChart;
                    $chart->dataset('Sales', 'bar', [$totalSales]);
                    $chart->labels([$currentMonth->format('M')]);

                }elseif($inputFilter == 'last_mo'){
                    $previousMonth = Carbon::now()->subMonth();

                    $totalSales = DB::table('transactions')
                        ->where('status', 'Completed')
                        ->whereYear('updated_at', $previousMonth->year)
                        ->whereMonth('updated_at', $previousMonth->month)
                        ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
                        ->value('total_sales') ?? 0;

                    $chart = new SaleChart;
                    $chart->dataset('Sales', 'bar', [$totalSales]);
                    $chart->labels([$previousMonth->format('M')]);

                }elseif($inputFilter == 'annual'){
                    $currentYear = Carbon::now()->format('Y');
                    $years = [];
                    $salesCounts = [];
                    
                    $numberOfYears = 5;
                    
                    for ($i = 0; $i < $numberOfYears; $i++) {
                        $year = $currentYear - $i;
                        
                        $totalSales = DB::table('transactions')
                            ->where('status', 'Completed')
                            ->whereYear('updated_at', $year)
                            ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
                            ->value('total_sales') ?? 0;
                    
                        $years[] = $year;
                        $salesCounts[] = $totalSales;
                    }
                    
                    $chart = new SaleChart;
                    $chart->dataset('Sales', 'bar', $salesCounts);
                    $chart->labels($years);
                    
                }elseif($inputFilter == 'weekly'){
                    $endDate = Carbon::now();
                    $startDate = $endDate->copy()->subDays(7);
            
                    $days = [];
                    $salesCounts = [];
            
                    $currentDate = $startDate;
                    while ($currentDate <= $endDate) {
                        $formattedDate = $currentDate->format('Y-m-d');
                        
                        $totalSales = DB::table('transactions')
                            ->where('status', 'Completed')
                            ->whereDate('updated_at', $formattedDate)
                            ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
                            ->value('total_sales') ?? 0;
            
                        $days[] = $currentDate->format('M d');
                        $salesCounts[] = $totalSales;
            
                        $currentDate->addDay();
                    }
            
                    $chart = new SaleChart;
                    $chart->dataset('Sales', 'bar', $salesCounts);
                    $chart->labels($days);
                }elseif($inputFilter == 'yesterday'){
                    $yesterday = Carbon::yesterday();

                    $totalSales = DB::table('transactions')
                        ->where('status', 'Completed')
                        ->whereDate('updated_at', $yesterday->toDateString())
                        ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
                        ->value('total_sales') ?? 0;
                    
                    $chart = new SaleChart;
                    $chart->dataset('Sales', 'bar', [$totalSales]);
                    $chart->labels([$yesterday->format('M d, Y')]);
                }else{
                    $endDate = Carbon::now();
                    $startDate = $endDate->copy()->subDays(0);
            
                    $days = [];
                    $salesCounts = [];
            
                    $currentDate = $startDate;
                    while ($currentDate <= $endDate) {
                        $formattedDate = $currentDate->format('Y-m-d');
                        
                        $totalSales = DB::table('transactions')
                            ->where('status', 'Completed')
                            ->whereDate('updated_at', $formattedDate)
                            ->selectRaw('SUM(prin_amount + delivery_fee) as total_sales')
                            ->value('total_sales') ?? 0;
            
                        $days[] = $currentDate->format('M d');
                        $salesCounts[] = $totalSales;
            
                        $currentDate->addDay();
                    }
            
                    $chart = new SaleChart;
                    $chart->dataset('Sales', 'bar', $salesCounts);
                    $chart->labels($days);
                }
                return view('admin.sales.index',[
                    'chart' => $chart,
                ]);
                break;
            case "client":

                break;
            case "rider":

                break;
            case "teller":
                return view('tellerHome');
                break;
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
