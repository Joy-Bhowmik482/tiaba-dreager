@extends('layout')

@section('content')
<div class="space-y-5">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900">আয়ের তালিকা</h1>
        <a href="{{ route('incomes.create') }}" class="rounded-lg bg-slate-900 text-white px-4 py-2">নতুন আয়</a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left">তারিখ</th>
                        <th class="px-4 py-3 text-left">ধরণ</th>
                        <th class="px-4 py-3 text-left">বিবরণ</th>
                        <th class="px-4 py-3 text-left">পরিমাণ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incomes as $income)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $income->income_date->format('d-m-Y') }}</td>
                            <td class="px-4 py-3">{{ $income->category }}</td>
                            <td class="px-4 py-3">{{ $income->description }}</td>
                            <td class="px-4 py-3 text-emerald-600 font-semibold">৳{{ number_format($income->amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-slate-500">কোনো আয় পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t">{{ $incomes->links() }}</div>
    </div>
</div>
@endsection
