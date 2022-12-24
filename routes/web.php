<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\AuthMiddleware;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Warehouse;
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



Route::redirect('/', '/login');
Route::view('/login', 'admin.login');
Route::post('/login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout']);

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::resources([
        'customer' => CustomerController::class,
        'sale' => SaleController::class,
        'expense-category' => ExpenseCategoryController::class,
        'product' => ProductController::class,
        'expense' => ExpenseController::class,
        'supplier' => SupplierController::class,
        'warehouse' => WarehouseController::class,
        'user'=>UserController::class,
        'payment'=>PaymentController::class,
    ]);
    Route::view('dashboard', 'admin.dashboard');
    Route::group([
        'controller' => SaleController::class,
        'prefix' => 'sale'
    ], function () {
        Route::get('pdf/{sale_id}','downloadPdf');
    });

    Route::group([
        'controller' => ProductController::class,
    ], function () {
        Route::get('reports/sale', 'saleReport');
        Route::get('csv-sample', 'csvSample');

        Route::get('transfer', 'transferIndex');
        Route::get('transfer/create', 'createTransfer');
        Route::post('transfer', 'storeTransfer');

        Route::get('return', 'returnIndex');
        Route::get('return/create', 'createReturn');
        Route::post('return', 'storeReturn');


        Route::get('add-csv', 'addCsv');
        Route::post('/add-csv',  'storeCsv');
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
        Route::get('expense', 'expenseReport');
    });
    Route::fallback(
        function () {
            return view('errors.404');
        }
    );
});
Route::get('/pdf', function () {
    return view('admin.pdf.sale')
        ->with('sale',Sale::first());
});
