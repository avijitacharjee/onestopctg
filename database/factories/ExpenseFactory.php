<?php

namespace Database\Factories;

use App\Models\ExpenseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'expense_category_id'=>ExpenseCategory::inRandomOrder()->first()->id,
            // 'expense_category_id'=>ExpenseCategory::factory(),
            'name'=>fake()->word(),
            'amount'=>rand(1,100),
            'date'=>fake()->date('Y-m-d'),
            'note'=>fake()->paragraph(1),
        ];
    }
}
