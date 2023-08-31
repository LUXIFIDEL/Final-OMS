<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,CustomerController,RiderController,TransactionController,ExpensesController,SalesController,UserController};

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('is_client');
Route::get('rider/home', [HomeController::class, 'riderHome'])->name('rider.home')->middleware('is_rider');
Route::get('teller/home', [HomeController::class, 'tellerHome'])->name('teller.home')->middleware('is_teller');
Route::middleware('is_admin')->as('admin.')->prefix('admin')->group(function(){
    Route::get('home', [HomeController::class, 'adminHome'])->name('home');
    Route::controller(CustomerController::class)
        ->as('customer.')
        ->prefix('customer')
        ->group(function(){
            Route::get('/','index')->name('index');
            Route::get('/show','show')->name('show');
        });
    Route::controller(RiderController::class)
        ->as('rider.')
        ->prefix('rider')
        ->group(function(){
            Route::get('/','index')->name('index');
        });
    Route::controller(TransactionController::class)
        ->as('transaction.')
        ->prefix('transaction')
        ->group(function(){
            Route::get('/','index')->name('index');
        });
    Route::controller(ExpensesController::class)
        ->as('expenses.')
        ->prefix('expenses')
        ->group(function(){
            Route::get('/','index')->name('index');
        });
    Route::controller(SalesController::class)
        ->as('sales.')
        ->prefix('sales')
        ->group(function(){
            Route::get('/','index')->name('index');
        });
    Route::controller(UserController::class)
        ->as('account.')
        ->prefix('account')
        ->group(function(){
            Route::get('/','index')->name('index');
        });
});
