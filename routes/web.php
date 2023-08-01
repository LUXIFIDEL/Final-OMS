<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController};

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('is_client');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('rider/home', [HomeController::class, 'riderHome'])->name('rider.home')->middleware('is_rider');
Route::get('teller/home', [HomeController::class, 'tellerHome'])->name('teller.home')->middleware('is_teller');


