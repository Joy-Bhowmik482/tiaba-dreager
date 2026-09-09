<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>তিয়াবা ড্রেজার এন্ড বালো ঘর</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Noto Sans Bengali', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Noto Sans Bengali', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">
    <div class="min-h-screen flex">
        <aside class="w-72 bg-slate-900 text-slate-100 shadow-lg fixed inset-y-0 left-0 overflow-y-auto hidden lg:block">
            <div class="p-5 border-b border-slate-700 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-amber-500 text-slate-900 font-bold flex items-center justify-center">ত</div>
                <div>
                    <div class="text-sm font-semibold">তিয়াবা ড্রেজার</div>
                    <div class="text-xs text-slate-300">এন্ড বালো ঘর</div>
                </div>
            </div>

            <nav class="p-4 space-y-4">
                <div>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('dashboard') ? 'bg-slate-800' : '' }}">
                        <span>🏠</span>
                        <span>ড্যাশবোর্ড</span>
                    </a>
                </div>

                <div>
                    <div class="px-3 py-2 text-xs uppercase tracking-wide text-slate-400">গ্রাহক ব্যবস্থাপনা</div>
                    <div class="space-y-1 mt-1">
                        <a href="{{ route('customers.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('customers.create') ? 'bg-slate-800' : '' }}">➕ গ্রাহক যোগ করুন</a>
                        <a href="{{ route('customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('customers.index') || request()->routeIs('customers.show') || request()->routeIs('customers.edit') ? 'bg-slate-800' : '' }}">👥 গ্রাহকের তালিকা</a>
                        <a href="{{ route('customers.index', ['type' => 'buyer']) }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->query('type') === 'buyer' ? 'bg-slate-800' : '' }}">🛒 ক্রেতা</a>
                        <a href="{{ route('customers.index', ['type' => 'seller']) }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->query('type') === 'seller' ? 'bg-slate-800' : '' }}">🏪 বিক্রেতা</a>
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 text-xs uppercase tracking-wide text-slate-400">কর্মচারী ব্যবস্থাপনা</div>
                    <div class="space-y-1 mt-1">
                        <a href="{{ route('employees.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('employees.create') ? 'bg-slate-800' : '' }}">➕ কর্মচারী যোগ করুন</a>
                        <a href="{{ route('employees.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('employees.index') || request()->routeIs('employees.show') || request()->routeIs('employees.edit') ? 'bg-slate-800' : '' }}">👨‍💼 কর্মচারীর তালিকা</a>
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 text-xs uppercase tracking-wide text-slate-400">আয় / ব্যয়</div>
                    <div class="space-y-1 mt-1">
                        <a href="{{ route('transactions.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('transactions.create') ? 'bg-slate-800' : '' }}">➕ নতুন লেনদেন</a>
                        <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('transactions.index') ? 'bg-slate-800' : '' }}">📋 সকল লেনদেন</a>
                        <a href="{{ route('incomes.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('incomes.index') ? 'bg-slate-800' : '' }}">💰 আয়ের তালিকা</a>
                        <a href="{{ route('expenses.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('expenses.index') ? 'bg-slate-800' : '' }}">💸 ব্যয়ের তালিকা</a>
                        <a href="{{ route('reports.daily') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('reports.daily') ? 'bg-slate-800' : '' }}">📅 দৈনিক লেনদেন</a>
                        <a href="{{ route('reports.monthly') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('reports.monthly') ? 'bg-slate-800' : '' }}">📅 মাসিক লেনদেন</a>
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 text-xs uppercase tracking-wide text-slate-400">রিপোর্ট</div>
                    <div class="space-y-1 mt-1">
                        <a href="{{ route('reports.daily') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('reports.daily') ? 'bg-slate-800' : '' }}">📊 দৈনিক রিপোর্ট</a>
                        <a href="{{ route('reports.monthly') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('reports.monthly') ? 'bg-slate-800' : '' }}">📊 মাসিক রিপোর্ট</a>
                        <a href="{{ route('reports.customer') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('reports.customer') ? 'bg-slate-800' : '' }}">👥 গ্রাহক রিপোর্ট</a>
                        <a href="{{ route('reports.financial') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('reports.financial') ? 'bg-slate-800' : '' }}">💰 আয় রিপোর্ট</a>
                        <a href="{{ route('reports.financial') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('reports.financial') ? 'bg-slate-800' : '' }}">💸 ব্যয় রিপোর্ট</a>
                        <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('transactions.index') ? 'bg-slate-800' : '' }}">📈 লেনদেন রিপোর্ট</a>
                    </div>
                </div>

                <div>
                    <div class="px-3 py-2 text-xs uppercase tracking-wide text-slate-400">সেটিংস</div>
                    <div class="space-y-1 mt-1">
                        <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('settings.index') ? 'bg-slate-800' : '' }}">⚙️ সাধারণ সেটিংস</a>
                        <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('settings.index') ? 'bg-slate-800' : '' }}">🏢 ব্যবসার তথ্য</a>
                        <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-800 {{ request()->routeIs('settings.index') ? 'bg-slate-800' : '' }}">🔐 ব্যবহারকারী / নিরাপত্তা</a>
                    </div>
                </div>
            </nav>
        </aside>

        <div class="flex-1 lg:ml-72 min-h-screen">
            <header class="bg-white shadow-sm sticky top-0 z-20">
                <div class="max-w-full px-4 py-3 flex items-center gap-4">
                    <button class="lg:hidden text-xl">☰</button>
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" placeholder="অনুসন্ধান করুন..." class="w-full border border-slate-200 rounded-xl py-2.5 pl-10 pr-4 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400">
                            <span class="absolute left-3 top-3 text-slate-400">🔍</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-100 rounded-full px-3 py-2">
                        <div class="w-9 h-9 rounded-full bg-amber-500 text-slate-900 flex items-center justify-center font-bold">ট</div>
                        <div class="text-sm">
                            <div class="font-semibold">টিম</div>
                            <div class="text-xs text-slate-500">অ্যাডমিন</div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-5 md:p-6">
                @if (session('success'))
                    <div class="mb-4 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 text-red-800 px-4 py-3">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
