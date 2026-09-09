@extends('layout')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">ড্যাশবোর্ড</h1>
            <p class="text-sm text-slate-500">ব্যবসার সামগ্রিক সারাংশ</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <a href="{{ route('customers.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md">
            <div class="text-sm text-slate-500">মোট গ্রাহক</div>
            <div class="mt-3 text-3xl font-bold text-slate-900">{{ $customerCount }}</div>
        </a>
        <a href="{{ route('customers.index', ['type' => 'buyer']) }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md">
            <div class="text-sm text-slate-500">মোট ক্রেতা</div>
            <div class="mt-3 text-3xl font-bold text-slate-900">{{ $buyerCount }}</div>
        </a>
        <a href="{{ route('customers.index', ['type' => 'seller']) }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md">
            <div class="text-sm text-slate-500">মোট বিক্রেতা</div>
            <div class="mt-3 text-3xl font-bold text-slate-900">{{ $sellerCount }}</div>
        </a>
        <a href="{{ route('employees.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md">
            <div class="text-sm text-slate-500">মোট কর্মচারী</div>
            <div class="mt-3 text-3xl font-bold text-slate-900">{{ $employeeCount }}</div>
        </a>
        <a href="{{ route('incomes.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md">
            <div class="text-sm text-slate-500">মোট আয়</div>
            <div class="mt-3 text-3xl font-bold text-emerald-600">৳{{ number_format($totalIncome, 2) }}</div>
        </a>
        <a href="{{ route('expenses.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md">
            <div class="text-sm text-slate-500">মোট ব্যয়</div>
            <div class="mt-3 text-3xl font-bold text-rose-600">৳{{ number_format($totalExpense, 2) }}</div>
        </a>
        <a href="{{ route('transactions.index') }}" class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 hover:shadow-md">
            <div class="text-sm text-slate-500">মোট লেনদেন</div>
            <div class="mt-3 text-3xl font-bold text-slate-900">{{ $totalTransactions }}</div>
        </a>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="text-sm text-slate-500">বর্তমান ব্যালেন্স</div>
            <div class="mt-3 text-3xl font-bold {{ $currentBalance >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">৳{{ number_format($currentBalance, 2) }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">মাসভিত্তিক আয় ও ব্যয়</h2>
            </div>
            <div class="space-y-3">
                @foreach ($monthlyData as $item)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span>{{ $item['month'] }}</span>
                            <span class="text-slate-500">আয়: ৳{{ number_format($item['income'], 2) }} / ব্যয়: ৳{{ number_format($item['expense'], 2) }}</span>
                        </div>
                        <div class="h-2 bg-slate-100 rounded-full overflow-hidden flex">
                            <div class="h-full bg-emerald-500" style="width: {{ min(($item['income'] / max(1, max(array_column($monthlyData, 'income')))) * 100, 100) }}%"></div>
                            <div class="h-full bg-rose-500" style="width: {{ min(($item['expense'] / max(1, max(array_column($monthlyData, 'expense')))) * 100, 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">সাম্প্রতিক লেনদেন</h2>
                <a href="{{ route('transactions.index') }}" class="text-sm text-amber-600 font-medium">সব দেখুন</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="py-2">তারিখ</th>
                            <th class="py-2">লেনদেন নম্বর</th>
                            <th class="py-2">গ্রাহক</th>
                            <th class="py-2">ধরন</th>
                            <th class="py-2">পরিমাণ</th>
                            <th class="py-2">অবস্থা</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentTransactions as $transaction)
                            <tr class="border-b">
                                <td class="py-3">{{ $transaction->transaction_date->format('d-m-Y') }}</td>
                                <td class="py-3">{{ $transaction->transaction_code }}</td>
                                <td class="py-3">{{ $transaction->customer?->name ?? '-' }}</td>
                                <td class="py-3">{{ $transaction->type === 'credit' ? 'ক্রেডিট' : 'ডেবিট' }}</td>
                                <td class="py-3">৳{{ number_format($transaction->amount, 2) }}</td>
                                <td class="py-3"><span class="px-2 py-1 rounded-full {{ $transaction->type === 'credit' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">{{ $transaction->type === 'credit' ? 'ক্রেডিট' : 'ডেবিট' }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
