<?php

namespace Database\Seeders;

use App\Models\Income;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['বালি বিক্রয়', 'পাথর বিক্রয়', 'ভাড়া আয়', 'অন্যান্য আয়'];

        foreach (range(1, 25) as $i) {
            Income::create([
                'income_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                'category' => fake()->randomElement($categories),
                'description' => fake()->sentence(4),
                'amount' => fake()->randomFloat(2, 1000, 80000),
                'notes' => fake()->boolean(20) ? fake()->sentence() : null,
                'created_by' => null,
            ]);
        }
    }
}
