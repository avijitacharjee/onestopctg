<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('admin.login');
});
Route::post('/login', [UserController::class,'login']);
Route::view('dashboard', 'admin.dashboard');
Route::resource('product', ProductController::class);
Route::resource('customer', CustomerController::class);
Route::resource('sale', SaleController::class);
Route::view('add-csv', 'admin.product.add-csv');
Route::post('/add-csv', [ProductController::class, 'addCsv']);

Route::resource('user', UserController::class);
