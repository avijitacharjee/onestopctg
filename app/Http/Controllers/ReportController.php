<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function saleReport()
    {
        $products = Product::with('saleItems')->get();
        $sales = Sale::with('saleItems.product')->get();
        foreach ($products as $product) {
            $product->sales = 0;
            $product->revenue = 0;
            $product->sold_quantity = 0;
        }
        foreach ($sales as $sale) {
            foreach ($sale->saleItems as $saleItem) {
                foreach ($products as $product) {
                    if ($product->id ==  $saleItem->product->id) {
                        $product->sold_quantity += $saleItem->quantity;
                        $product->sales += ($saleItem->price * $saleItem->quantity);
                        $product->revenue += ($saleItem->product->cost_of_goods * $saleItem->quantity);
                    }
                }
            }
        }
        return view('admin.report.sale')
            ->with('products', $products);
    }
    public function productReport()
    {
        $product = Product::all()->sortByDesc('sold_quantity');
        return view('admin.report.product')
            ->with('products', $product);
    }
    public function customerReport()
    {
        $customers = Customer::all()->sortByDesc('total_sold');
        return view('admin.report.customer')
            ->with('customers', $customers);
    }
    public function supplierReport()
    {
        $suppliers = Supplier::all();
        return view('admin.report.supplier')
            ->with('suppliers', $suppliers);
    }
    public function expenseReport(Request $request)
    {
        $data = Expense::all()->sortByDesc('date');
        if ($request->type) {
            if ($request->type == 'daily') {
                // dd(Expense::select(DB::raw('sum(amount)'), DB::raw('MONTHNAME(`date`) as monthname'))
                // ->groupBy('monthname')->toSql());
                // $data = Expense::select(DB::raw('sum(amount) as amount'), DB::raw('MONTHNAME(`date`) as monthname'))
                //     ->groupBy('monthname')
                //     ->get();
            } else {
                $data = Expense::selectRaw('year(`date`) as yr, month(`date`) as mnt, sum(amount) as amount')
                    ->groupBy('yr')
                    ->groupBy('mnt')
                    ->orderBy('yr', 'desc')
                    ->orderBy('mnt', 'desc')
                    ->get();
            }
        }
        return view('admin.report.expense')
            ->with('data', $data)
            ->with('selected', $request->type);
    }
    public function paymentReport()
    {
        $payments = Payment::orderByDesc('payment_date')->get();
        return view('admin.report.payment')
            ->with('payments', $payments);
    }
    public function monthlySalesReport($year,$warehouse_id) {
        $warehouse = Warehouse::find($warehouse_id);
        $warehouse_name = $warehouse->name??'All Warehouses';
        $monthlyDatam = collect();
        $months = collect( ['January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December']);
        for ($i = 1; $i <= 12;$i++){
            $sales = Sale::whereYear('created_at',$year)->whereMonth('created_at',$i)->get();
            $revenue = $sales->sum('total');
            $discount = $sales->sum('total_discount');
            $expense = Expense::whereYear('date',$year)->whereMonth('date',$i)->get()->sum('amount');
            $cost = $sales->sum('total_cog');
            $profit = $sales->sum('profit');
            $monthlyDatam->push(collect([
                'month'=>$months[$i-1],
                'revenue'=>$revenue,
                'discount'=>$discount,
                'cost'=>$cost,
                'expense'=>$expense,
                'profit'=>$profit
            ]));
        }
        // dd($monthlyDatam);
        $warehouses = Warehouse::all();
        return view('admin.report.monthly-sale')
            ->with('year',$year)
            ->with('warehouse_name',$warehouse_name)
            ->with('warehouses',$warehouses)
            ->with('monthlyDatam',$monthlyDatam);
    }
}
