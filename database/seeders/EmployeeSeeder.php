<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $positions = ['ম্যানেজার', 'ড্রেজার অপারেটর', 'হেলপার', 'অ্যাকাউন্টেন্ট', 'ড্রাইভার', 'সুপারভাইজার'];

        foreach (range(1, 10) as $i) {
            Employee::create([
                'employee_code' => 'EMP-' . strtoupper(Str::random(6)),
                'name' => fake()->name(),
                'phone' => fake()->numerify('01#########'),
                'alternate_phone' => fake()->boolean(30) ? fake()->numerify('01#########') : null,
                'address' => fake()->address(),
                'position' => fake()->randomElement($positions),
                'salary' => fake()->randomFloat(2, 8000, 40000),
                'joining_date' => fake()->dateTimeBetween('-3 years', '-1 month')->format('Y-m-d'),
                'status' => fake()->randomElement(['active', 'active', 'active', 'inactive']),
                'notes' => fake()->boolean(20) ? fake()->sentence() : null,
            ]);
        }
    }
}
