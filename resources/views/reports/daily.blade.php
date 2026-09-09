@extends('layout')

@section('content')
<div class="space-y-5">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <h1 class="text-2xl font-bold text-slate-900">দৈনিক রিপোর্ট</h1>
        <form method="GET" class="mt-4 flex gap-3 items-center">
            <input type="date" name="date" value="{{ $date }}" class="border rounded-lg px-3 py-2">
            <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-lg">প্রদর্শন</button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">মোট লেনদেন</div><div class="mt-2 text-2xl font-bold">{{ $totalTransactions }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">মোট ক্রেডিট</div><div class="mt-2 text-2xl font-bold text-emerald-600">৳{{ number_format($totalCredit, 2) }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">মোট ডেবিট</div><div class="mt-2 text-2xl font-bold text-rose-600">৳{{ number_format($totalDebit, 2) }}</div></div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left">তারিখ</th>
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
                        <td class="px-4 py-3">{{ $transaction->customer?->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $transaction->type === 'credit' ? 'ক্রেডিট' : 'ডেবিট' }}</td>
                        <td class="px-4 py-3">৳{{ number_format($transaction->amount, 2) }}</td>
                        <td class="px-4 py-3">{{ $transaction->description }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">কোনো লেনদেন পাওয়া যায়নি।</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
