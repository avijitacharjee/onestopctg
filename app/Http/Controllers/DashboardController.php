<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function rand_color() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
    public function dashboard()
    {
        $sales = Sale::with('saleItems')->get();
        $salesAmount = $sales->sum('total');
        $totalDue = $sales->sum('due');
        $totalPaid = $sales->sum('paid');
        $netProfit = $sales->sum('profit');
        $numberOfSales = $sales->count();
        $months = array_column($this->lastNMonths(12),'month_name');
        $monthlySales = $this->monthlySales();
        $customers = Customer::select('zone')->distinct('zone')->get();
        $zones = array();
        $zoneSales = array();
        $colors = array();
        foreach($customers as $customer){
            array_push($zones, $customer->zone);
            // dd(Customer::where('zone', $customer->zone)->get()->sum('total_sold'));
            array_push($zoneSales,Customer::where('zone', $customer->zone)->get()->sum('total_sold')-Customer::where('zone', $customer->zone)->get()->sum('total_discount'));
            array_push($colors, $this->rand_color());
        }
        $sales = Sale::latest()->take(5)->get();
        $expenses = Expense::orderByDesc('date')->take(5)->get();
        $categories = ExpenseCategory::all();

        $topProducts = Product::all()->sortByDesc('sold_quantity')->take(5)->pluck('name');
        $topProductsQuantity = Product::all()->sortByDesc('sold_quantity')->take(5)->pluck('sold_quantity');

        $topProductsThisMonth = Product::whereMonth('created_at',now()->month)->get()->sortByDesc('sold_quantity')->take(5)->pluck('name');
        $topProductsQuantityThisMonth = Product::whereMonth('created_at',now()->month)->get()->sortByDesc('sold_quantity')->take(5)->pluck('sold_quantity');
        return view('admin.dashboard')
            ->with('salesAmount', $salesAmount)
            ->with('totalDue', $totalDue)
            ->with('totalPaid', $totalPaid)
            ->with('numberOfSales', $numberOfSales)
            ->with('netProfit', $netProfit)
            ->with('months', $months)
            ->with('monthlySales', $monthlySales)
            ->with('zones', $zones)
            ->with('zoneSales', $zoneSales)
            ->with('colors', $colors)
            ->with('sales', $sales)
            ->with('expenses', $expenses)
            ->with('categories', $categories)
            ->with('topProducts', $topProducts)
            ->with('topProductsQuantity',$topProductsQuantity)
            ->with('topProductsThisMonth', $topProductsThisMonth)
            ->with('topProductsQuantityThisMonth',$topProductsQuantityThisMonth);


    }
    // public function lastNMonths($n)
    // {
    //     $months = array();
    //     $currentMonth = 5;//date('m');
    //     if($currentMonth<$n){
    //         $k = 12 + $currentMonth - $n;
    //         for($i=$k;$i<=12;$i++){
    //             array_push($months,['number'=>$i,'name'=> date('F', mktime(0, 0, 0, $i, 10))]);
    //             // $months->add(['number'=>$i,'name'=>date('F',mktime(0,0,0,$i,10))]);
    //         }
    //     }
    //     for ($i = $currentMonth-$n; $i < $currentMonth;$i++){
    //         array_push($months,['number'=>$i,'name'=> date('F', mktime(0, 0, 0, $i, 10))]);
    //         // $months->add(['number'=>$i,'name'=>date('F',mktime(0,0,0,$i,10))]);
    //     }
    //     return $months;
    // }
    public function lastNMonths($n){
        $months = array();
        $now = now();
        for($i = 1;$i<=$n;$i++){
            array_push($months, [
                'month_name'=>now()->subMonth($i)->monthName,
                'month'=>now()->subMonth($i)->month,
                'year'=>now()->subMonth($i)->year
            ]);
        }
        return array_reverse($months);
    }
    public function monthlySales(){
        $months = $this->lastNMonths(12);
        $sales = array();
        foreach($months as $month){
            $totalSale = Sale::whereYear('created_at', $month['year'])
                ->whereMonth('created_at', $month['month'])
                ->get()
                ->sum('total');
            array_push($sales, $totalSale);
        }
        return $sales;
    }
}
