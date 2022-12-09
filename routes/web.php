<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
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
Route::resources([
    'customer' => CustomerController::class,
    'sale' => SaleController::class,
    'expense-category' => ExpenseCategoryController::class,
    'product' => ProductController::class,
    'expense' => ExpenseController::class,
    'supplier' => SupplierController::class
]);
Route::post('/login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout']);
Route::view('dashboard', 'admin.dashboard');
Route::view('add-csv', 'admin.product.add-csv');
Route::post('/add-csv', [ProductController::class, 'addCsv']);

Route::resource('user', UserController::class);
Route::group([
    'controller' => ProductController::class,
], function () {
    Route::get('reports/sale', 'saleReport');
    Route::get('csv-sample', 'csvSample');
});
Route::group([
    'controller' => ExpenseCategoryController::class
], function () {
});
Route::group([
    'controller' => ReportController::class,
    'prefix' => 'reports'
], function () {
    Route::get('product', 'productReport');
    Route::get('customer', 'customerReport');
    Route::get('supplier', 'supplierReport');
    Route::get('expense','expenseReport');
});
