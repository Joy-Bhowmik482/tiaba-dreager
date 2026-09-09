<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 20) as $i) {
            Customer::create([
                'customer_code' => 'CUST-' . strtoupper(Str::random(6)),
                'name' => fake()->name(),
                'phone' => fake()->numerify('01#########'),
                'alternate_phone' => fake()->boolean(40) ? fake()->numerify('01#########') : null,
                'address' => fake()->address(),
                'type' => fake()->randomElement(['buyer', 'seller']),
                'opening_balance' => fake()->randomFloat(2, 0, 50000),
                'notes' => fake()->boolean(30) ? fake()->sentence() : null,
            ]);
        }
    }
}
