<?php

use App\Models\Product;
use App\Models\Warehouse;
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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->date('transfer_date');
            $table->string('reference_no');
            $table->unsignedBigInteger('from_warehouse');
            $table->foreign('from_warehouse')
                ->references('id')
                ->on('warehouses')
                ->constrained()
                ->onDelete('cascade');
            $table->unsignedBigInteger('to_warehouse');
            $table->foreign('to_warehouse')
                ->references('id')
                ->on('warehouses')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(Product::class)->constrained();
            $table->integer('quantity');
            $table->string('shipping')->nullable();
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
        Schema::dropIfExists('transfers');
    }
};
