@extends('layout')

@section('content')
<div class="space-y-5">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <h1 class="text-2xl font-bold text-slate-900">আর্থিক রিপোর্ট</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">মোট আয়</div><div class="mt-2 text-2xl font-bold text-emerald-600">৳{{ number_format($income, 2) }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">মোট ব্যয়</div><div class="mt-2 text-2xl font-bold text-rose-600">৳{{ number_format($expense, 2) }}</div></div>
        <div class="bg-white rounded-xl border p-4"><div class="text-sm text-slate-500">নিট অমুন্নত</div><div class="mt-2 text-2xl font-bold {{ $net >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">৳{{ number_format($net, 2) }}</div></div>
    </div>
</div>
@endsection
