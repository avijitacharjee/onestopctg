<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function all(){
        return response()->json([
            'data'=>Customer::all(),
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
        $customers = Customer::all();
        return view('admin.customer.index')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        Customer::create($request->all());
        return back()->with('message', 'Succesfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.update')->with('product', $customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->input());
        return back()->with('message', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back();
    }
    public function addCsv(){
        return view('admin.customer.add-csv');
    }
    public function storeCsv(Request $request){
        $file = $request->file('csv');
        $lines = file($file, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $index => $line) {
            if ($index == 0) {
                continue;
            }
            $words = explode(',', $line);
            $customer = new Customer();
            $customer->name = trim($words[1], '"');
            $customer->email = trim($words[2], '"');
            $customer->phone = trim($words[3], '"');
            $customer->address = trim($words[4], '"');
            $customer->city = trim($words[5], '"');
            $customer->save();
        }
        return back()->with('message', 'Successfully added to database');
    }
}
