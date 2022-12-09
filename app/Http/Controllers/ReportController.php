<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function productReport(){
        $product = Product::all()->sortByDesc('sold_quantity');
        return view('admin.report.product')
            ->with('products',$product);
    }
    public function customerReport(){
        $customers= Customer::all()->sortByDesc('total_sold');
        return view('admin.report.customer')
            ->with('customers', $customers);
    }
}
