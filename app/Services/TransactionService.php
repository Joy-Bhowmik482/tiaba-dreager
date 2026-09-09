<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function determineType(Customer $customer): string
    {
        return $customer->type === 'buyer' ? 'credit' : 'debit';
    }

    public function createTransaction(array $data): Transaction
    {
        return DB::transaction(function () use ($data) {
            $customer = Customer::findOrFail($data['customer_id']);
            $type = $this->determineType($customer);

            return Transaction::create([
                'transaction_code' => $data['transaction_code'] ?? 'TXN-' . now()->format('YmdHis') . '-' . random_int(100, 999),
                'customer_id' => $customer->id,
                'transaction_date' => $data['transaction_date'],
                'type' => $type,
                'amount' => $data['amount'],
                'description' => $data['description'],
                'notes' => $data['notes'] ?? null,
                'created_by' => $data['created_by'] ?? 1,
            ]);
        });
    }
}
