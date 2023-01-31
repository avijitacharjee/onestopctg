<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Customer;
use App\Models\ProductAdjustment;
use App\Models\ProductWarehouse;
use App\Models\Sale;
use App\Models\Transfer;
use App\Models\Warehouse;
use Exception;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
    public function addCsv()
    {
        $warehouses = Warehouse::all();
        return view('admin.product.add-csv')
            ->with('warehouses', $warehouses);
    }
    public function storeCsv(Request $request)
    {
        $file = $request->file('csv');
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $index => $line) {
            if ($index == 0) {
                continue;
            }
            $words = explode(',', $line);
            try {
                $product = new Product();
                $product->name = trim($words[1], '"');
                $product->generic_name = trim($words[2], '"');
                $product->group_name = trim($words[3], '"');
                $product->batch_name = trim($words[4], '"');
                $product->expire_date = date("Y-m-d", strtotime(trim($words[5], '"')));
                $product->cost_of_goods = trim($words[6], '"');
                $product->sale_price = trim($words[7], '"');
                $product->alert_quantity = trim($words[8], '"');
                $product->quantity = trim($words[9], '"');
                $product->save();
            } catch (Exception $e) {
                continue;
            }

            $warehouse = Warehouse::find($request->warehouse_id);
            $productWarehouse = new ProductWarehouse();
            $productWarehouse->product_id = $product->id;
            $productWarehouse->warehouse_id = $warehouse->id;
            $productWarehouse->stock = trim($words[9], '"');
            $productWarehouse->save();
        }
        return back()->with('message', 'Successfully added to database');
    }
    public function all()
    {
        return response()->json([
            'data' => Product::all(),
            'success' => true
        ]);
    }

    public function index(Request $request)
    {
        $products = Product::all();
        if ($request->warehouse) {
            if ($request->warehouse > -1) {
                $products = DB::table('products')
                    ->leftJoin('product_warehouses', 'products.id', '=', 'product_warehouses.product_id')
                    ->select('products.*', 'product_warehouses.stock as stock')
                    ->where('product_warehouses.warehouse_id', '=', $request->warehouse)
                    ->where('stock', '>', 0)
                    ->get();
                // return $products;
                // ->get();
            }
        }
        $warehouses = Warehouse::all();
        return view('admin.product.index')
            ->with('products', $products)
            ->with('warehouses', $warehouses)
            ->with('selected', $request->warehouse);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouse = Warehouse::all();
        return view('admin.product.add')
            ->with('warehouses', $warehouse);
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->generic_name = $request->generic_name;
        $product->group_name = $request->group_name;
        $product->batch_name = $request->batch_name;
        $product->expire_date = $request->expire_date;
        $product->cost_of_goods = $request->cost_of_goods;
        $product->sale_price =  $request->sale_price;
        $product->quantity = $request->quantity;
        $product->alert_quantity = $request->alert_quantity;
        $product->tax = $request->tax;
        $product->save();
        // $warehouses = Warehouse::all();
        // foreach ($warehouses as $warehouse) {
        $warehouse = Warehouse::find($request->warehouse_id);
        $productWarehouse = new ProductWarehouse();
        $productWarehouse->product_id = $product->id;
        $productWarehouse->warehouse_id = $warehouse->id;
        $productWarehouse->stock = $request->quantity;
        $productWarehouse->save();

        $productAdjustment = new ProductAdjustment();
        $productAdjustment->product_id = $product->id;
        $productAdjustment->warehouse_id = $warehouse->id;
        $productAdjustment->user_id = auth()->user()->id;
        // $productAdjustment->note = "Added by "
        $productAdjustment->quantity = $request->quantity;
        $productAdjustment->save();

        return back()->with('message', 'Succesfully Added');
    }

    public function edit(Product $product)
    {
        return view('admin.product.update')->with('product', $product);
    }
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->input());
        return back()->with('message', 'Successfully updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
    public function csvSample()
    {
        $file = public_path() . "/download/products.csv";

        $headers = array(
            'Content-Type: application/csv',
        );

        return response()->download($file, 'products.csv', $headers);
    }
    public function transferIndex()
    {
        $transfers = Transfer::all();
        return view('admin.transfer.index')
            ->with('transfers', $transfers);
    }
    public function createTransfer()
    {
        $warehouses = Warehouse::all();
        $products = Product::all();
        return view('admin.transfer.add')
            ->with('warehouses', $warehouses)
            ->with('products', $products);
    }
    public function storeTransfer(Request $request)
    {

        $transfer = new Transfer();
        // $fromWarehouse = Warehouse::find($request->from_warehouse);
        $fromProductWarehouse = ProductWarehouse::where('warehouse_id', $request->from_warehouse)->first();
        // $stock = $fromWarehouse ? $fromWarehouse->stock : 0;
        if (!$fromProductWarehouse) {
            return back()->with('err', 'The quantity is not available in that warehouse');
        }
        if ($fromProductWarehouse->stock < $request->quantity) {
            return back()->with('err', 'The quantity is not available in that warehouse');
        }
        $fromProductWarehouse->stock -= $request->quantity;
        $fromProductWarehouse->save();

        $toProductWarehouse = ProductWarehouse::firstOrNew(['warehouse_id' => $request->to_warehouse]);
        $toProductWarehouse->stock += $request->quantity;
        $toProductWarehouse->save();

        $transfer->from_warehouse = $request->from_warehouse;
        $transfer->to_warehouse = $request->to_warehouse;
        $transfer->product_id = $request->product_id;
        $transfer->transfer_date = $request->transfer_date;
        $transfer->reference_no = $request->reference_no;
        $transfer->quantity = $request->quantity;
        $transfer->shipping = $request->shipping;
        $transfer->save();
        return back()->with('message', 'Successfully saved');
    }
    public function returnIndex()
    {
        return view('admin.return.index');
    }
    public function createReturn()
    {
        $warehouses = Warehouse::all();
        $products = Product::all();
        $customers = Customer::all();
        return view('admin.return.add')
            ->with('warehouses', $warehouses)
            ->with('products', $products)
            ->with('customers', $customers);
    }
}
