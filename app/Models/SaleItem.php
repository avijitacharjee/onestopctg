<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function sale() {
        return $this->belongsTo(Sale::class);
    }
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function total(): Attribute {
        return Attribute::make(
            get: fn($value)=>$this->quantity * $this->price - $this->discount
        );
    }
    public function totalCost(): Attribute {
        return Attribute::make(
            get: fn($value)=>$this->quantity * $this->cog
        );
    }
    public function profit(): Attribute {
        return Attribute::make(
            get: fn($value)=>$this->total-$this->total_cost
        );
    }
}
