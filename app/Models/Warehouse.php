<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_warehouses')
            ->withPivot('stock')
            ->withTimestamps();
    }
    public function numberOfProducts()
    {
        return $this->products->count();
    }
}
