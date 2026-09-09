<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function daily()
    {
        $date = request('date', now()->toDateString());

        $transactions = Transaction::with('customer')->whereDate('transaction_date', $date)->get();
        $totalTransactions = $transactions->count();
        $totalCredit = $transactions->where('type', 'credit')->sum('amount');
        $totalDebit = $transactions->where('type', 'debit')->sum('amount');
        $netAmount = $totalCredit - $totalDebit;

        return view('reports.daily', compact('date', 'transactions', 'totalTransactions', 'totalCredit', 'totalDebit', 'netAmount'));
    }

    public function monthly()
    {
        $month = request('month', now()->month);
        $year = request('year', now()->year);

        $transactions = Transaction::with('customer')
            ->whereMonth('transaction_date', $month)
            ->whereYear('transaction_date', $year)
            ->get();

        $totalTransactions = $transactions->count();
        $totalCredit = $transactions->where('type', 'credit')->sum('amount');
        $totalDebit = $transactions->where('type', 'debit')->sum('amount');
        $netBalance = $totalCredit - $totalDebit;

        return view('reports.monthly', compact('month', 'year', 'transactions', 'totalTransactions', 'totalCredit', 'totalDebit', 'netBalance'));
    }

    public function customer()
    {
        $customers = Customer::with('transactions')->get()->map(function ($customer) {
            $credit = $customer->transactions()->where('type', 'credit')->sum('amount');
            $debit = $customer->transactions()->where('type', 'debit')->sum('amount');

            return [
                'name' => $customer->name,
                'type' => $customer->type,
                'credit' => $credit,
                'debit' => $debit,
                'balance' => $credit - $debit + (float) $customer->opening_balance,
            ];
        });

        return view('reports.customer', compact('customers'));
    }

    public function financial()
    {
        $income = Income::sum('amount');
        $expense = Expense::sum('amount');
        $net = $income - $expense;

        return view('reports.financial', compact('income', 'expense', 'net'));
    }
}
