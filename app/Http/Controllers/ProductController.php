<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Sale;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function saleReport(){
        $products = Product::all();
        $sales = Sale::all();
        foreach($products as $product){
            $product->sales = 0;
            $product->revenue = 0;
            $product->sold_quantity = 0;
        }
        foreach($sales as $sale){
            foreach($sale->saleItems as $saleItem){
                foreach($products as $product){
                    if($product->id ==  $saleItem->product->id){
                        $product->sold_quantity += $saleItem->quantity;
                        $product->sales += ($saleItem->price * $saleItem->quantity);
                        $product->revenue += ($saleItem->product->cost_of_goods * $saleItem->quantity);
                    }
                }
            }
        }
        return view('admin.report.sale')
            ->with('products',$products);
    }
    public function addCsv(Request $request){
        $file = $request->file('csv');
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        foreach($lines as $index=>$line){
            if($index==0){
                continue;
            }
            $words = explode(',', $line);
            $product = new Product();
            $product->name = trim($words[1],'"');
            $product->generic_name = trim($words[2],'"');
            $product->group_name = trim($words[3], '"');
            $product->batch_name = trim($words[4],'"');
            $product->expire_date = trim($words[5],'"');
            $product->cost_of_goods = trim($words[6],'"');
            $product->sale_price = trim($words[7],'"');
            $product->alert_quantity = trim($words[8],'"');
            $product->quantity = trim($words[9],'"');
            $product->save();
        }
        return back()->with('message', 'Successfully added to database');
    }
    public function all(){
        return response()->json([
            'data'=>Product::all(),
            'success'=>true
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::all();
        return view('admin.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.add');
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->all());
        return back()->with('message', 'Succesfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
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
}
