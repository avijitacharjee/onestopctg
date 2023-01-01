<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $sales = Sale::with('saleItems')->get();
        $salesAmount = $sales->sum('total');
        $totalDue = $sales->sum('due');
        $totalPaid = $sales->sum('paid');
        $netProfit = $sales->sum('profit');
        $numberOfSales = $sales->count();
        return view('admin.dashboard')
            ->with('salesAmount', $salesAmount)
            ->with('totalDue', $totalDue)
            ->with('totalPaid', $totalPaid)
            ->with('numberOfSales', $numberOfSales)
            ->with('netProfit', $netProfit);
    }
    public function lastNMonths($n)
    {
        $data = array();
        $months = array();
        $currentMonth = date('m');
        if($currentMonth<12){
            $k = 12 + $currentMonth - $n;
            for($i=$k;$i<=12;$i++){
                array_push($data, $i);
                array_push($months, date('F', mktime(0, 0, 0, $i, 10)));
            }
        }
        for ($i = 1; $i < $currentMonth;$i++){
            array_push($data,$i);
            array_push($months, date('F', mktime(0, 0, 0, $i, 10)));
        }
        return $months;
    }
}
