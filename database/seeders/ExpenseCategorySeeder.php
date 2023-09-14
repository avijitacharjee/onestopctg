<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for($i=0;$i<10;$i++){
        //     $expenseCategory = new ExpenseCategory();
        //     $expenseCategory->name = fake()->word();
        //     $expenseCategory->save();
        // }
        ExpenseCategory::factory()->count(10)->create();
    }
}
