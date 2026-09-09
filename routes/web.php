<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');
Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::resource('customers', CustomerController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('transactions', TransactionController::class)->only(['index', 'create', 'store', 'show']);
Route::resource('incomes', IncomeController::class)->only(['index', 'create', 'store']);
Route::resource('expenses', ExpenseController::class)->only(['index', 'create', 'store']);

Route::get('reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
Route::get('reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
Route::get('reports/customer', [ReportController::class, 'customer'])->name('reports.customer');
Route::get('reports/financial', [ReportController::class, 'financial'])->name('reports.financial');

Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
