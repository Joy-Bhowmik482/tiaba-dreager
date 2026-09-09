<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('description', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
        }

        if ($request->filled('month')) {
            $query->whereMonth('expense_date', $request->month);
        }

        $expenses = $query->latest('expense_date')->paginate(10)->withQueryString();

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_date' => 'required|date',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ], [
            'expense_date.required' => 'তারিখ আবশ্যক।',
            'category.required' => 'খরচের ধরন আবশ্যক।',
            'description.required' => 'বিবরণ আবশ্যক।',
            'amount.required' => 'পরিমাণ আবশ্যক।',
            'amount.min' => 'পরিমাণ শূন্যের বেশি হতে হবে।',
        ]);

        $validated['created_by'] = 1;
        Expense::create($validated);

        return redirect()->route('expenses.index')->with('success', 'ব্যয় সফলভাবে সংরক্ষণ করা হয়েছে।');
    }
}
