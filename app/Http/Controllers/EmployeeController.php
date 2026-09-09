<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('employee_code', 'like', "%{$search}%");
            });
        }

        $employees = $query->latest()->paginate(10)->withQueryString();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alternate_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
        ], [
            'name.required' => 'কর্মচারীর নাম আবশ্যক।',
            'position.required' => 'পদবী আবশ্যক।',
            'salary.required' => 'বেতন আবশ্যক।',
            'salary.numeric' => 'বেতন অবশ্যই সংখ্যা হতে হবে।',
            'joining_date.required' => 'যোগদানের তারিখ আবশ্যক।',
            'status.required' => 'স্ট্যাটাস আবশ্যক।',
        ]);

        $validated['employee_code'] = 'EMP-' . strtoupper(Str::random(6));

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'কর্মচারী সফলভাবে যোগ করা হয়েছে।');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'alternate_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
        ], [
            'name.required' => 'কর্মচারীর নাম আবশ্যক।',
            'position.required' => 'পদবী আবশ্যক।',
            'salary.required' => 'বেতন আবশ্যক।',
            'salary.numeric' => 'বেতন অবশ্যই সংখ্যা হতে হবে।',
            'joining_date.required' => 'যোগদানের তারিখ আবশ্যক।',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'কর্মচারীর তথ্য সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'তথ্য সফলভাবে মুছে ফেলা হয়েছে।');
    }
}
