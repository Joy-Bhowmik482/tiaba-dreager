@extends('layout')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">লেনদেন তালিকা</h1>
        </div>
        <a href="{{ route('transactions.create') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-900 text-white px-4 py-2">নতুন লেনদেন</a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="লেনদেন নম্বর / বিবরণ" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
            <select name="customer_id" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
                <option value="">সব গ্রাহক</option>
                @foreach (
                    App\Models\Customer::orderBy('name')->get() as $customer
                )
                    <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                @endforeach
            </select>
            <select name="type" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
                <option value="all" {{ request('type') == 'all' || !request('type') ? 'selected' : '' }}>সব ধরন</option>
                <option value="credit" {{ request('type') == 'credit' ? 'selected' : '' }}>ক্রেডিট</option>
                <option value="debit" {{ request('type') == 'debit' ? 'selected' : '' }}>ডেবিট</option>
            </select>
            <button class="bg-amber-500 text-slate-900 font-semibold rounded-lg px-4 py-2">ফিল্টার</button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-left">তারিখ</th>
                        <th class="px-4 py-3 text-left">লেনদেন কোড</th>
                        <th class="px-4 py-3 text-left">গ্রাহক</th>
                        <th class="px-4 py-3 text-left">ধরন</th>
                        <th class="px-4 py-3 text-left">পরিমাণ</th>
                        <th class="px-4 py-3 text-left">বিবরণ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $transaction->transaction_date->format('d-m-Y') }}</td>
                            <td class="px-4 py-3">{{ $transaction->transaction_code }}</td>
                            <td class="px-4 py-3">{{ $transaction->customer?->name ?? '-' }}</td>
                            <td class="px-4 py-3"><span class="px-2 py-1 rounded-full {{ $transaction->type === 'credit' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">{{ $transaction->type === 'credit' ? 'ক্রেডিট' : 'ডেবিট' }}</span></td>
                            <td class="px-4 py-3">৳{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-4 py-3">{{ $transaction->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500">কোনো লেনদেন পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
