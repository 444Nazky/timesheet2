<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Timesheet App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white p-4 shadow">
        <div class="max-w-4xl mx-auto flex justify-between">
            <a href="/" class="font-bold">TimesheetApp</a>
            <div class="flex gap-4">
                <a href="/reports">Reports</a>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <main class="max-w-4xl mx-auto p-6">
        @yield('content')
    </main>
</body>
</html>
