<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function saleReportOld()
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
    public function saleReport(Request $request)
    {
        $product = $request->product;
        $customer = $request->customer;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $paymentStatus = $request->payment_status;
        $sales = Sale
            ::when($product, function ($query, $product) {
                $query->whereHas(
                    'saleItems.product',
                    function ($q) use ($product) {
                        $q->where('name', 'like', "%{$product}%");
                    }
                );
            })
            ->when($customer, function ($query, $customer) {
                $query->whereHas(
                    'customer',
                    function ($q) use ($customer) {
                        $q->where('name', 'like', "%{$customer}%");
                    }
                );
            })
            ->when($startDate, function ($query, $startDate) {
                $query->whereDate('created_at', '>', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                $query->whereDate('created_at', '<', $endDate);
            })
            ->when($paymentStatus, function ($query, $paymentStatus) {
                $query->where();
            })
            ->with(['customer', 'saleItems.product'])
            ->get()
            ->filter(function ($sale) use ($paymentStatus) {
                if ($paymentStatus == "due") {
                    return $sale->paymentStatus == "Due";
                } elseif ($paymentStatus == "paid") {
                    return $sale->paymentStatus == "Paid";
                } elseif ($paymentStatus == "pending") {
                    return $sale->paymentStatus == "Pending";
                }
                return true;
            });
        return view('admin.report.sale')
            ->with('sales', $sales);
    }
    public function bestSale(Request $request)
    {
        $product = $request->product;
        $customer = $request->customer;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $paymentStatus = $request->payment_status;
        $sales = Sale
            ::when($product, function ($query, $product) {
                $query->whereHas(
                    'saleItems.product',
                    function ($q) use ($product) {
                        $q->where('name', 'like', "%{$product}%");
                    }
                );
            })
            ->when($customer, function ($query, $customer) {
                $query->whereHas(
                    'customer',
                    function ($q) use ($customer) {
                        $q->where('name', 'like', "%{$customer}%");
                    }
                );
            })
            ->when($startDate, function ($query, $startDate) {
                $query->whereDate('created_at', '>', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                $query->whereDate('created_at', '<', $endDate);
            })
            ->when($paymentStatus, function ($query, $paymentStatus) {
                $query->where();
            })
            ->with(['customer', 'saleItems.product'])
            ->get()
            ->filter(function ($sale) use ($paymentStatus) {
                if ($paymentStatus == "due") {
                    return $sale->paymentStatus == "Due";
                } elseif ($paymentStatus == "paid") {
                    return $sale->paymentStatus == "Paid";
                } elseif ($paymentStatus == "pending") {
                    return $sale->paymentStatus == "Pending";
                }
                return true;
            })
            ->sortByDesc('total');
        return view('admin.report.best-sale')
            ->with('sales', $sales);
    }
    public function profitPerProduct()
    {
        $products = Product::all()->sortByDesc('profit_per_product');
        return view('admin.report.profit-per-product')
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
    public function monthlySalesReport($year, $warehouse_id)
    {
        $warehouse = Warehouse::find($warehouse_id);
        $warehouse_name = $warehouse->name ?? 'All Warehouses';
        $monthlyDatam = collect();
        $months = collect(['January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December']);
        for ($i = 1; $i <= 12; $i++) {
            $sales = Sale::whereYear('created_at', $year)->whereMonth('created_at', $i)->get();
            $revenue = $sales->sum('total');
            $discount = $sales->sum('total_discount');
            $expense = Expense::whereYear('date', $year)->whereMonth('date', $i)->get()->sum('amount');
            $cost = $sales->sum('total_cog');
            $profit = $sales->sum('profit');
            $monthlyDatam->push(collect([
                'month' => $months[$i - 1],
                'revenue' => $revenue,
                'discount' => $discount,
                'cost' => $cost,
                'expense' => $expense,
                'profit' => $profit
            ]));
        }
        // dd($monthlyDatam);
        $warehouses = Warehouse::all();
        return view('admin.report.monthly-sale')
            ->with('year', $year)
            ->with('warehouse_name', $warehouse_name)
            ->with('warehouses', $warehouses)
            ->with('monthlyDatam', $monthlyDatam);
    }
    public function dailySalesReport(Request $request)
    {
        $date = null;
        if($request->month){
            $date = Carbon::createFromFormat("Y-m-j",$request->month."-01");
            // dd($date);
            // $date = $month->firstOfMonth();
        }
        return view('admin.report.daily-sale')
            ->with('cal', $this->calendar($date));
    }
    public function cal(Request $request)
    {

        return view('admin.report.cal')
            ->with('cal', $this->calendar());
    }
    public function calendar($date = null)
    {
        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SATURDAY);

        $html = '<div class="calendar">';

        $html .= '<div class="month-year">';
        $html .= '<span class="month">' . $date->format('M') . '</span>';
        $html .= '<span class="year">' . $date->format('Y') . '</span>';
        $html .= '</div>';

        $html .= '<div class="days">';

        $dayLabels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        foreach ($dayLabels as $dayLabel) {
            $html .= '<span class="day-label">' . $dayLabel . '</span>';
        }
        $i = 0;
        while ($startOfCalendar <= $endOfCalendar) {
            $extraClass = $startOfCalendar->format('m') != $date->format('m') ? 'dull' : '';
            $extraClass .= $startOfCalendar->isToday() ? ' today' : '';

            $html .= '<button data-toggle="modal" data-target="#myModal' . $i++ . '" class="day ' . $extraClass . '"><span class="content">' . $startOfCalendar->format('j') . '</span></button>';
            // $html .= $this->calModal();
            $startOfCalendar->addDay();
        }
        $html .= '</div></div>';
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::SUNDAY);
        $i = 0;
        while ($startOfCalendar <= $endOfCalendar) {
            $sales = Sale::whereDate('created_at', $startOfCalendar->toDateString())->get();
            $revenue = $sales->sum('total');
            $discount = $sales->sum('total_discount');
            $expense = Expense::whereDate('created_at', $startOfCalendar->toDateString())->get()->sum('amount');
            $cost = $sales->sum('total_cog');
            $profit = $sales->sum('profit');

            $html .= $this->calModal(
                $startOfCalendar->format("y-m-j"),
                $i++,
                $revenue,
                $discount,
                $expense,
                $cost,
                $profit
            );
            $startOfCalendar->addDay();
        }
        return $html;
    }
    public function warehouseReport()
    {
        $warehouses = Warehouse::withCount([
            'products' => function (Builder $query) {
                $query->where('stock', '>', 0);
            }
        ])
            ->with('products')
            ->get();
        return view('admin.report.warehouse')
            ->with('warehouses', $warehouses);
    }
    public function calModal($date, $i,$revenue,$discount,$expense,$cost,$profit)
    {
        return "
        <div class='modal fade .modal-xl'
        id='myModal{$i}'
        tabindex='-1' role='dialog'
        aria-labelledby='exampleModalCenterTitle'
        aria-hidden='true'>
            <div class='modal-dialog'
                role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'
                            id='exampleModalLongTitle'>
                            Sale report
                            {$date}
                        </h5>
                        <button type='button'
                            class='close'
                            data-dismiss='modal'
                            aria-label='Close'>
                            <span
                                aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div id='modalBody'
                        class='modal-body'>
                        <table class='table table-responsive table-striped'>
                            <tbody style='width: 100%'>
                                <tr>
                                    <td>
                                        Product's Revenue:
                                    </td>
                                    <td>
                                        {$revenue}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Doctor Honor:
                                    </td>
                                    <td>
                                        {$discount}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Product Cost:
                                    </td>
                                    <td>
                                        {$cost}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Expenses
                                    </td>
                                    <td>
                                        {$expense}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Profit
                                    </td>
                                    <td>
                                        {$profit}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class='modal-footer'>
                        <button type='button'
                            class='btn btn-secondary'
                            data-dismiss='modal'>Close</button>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
}
