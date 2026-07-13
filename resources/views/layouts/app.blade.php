<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Timesheet App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f2f3f5] text-[#1a1a1a] min-h-screen antialiased">
    <!-- Full-Width Flex Container for Sidebar + Main Content -->
    <div class="flex min-h-screen">
        <!-- Sidebar Slot - This is where your fixed sidebar will be injected -->
        <!-- The sidebar component should use classes like: fixed top-0 left-0 h-screen w-64 z-40 -->
        
        <!-- Main Content Area - Takes remaining space after sidebar -->
        <div class="flex-1 w-full">
            <!-- Top Navigation Bar - Full Width -->
            <nav class="bg-white border-b border-[#e2e4e8] w-full">
                <div class="w-full px-6 py-4 flex flex-wrap items-center justify-between gap-4">
                    <a href="/" class="text-xl font-semibold tracking-tight text-[#1a1a1a]">Timesheet</a>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-[#6a6a6a]">
                        <a href="/dashboard" class="hover:text-[#1a1a1a] transition">Dashboard</a>
                        <a href="/attendance" class="hover:text-[#1a1a1a] transition">Attendance</a>
                        <a href="/reports" class="hover:text-[#1a1a1a] transition">Reports</a>
                        @auth
                            <form method="POST" action="/logout" class="inline">
                                @csrf
                                <button type="submit" class="rounded-full border border-[#e2e4e8] px-4 py-2 text-[#6a6a6a] hover:bg-[#f2f3f5] hover:text-[#1a1a1a] transition">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="rounded-full border border-[#e2e4e8] px-4 py-2 text-[#6a6a6a] hover:bg-[#f2f3f5] hover:text-[#1a1a1a] transition">Login</a>
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Main Content - Full Width, Fluid Padding -->
            <main class="w-full p-6 lg:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>