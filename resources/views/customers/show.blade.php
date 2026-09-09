@extends('layout')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">{{ $customer->name }}</h1>
                <p class="text-sm text-slate-500">গ্রাহক আইডি: {{ $customer->customer_code }}</p>
            </div>
            <div class="text-right">
                <div class="text-sm text-slate-500">বর্তমান ব্যালেন্স</div>
                <div class="text-2xl font-bold {{ $customer->current_balance >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">৳{{ number_format($customer->current_balance, 2) }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">মোবাইল</div><div class="mt-2 font-medium">{{ $customer->phone ?? '-' }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">ধরন</div><div class="mt-2 font-medium">{{ $customer->type === 'buyer' ? 'ক্রেতা' : 'বিক্রেতা' }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">মোট লেনদেন</div><div class="mt-2 font-medium">{{ $customer->transactions()->count() }}</div></div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="p-4 border-b font-semibold">লেনদেনের ইতিহাস</div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left">তারিখ</th>
                        <th class="px-4 py-3 text-left">লেনদেন নম্বর</th>
                        <th class="px-4 py-3 text-left">বিবরণ</th>
                        <th class="px-4 py-3 text-left">ডেবিট</th>
                        <th class="px-4 py-3 text-left">ক্রেডিট</th>
                        <th class="px-4 py-3 text-left">ব্যালেন্স</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $transaction->transaction_date->format('d-m-Y') }}</td>
                            <td class="px-4 py-3">{{ $transaction->transaction_code }}</td>
                            <td class="px-4 py-3">{{ $transaction->description }}</td>
                            <td class="px-4 py-3">{{ $transaction->type === 'debit' ? '৳' . number_format($transaction->amount, 2) : '-' }}</td>
                            <td class="px-4 py-3">{{ $transaction->type === 'credit' ? '৳' . number_format($transaction->amount, 2) : '-' }}</td>
                            <td class="px-4 py-3">৳{{ number_format($customer->current_balance, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
