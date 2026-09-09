@extends('layout')

@section('content')
<div class="space-y-5">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <h1 class="text-2xl font-bold text-slate-900">সাধারণ সেটিংস</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <h2 class="text-lg font-semibold mb-4">ব্যবসার তথ্য</h2>
            <div class="space-y-3 text-sm">
                <div><span class="text-slate-500">ব্যবসার নাম:</span> তিয়াবা ড্রেজার এন্ড বালো ঘর</div>
                <div><span class="text-slate-500">ঠিকানা:</span> আপনার ব্যবসার ঠিকানা</div>
                <div><span class="text-slate-500">ফোন:</span> +৮৮ ০১৭xx-xxxxxx</div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <h2 class="text-lg font-semibold mb-4">ব্যবহারকারীর তথ্য</h2>
            <div class="space-y-3 text-sm">
                <div><span class="text-slate-500">ইউজার:</span> Admin</div>
                <div><span class="text-slate-500">ভূমিকা:</span> সুপার অ্যাডমিন</div>
                <div><span class="text-slate-500">শেষ আপডেট:</span> {{ now()->format('d-m-Y') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
