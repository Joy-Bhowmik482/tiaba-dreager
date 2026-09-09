@extends('layout')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">গ্রাহকের তালিকা</h1>
        </div>
        <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-900 text-white px-4 py-2">গ্রাহক যোগ করুন</a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="অনুসন্ধান করুন..." class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
            <select name="type" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
                <option value="all" {{ request('type') == 'all' || !request('type') ? 'selected' : '' }}>সব</option>
                <option value="buyer" {{ request('type') == 'buyer' ? 'selected' : '' }}>ক্রেতা</option>
                <option value="seller" {{ request('type') == 'seller' ? 'selected' : '' }}>বিক্রেতা</option>
            </select>
            <button class="bg-amber-500 text-slate-900 font-semibold rounded-lg px-4 py-2">ফিল্টার</button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-left">ক্রমিক</th>
                        <th class="px-4 py-3 text-left">গ্রাহক আইডি</th>
                        <th class="px-4 py-3 text-left">নাম</th>
                        <th class="px-4 py-3 text-left">মোবাইল</th>
                        <th class="px-4 py-3 text-left">ধরন</th>
                        <th class="px-4 py-3 text-left">ব্যালেন্স</th>
                        <th class="px-4 py-3 text-left">যোগদানের তারিখ</th>
                        <th class="px-4 py-3 text-left">কার্যক্রম</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $loop->iteration + ($customers->currentPage()-1)*$customers->perPage() }}</td>
                            <td class="px-4 py-3">{{ $customer->customer_code }}</td>
                            <td class="px-4 py-3">{{ $customer->name }}</td>
                            <td class="px-4 py-3">{{ $customer->phone ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $customer->type === 'buyer' ? 'ক্রেতা' : 'বিক্রেতা' }}</td>
                            <td class="px-4 py-3">৳{{ number_format($customer->current_balance, 2) }}</td>
                            <td class="px-4 py-3">{{ $customer->created_at->format('d-m-Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('customers.show', $customer) }}" class="px-3 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-600 hover:bg-blue-100">দেখুন</a>
                                    <a href="{{ route('customers.edit', $customer) }}" class="px-3 py-1 rounded-md text-xs font-medium bg-amber-50 text-amber-600 hover:bg-amber-100">সম্পাদনা</a>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('আপনি কি এই গ্রাহককে মুছে ফেলতে চান?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 rounded-md text-xs font-medium bg-red-50 text-red-600 hover:bg-red-100">মুছে ফেলুন</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-slate-500">কোনো তথ্য পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection
