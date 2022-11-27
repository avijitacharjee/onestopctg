<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sales = Sale::all();
        // foreach($sales as $sale){
        //     $productNames = [];
        //     foreach(explode(',',$sale->product_ids) as $product_id){
        //         $product = Product::find($product_id);
        //         array_push($productNames,$product->name);
        //     }
        //     $sale->productNames = implode(', ',$productNames);
        // }

        return view('admin.sale.index')
            ->with('sales',$sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sale.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleRequest $request)
    {
        Log::info($request->all());
        $sale = new Sale();
        $sale->customer_id = $request->customer_id;

        $sale->product_ids = implode(',', $request->product_ids);
        $sale->quantities = implode(',', $request->quantities);


        $numOfProducts = count($request->product_ids);
        $sale->save();

        $frees = [];
        $total = 0;
        for($i=0;$i<$numOfProducts;$i++){
            $product = Product::find($request->product_ids[$i]);
            $finalQuantity =  $request->quantities[$i] + $request->samples[$i] + $request->bonuses[$i];
            $product->quantity = $product->quantity-$finalQuantity;
            $product->save();

            $saleItem = new SaleItem();
            $saleItem->customer_id = $request->customer_id;
            $saleItem->product_id = $request->product_ids[$i];
            $saleItem->price = $request->prices[$i];
            $saleItem->quantity = $request->quantities[$i];
            $saleItem->sample = $request->samples[$i];
            $saleItem->bonus = $request->bonuses[$i];
            $saleItem->discount = $request->discounts[$i];
            $saleItem->sale_id = $sale->id;
            $saleItem->cog = $product->cost_of_goods;
            $saleItem->save();
        }

        return back()->with('message','Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleRequest  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
