<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    public function fromWarehouse(){
        return $this->belongsTo(Warehouse::class,'from_warehouse');
    }
    public function toWarehouse(){
        return $this->belongsTo(Warehouse::class,'to_warehouse');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
