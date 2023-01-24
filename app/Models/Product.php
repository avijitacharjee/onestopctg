<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['saleItems'];
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function soldQuantity(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->saleItems->sum('quantity')
        );
    }
    public function profitPerProduct(): Attribute{
        return Attribute::make(
            get: fn($value)=>$this->sold_quantity*($this->sale_price-$this->cog)
        );
    }
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class,'product_warehouses')
            ->withPivot('stock')
            ->withTimestamps();
    }
}
