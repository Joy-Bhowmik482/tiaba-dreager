<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $customerIds = Customer::pluck('id');

        if ($customerIds->isEmpty()) {
            return;
        }

        foreach (range(1, 40) as $i) {
            Transaction::create([
                'transaction_code' => 'TXN-' . strtoupper(Str::random(8)),
                'customer_id' => $customerIds->random(),
                'transaction_date' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                'type' => fake()->randomElement(['credit', 'debit']),
                'amount' => fake()->randomFloat(2, 500, 100000),
                'description' => fake()->randomElement([
                    'বালি বিক্রয়', 'পাথর সরবরাহ', 'পরিবহন খরচ', 'অগ্রিম পরিশোধ', 'বকেয়া পরিশোধ',
                ]),
                'notes' => fake()->boolean(25) ? fake()->sentence() : null,
                'created_by' => null,
            ]);
        }
    }
}
