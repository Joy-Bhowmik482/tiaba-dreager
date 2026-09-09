@extends('layout')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col md:flex-row gap-3 md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">কর্মচারীর তালিকা</h1>
        </div>
        <a href="{{ route('employees.create') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-900 text-white px-4 py-2">কর্মচারী যোগ করুন</a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="অনুসন্ধান করুন..." class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
            <select name="status" class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-300">
                <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>সব</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>সক্রিয়</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>নিষ্ক্রিয়</option>
            </select>
            <button class="bg-amber-500 text-slate-900 font-semibold rounded-lg px-4 py-2">ফিল্টার</button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-left">কর্মচারী আইডি</th>
                        <th class="px-4 py-3 text-left">নাম</th>
                        <th class="px-4 py-3 text-left">মোবাইল</th>
                        <th class="px-4 py-3 text-left">পদবী</th>
                        <th class="px-4 py-3 text-left">বেতন</th>
                        <th class="px-4 py-3 text-left">যোগদানের তারিখ</th>
                        <th class="px-4 py-3 text-left">স্ট্যাটাস</th>
                        <th class="px-4 py-3 text-left">কার্যক্রম</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $employee->employee_code }}</td>
                            <td class="px-4 py-3">{{ $employee->name }}</td>
                            <td class="px-4 py-3">{{ $employee->phone ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $employee->position }}</td>
                            <td class="px-4 py-3">৳{{ number_format($employee->salary, 2) }}</td>
                            <td class="px-4 py-3">{{ $employee->joining_date->format('d-m-Y') }}</td>
                            <td class="px-4 py-3"><span class="px-2 py-1 rounded-full {{ $employee->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">{{ $employee->status === 'active' ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}</span></td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('employees.show', $employee) }}" class="px-3 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-600 hover:bg-blue-100">দেখুন</a>
                                    <a href="{{ route('employees.edit', $employee) }}" class="px-3 py-1 rounded-md text-xs font-medium bg-amber-50 text-amber-600 hover:bg-amber-100">সম্পাদনা</a>
                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('আপনি কি এই কর্মচারীকে মুছে ফেলতে চান?')">
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
            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection
