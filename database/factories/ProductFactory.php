<?php

namespace Database\Factories;

use App\Models\ProductWarehouse;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = [
            'name'=>fake()->name(),
            'generic_name'=>fake()->name(),
            'group_name'=>fake()->name(),
            'batch_name'=>'A',
            'expire_date'=>fake()->date(),
            'cost_of_goods'=>rand(1,10),
            'sale_price'=>rand(10,20),
            'quantity'=>10000,
            'alert_quantity'=>100,
        ];
        return $product;

    }
}
