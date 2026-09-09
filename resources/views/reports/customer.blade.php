@extends('layout')

@section('content')
<div class="space-y-5">
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <h1 class="text-2xl font-bold text-slate-900">গ্রাহক রিপোর্ট</h1>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left">নাম</th>
                        <th class="px-4 py-3 text-left">ধরন</th>
                        <th class="px-4 py-3 text-left">ক্রেডিট</th>
                        <th class="px-4 py-3 text-left">ডেবিট</th>
                        <th class="px-4 py-3 text-left">ব্যালেন্স</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $customer['name'] }}</td>
                            <td class="px-4 py-3">{{ $customer['type'] === 'buyer' ? 'ক্রেতা' : 'বিক্রেতা' }}</td>
                            <td class="px-4 py-3">৳{{ number_format($customer['credit'], 2) }}</td>
                            <td class="px-4 py-3">৳{{ number_format($customer['debit'], 2) }}</td>
                            <td class="px-4 py-3 {{ $customer['balance'] >= 0 ? 'text-emerald-600' : 'text-rose-600' }} font-semibold">৳{{ number_format($customer['balance'], 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">কোনো গ্রাহক পাওয়া যায়নি।</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
