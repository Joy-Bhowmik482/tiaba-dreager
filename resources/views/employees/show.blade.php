@extends('layout')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">{{ $employee->name }}</h1>
                <p class="text-sm text-slate-500">কর্মচারী আইডি: {{ $employee->employee_code }}</p>
            </div>
            <div class="text-right">
                <div class="text-sm text-slate-500">স্ট্যাটাস</div>
                <div class="text-lg font-semibold {{ $employee->status === 'active' ? 'text-emerald-600' : 'text-slate-600' }}">{{ $employee->status === 'active' ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">পদবী</div><div class="mt-2 font-medium">{{ $employee->position }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">বেতন</div><div class="mt-2 font-medium">৳{{ number_format($employee->salary, 2) }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">যোগদানের তারিখ</div><div class="mt-2 font-medium">{{ $employee->joining_date->format('d-m-Y') }}</div></div>
    </div>
</div>
@endsection
