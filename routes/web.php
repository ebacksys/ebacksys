<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/customerindex', function() {
    return view('customer.index');
})->name('customerindex')->middleware('auth');

Route::get('/bookkeeping', function() {
    return view('accounts.index');
})->name('bookkeeping')->middleware('auth');



Route::delete('/customerdestroy/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customers.destroy');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('none');

