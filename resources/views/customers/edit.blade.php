@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl border border-slate-200 p-6">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">গ্রাহক সম্পাদনা</h1>

    <form action="{{ route('customers.update', $customer) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">গ্রাহকের নাম</label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">মোবাইল নম্বর</label>
            <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">বিকল্প মোবাইল নম্বর</label>
            <input type="text" name="alternate_phone" value="{{ old('alternate_phone', $customer->alternate_phone) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">গ্রাহকের ধরন</label>
            <select name="type" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
                <option value="buyer" {{ old('type', $customer->type) == 'buyer' ? 'selected' : '' }}>ক্রেতা</option>
                <option value="seller" {{ old('type', $customer->type) == 'seller' ? 'selected' : '' }}>বিক্রেতা</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">ঠিকানা</label>
            <textarea name="address" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">{{ old('address', $customer->address) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">প্রারম্ভিক ব্যালেন্স</label>
            <input type="number" step="0.01" name="opening_balance" value="{{ old('opening_balance', $customer->opening_balance) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">নোট</label>
            <textarea name="notes" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">{{ old('notes', $customer->notes) }}</textarea>
        </div>

        <div class="md:col-span-2 flex justify-end gap-3">
            <a href="{{ route('customers.index') }}" class="px-4 py-2 rounded-lg border border-slate-300">বাতিল</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-slate-900 text-white">সংরক্ষণ করুন</button>
        </div>
    </form>
</div>
@endsection
