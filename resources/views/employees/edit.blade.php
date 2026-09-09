@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl border border-slate-200 p-6">
    <h1 class="text-2xl font-bold text-slate-900 mb-6">কর্মচারী সম্পাদনা</h1>

    <form action="{{ route('employees.update', $employee) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">কর্মচারীর নাম</label>
            <input type="text" name="name" value="{{ old('name', $employee->name) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">মোবাইল নম্বর</label>
            <input type="text" name="phone" value="{{ old('phone', $employee->phone) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">বিকল্প মোবাইল নম্বর</label>
            <input type="text" name="alternate_phone" value="{{ old('alternate_phone', $employee->alternate_phone) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">পদবী</label>
            <input type="text" name="position" value="{{ old('position', $employee->position) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">বেতন</label>
            <input type="number" step="0.01" name="salary" value="{{ old('salary', $employee->salary) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">স্ট্যাটাস</label>
            <select name="status" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
                <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>সক্রিয়</option>
                <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>নিষ্ক্রিয়</option>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">ঠিকানা</label>
            <textarea name="address" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">{{ old('address', $employee->address) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">যোগদানের তারিখ</label>
            <input type="date" name="joining_date" value="{{ old('joining_date', $employee->joining_date->format('Y-m-d')) }}" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">নোট</label>
            <textarea name="notes" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">{{ old('notes', $employee->notes) }}</textarea>
        </div>

        <div class="md:col-span-2 flex justify-end gap-3">
            <a href="{{ route('employees.index') }}" class="px-4 py-2 rounded-lg border border-slate-300">বাতিল</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-slate-900 text-white">সংরক্ষণ করুন</button>
        </div>
    </form>
</div>
@endsection
