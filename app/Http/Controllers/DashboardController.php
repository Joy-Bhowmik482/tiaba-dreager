<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $customerCount = Customer::count();
        $buyerCount = Customer::where('type', 'buyer')->count();
        $sellerCount = Customer::where('type', 'seller')->count();
        $employeeCount = Employee::count();

        $totalIncome = Income::sum('amount');
        $totalExpense = Expense::sum('amount');
        $totalTransactions = Transaction::count();
        $currentBalance = $totalIncome - $totalExpense;

        $recentTransactions = Transaction::with('customer')
            ->latest('transaction_date')
            ->limit(6)
            ->get();

        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $income = Income::whereMonth('income_date', $month)->whereYear('income_date', now()->year)->sum('amount');
            $expense = Expense::whereMonth('expense_date', $month)->whereYear('expense_date', now()->year)->sum('amount');

            $monthlyData[] = [
                'month' => $monthName,
                'income' => (float) $income,
                'expense' => (float) $expense,
            ];
        }

        return view('dashboard', compact(
            'customerCount',
            'buyerCount',
            'sellerCount',
            'employeeCount',
            'totalIncome',
            'totalExpense',
            'totalTransactions',
            'currentBalance',
            'recentTransactions',
            'monthlyData'
        ));
    }
}
