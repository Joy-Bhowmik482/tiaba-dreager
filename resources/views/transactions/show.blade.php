@extends('layout')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex flex-col md:flex-row md:justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">লেনদেনের বিস্তারিত</h1>
                <p class="text-sm text-slate-500">{{ $transaction->transaction_code }}</p>
            </div>
            <span class="px-3 py-1 rounded-full {{ $transaction->type === 'credit' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">{{ $transaction->type === 'credit' ? 'ক্রেডিট' : 'ডেবিট' }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">গ্রাহক</div><div class="mt-2 font-medium">{{ $transaction->customer?->name ?? '-' }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">তারিখ</div><div class="mt-2 font-medium">{{ $transaction->transaction_date->format('d-m-Y') }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">পরিমাণ</div><div class="mt-2 font-medium">৳{{ number_format($transaction->amount, 2) }}</div></div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="text-sm text-slate-500">বিবরণ</div>
        <div class="mt-2 text-lg">{{ $transaction->description }}</div>
        @if ($transaction->notes)
            <div class="mt-4 text-sm text-slate-600">নোট: {{ $transaction->notes }}</div>
        @endif
    </div>
</div>
@endsection
