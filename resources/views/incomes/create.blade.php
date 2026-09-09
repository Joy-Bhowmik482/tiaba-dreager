@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl border border-slate-200 p-6">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">নতুন আয়</h1>

    <form action="{{ route('incomes.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">তারিখ</label>
            <input type="date" name="income_date" value="{{ old('income_date', now()->toDateString()) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">ধরণ</label>
            <input type="text" name="category" value="{{ old('category') }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
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
            <a href="{{ route('incomes.index') }}" class="px-4 py-2 rounded-lg border border-slate-300">বাতিল</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-slate-900 text-white">সংরক্ষণ করুন</button>
        </div>
    </form>
</div>
@endsection
