<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAdjustment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
    public function createdBy(){
        return $this->belongsTo(User::class);
    }
}
