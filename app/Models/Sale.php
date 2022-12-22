<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function dateText(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('jS M, Y', strtotime($this->created_at))
        );
    }
    public function total(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->saleItems->sum('total')
        );
    }
}
