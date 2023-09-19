<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController,CustomerController,RiderController,TransactionController,ExpensesController,SalesController,UserController,ProfileController,MessageController};

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'redirectHome'])->name('redirect');

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
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});

Route::middleware('is_teller')->as('teller.')->prefix('teller')->group(function(){
    Route::get('home', [HomeController::class, 'tellerHome'])->name('home');
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
            Route::put('/status/ca','changeCancelledStatus')->name('update_status');
            Route::get('/selected/{id}','edit')->name('edit');
            Route::put('/update/{id}','update')->name('update');
            Route::put('/status/co','changeCompletedStatus')->name('update_co');
        });

});

Route::middleware('is_rider')->as('rider.')->prefix('rider')->group(function(){
    Route::get('home', [HomeController::class, 'riderHome'])->name('home');
  
});

Route::middleware('is_client')->as('client.')->prefix('client')->group(function(){
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::controller(TransactionController::class)
        ->as('transaction.')
        ->prefix('transaction')
        ->group(function(){
            Route::get('/','index')->name('index');
            Route::get('/create','create')->name('create');
            Route::post('/store','store')->name('store');
            Route::put('/change-status','changeCancelledStatus')->name('update_status');
        });
    Route::get('/msg/{transno}/{str}', [MessageController::class, 'index'])->name('msg');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});

