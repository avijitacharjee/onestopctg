<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductWarehouse;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory()->count(10)->create();
        $warehouses = Warehouse::all();
        foreach($products as $product){
            $firstItem = true;
            foreach($warehouses as $warehouse){
                $productWarehouse = new ProductWarehouse();
                $productWarehouse->product_id = $product->id;
                $productWarehouse->warehouse_id = $warehouse->id;
                $productWarehouse->stock = $firstItem?$product->quantity:0;
                $productWarehouse->save();
                $firstItem = false;
            }
        }
    }
}
