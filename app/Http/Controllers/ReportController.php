<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function supplierReport(){
        $suppliers = Supplier::all();
        return view('admin.report.supplier')
            ->with('suppliers',$suppliers);
    }
    public function expenseReport(Request $request){
        $data = Expense::all()->sortByDesc('date');
        if($request->type){
            if($request->type=='daily'){
                // dd(Expense::select(DB::raw('sum(amount)'), DB::raw('MONTHNAME(`date`) as monthname'))
                // ->groupBy('monthname')->toSql());
                // $data = Expense::select(DB::raw('sum(amount) as amount'), DB::raw('MONTHNAME(`date`) as monthname'))
                //     ->groupBy('monthname')
                //     ->get();
            }else {
                $data = Expense::selectRaw('year(`date`) as yr, month(`date`) as mnt, sum(amount) as amount')
                    ->groupBy('yr')
                    ->groupBy('mnt')
                    ->orderBy('yr','desc')
                    ->orderBy('mnt','desc')
                    ->get();
            }
        }
        return view('admin.report.expense')
            ->with('data',$data)
            ->with('selected',$request->type);
    }
}
