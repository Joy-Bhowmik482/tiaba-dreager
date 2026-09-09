@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl border border-slate-200 p-6">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">নতুন লেনদেন</h1>

    <form action="{{ route('transactions.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">ক্রেতা / বিক্রেতা নির্বাচন</label>
            <select name="customer_id" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
                <option value="">একজন গ্রাহক নির্বাচন করুন</option>
                @foreach (App\Models\Customer::orderBy('name')->get() as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }} ({{ $customer->type === 'buyer' ? 'ক্রেতা' : 'বিক্রেতা' }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">লেনদেনের তারিখ</label>
            <input type="date" name="transaction_date" value="{{ old('transaction_date', now()->toDateString()) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">পরিমাণ</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">বিবরণ</label>
            <input type="text" name="description" value="{{ old('description') }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">নোট</label>
            <textarea name="notes" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">{{ old('notes') }}</textarea>
        </div>

        <div class="md:col-span-2 flex justify-end gap-3">
            <a href="{{ route('transactions.index') }}" class="px-4 py-2 rounded-lg border border-slate-300">বাতিল</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-slate-900 text-white">সংরক্ষণ করুন</button>
        </div>
    </form>
</div>
@endsection
