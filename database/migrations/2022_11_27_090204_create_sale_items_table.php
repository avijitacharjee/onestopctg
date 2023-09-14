<?php

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sale::class);
            $table->foreignIdFor(Customer::class)->nullable();
            $table->foreignIdFor(Product::class);
            $table->float('cog')->nullable();
            $table->float('price');
            $table->integer('quantity');
            $table->integer('sample');
            $table->integer('bonus');
            $table->integer('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
};
