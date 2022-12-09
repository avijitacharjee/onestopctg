<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function saleItems(){
        return $this->hasMany(SaleItem::class);
    }
    public function soldQuantity(): Attribute {
        return Attribute::make(
            get: fn($value)=>$this->saleItems()->sum('quantity')
        );
    }
}
