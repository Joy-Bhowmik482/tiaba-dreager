<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['জ্বালানি খরচ', 'বেতন', 'রক্ষণাবেক্ষণ', 'পরিবহন', 'বিবিধ খরচ'];

        foreach (range(1, 25) as $i) {
            Expense::create([
                'expense_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                'category' => fake()->randomElement($categories),
                'description' => fake()->sentence(4),
                'amount' => fake()->randomFloat(2, 500, 60000),
                'notes' => fake()->boolean(20) ? fake()->sentence() : null,
                'created_by' => null,
            ]);
        }
    }
}
