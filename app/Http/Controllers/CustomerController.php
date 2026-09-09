<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('customer_code', 'like', "%{$search}%");
            });
        }

        $customers = $query->latest()->paginate(10)->withQueryString();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alternate_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'type' => 'required|in:buyer,seller',
            'opening_balance' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ], [
            'name.required' => 'গ্রাহকের নাম আবশ্যক।',
            'type.required' => 'গ্রাহকের ধরন আবশ্যক।',
            'type.in' => 'গ্রাহকের ধরন সঠিক না হলে নির্বাচন করুন।',
            'opening_balance.numeric' => 'প্রারম্ভিক ব্যালেন্স অবশ্যই সংখ্যা হতে হবে।',
            'opening_balance.min' => 'প্রারম্ভিক ব্যালেন্স শূন্যের বেশি হতে হবে।',
        ]);

        $validated['customer_code'] = 'CUST-' . strtoupper(Str::random(6));

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'গ্রাহক সফলভাবে যোগ করা হয়েছে।');
    }

    public function show(Customer $customer)
    {
        $transactions = $customer->transactions()->latest('transaction_date')->paginate(10);

        return view('customers.show', compact('customer', 'transactions'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alternate_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'type' => 'required|in:buyer,seller',
            'opening_balance' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ], [
            'name.required' => 'গ্রাহকের নাম আবশ্যক।',
            'type.required' => 'গ্রাহকের ধরন আবশ্যক।',
            'opening_balance.numeric' => 'প্রারম্ভিক ব্যালেন্স সংখ্যায় দিন।',
            'opening_balance.min' => 'প্রারম্ভিক ব্যালেন্স শূন্যের বেশি হতে হবে।',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'গ্রাহকের তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'তথ্য সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
