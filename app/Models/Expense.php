<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    public function cateogory(){
        return $this->belongsTo(ExpenseCategory::class,'expense_category_id');
    }
}