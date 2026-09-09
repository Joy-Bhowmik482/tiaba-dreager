<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Income::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('description', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
        }

        if ($request->filled('month')) {
            $query->whereMonth('income_date', $request->month);
        }

        $incomes = $query->latest('income_date')->paginate(10)->withQueryString();

        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'income_date' => 'required|date',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ], [
            'income_date.required' => 'তারিখ আবশ্যক।',
            'category.required' => 'উৎস আবশ্যক।',
            'description.required' => 'বিবরণ আবশ্যক।',
            'amount.required' => 'পরিমাণ আবশ্যক।',
            'amount.min' => 'পরিমাণ শূন্যের বেশি হতে হবে।',
        ]);

        $validated['created_by'] = 1;
        Income::create($validated);

        return redirect()->route('incomes.index')->with('success', 'আয় সফলভাবে সংরক্ষণ করা হয়েছে।');
    }
}
