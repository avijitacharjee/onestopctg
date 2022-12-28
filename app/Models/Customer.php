<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function totalSold(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $total = 0;
                foreach ($this->saleItems as $item) {
                    $subTotal = $item->price * $item->quantity;
                    $total += $subTotal;
                }
                return $total;
            }
        );
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function totalPaid(): Attribute
    {
        return Attribute::make(
        get: fn($value) => $this->sales->sum('paid')
        );
    }
    public function totalDue(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->sales->sum('due')
        );
    }
    public function totalDiscount(): Attribute
    {
        return Attribute::make(
            get: fn($value) =>$this->sales->sum('total_discount')
        );
    }
}
