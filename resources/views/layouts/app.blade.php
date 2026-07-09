<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Timesheet App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900 min-h-screen antialiased">
    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-4">
            <a href="/" class="text-xl font-semibold tracking-tight">Timesheet</a>
            <div class="flex flex-wrap items-center gap-3 text-sm text-slate-600">
                <a href="/dashboard" class="hover:text-slate-900">Dashboard</a>
                <a href="/attendance" class="hover:text-slate-900">Attendance</a>
                <a href="/reports" class="hover:text-slate-900">Reports</a>
                @auth
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="rounded-full border border-slate-300 px-4 py-2 text-slate-700 hover:bg-slate-50">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-full border border-slate-300 px-4 py-2 text-slate-700 hover:bg-slate-50">Login</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="max-w-6xl mx-auto px-4 py-10">
        <div class="space-y-6">
            @yield('content')
        </div>
</main>

@stack('scripts')
</body>
</html>

