<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request)
    {
        $query = Transaction::with('customer')->latest('transaction_date');

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('transaction_code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $transactions = $query->paginate(10)->withQueryString();
        $customers = Customer::orderBy('name')->get();

        return view('transactions.index', compact('transactions', 'customers'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        return view('transactions.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ], [
            'customer_id.required' => 'গ্রাহক নির্বাচন করুন।',
            'transaction_date.required' => 'লেনদেনের তারিখ আবশ্যক।',
            'amount.required' => 'পরিমাণ আবশ্যক।',
            'amount.min' => 'পরিমাণ অবশ্যই শূন্যের বেশি হতে হবে।',
            'description.required' => 'বিবরণ আবশ্যক।',
        ]);

        $customer = Customer::findOrFail($validated['customer_id']);
        $validated['transaction_code'] = 'TXN-' . strtoupper(Str::random(8));
        $validated['type'] = $this->transactionService->determineType($customer);
        $validated['created_by'] = 1;

        $this->transactionService->createTransaction($validated);

        return redirect()->route('transactions.index')->with('success', 'লেনদেন সফলভাবে সংরক্ষণ করা হয়েছে।');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }
}
