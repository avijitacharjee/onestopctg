<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function list(){
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::all();
        return view('admin.products')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-product');
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
        return view('admin.update-product')->with('product', $product);
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
