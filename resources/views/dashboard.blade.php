<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.85); }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes countdown-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        
        .animate-pulse-dot {
            animation: pulse-dot 2s infinite;
        }
        .animate-slide-up {
            animation: slide-up 0.4s ease-out forwards;
        }
        .countdown-pulse {
            animation: countdown-pulse 0.8s ease-in-out 3;
        }
        
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #c8c8c8;
            border-radius: 20px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
        
        .nav-item {
            transition: all 0.2s ease;
            position: relative;
        }
        .nav-item::after {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 2.5px;
            height: 60%;
            background: #1a1a1a;
            transition: transform 0.25s ease;
            border-radius: 0 4px 4px 0;
        }
        .nav-item:hover::after {
            transform: translateY(-50%) scaleY(1);
        }
        .nav-item.active::after {
            transform: translateY(-50%) scaleY(1);
        }
        
        .task-item {
            transition: all 0.2s ease;
        }
        .task-item:hover {
            background: #f6f6f6;
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 32px -12px rgba(0, 0, 0, 0.06);
        }
        
        input:focus, button:focus {
            outline: none;
        }
        input:focus-visible, button:focus-visible {
            outline: 2px solid #1a1a1a;
            outline-offset: 2px;
        }
        
        .tracking-tight {
            letter-spacing: -0.02em;
        }
        
        .timer-display {
            font-variant-numeric: tabular-nums;
        }
        
        .mode-btn {
            transition: all 0.2s ease;
        }
        .mode-btn.active {
            background: #1a1a1a;
            color: #f6f7f9;
        }
        .mode-btn:not(.active):hover {
            background: #eceef0;
        }
        
        .countdown-input {
            width: 56px;
            text-align: center;
            background: #f2f3f5;
            border: 1px solid #e2e4e8;
            border-radius: 8px;
            padding: 4px 6px;
            font-size: 14px;
            font-weight: 600;
            color: #1a1a1a;
            transition: all 0.2s ease;
        }
        .countdown-input:focus {
            border-color: #1a1a1a;
            background: #f6f7f9;
        }
        .countdown-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
        .countdown-input[type="number"] {
            -moz-appearance: textfield;
        }
        
        .progress-bar-transition {
            transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="min-h-screen bg-[#f2f3f5] text-[#1a1a1a] antialiased selection:bg-[#1a1a1a] selection:text-[#f2f3f5]">
    <div class="flex min-h-screen flex-col lg:flex-row">
        <!-- Sidebar -->
        <aside class="w-full border-b border-[#e2e4e8] bg-[#f6f7f9] px-6 py-6 lg:w-64 lg:border-b-0 lg:border-r lg:fixed lg:h-screen lg:overflow-y-auto">
            <div class="mb-10 flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] text-xs font-black tracking-wider text-[#1a1a1a]">
                    03
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.3em] text-[#8a8a8a]">Workspace</p>
                    <p class="text-sm font-semibold text-[#1a1a1a]">TimeSheet</p>
                </div>
            </div>

            <nav class="space-y-1">
                @php
                    $navItems = [
                        ['label' => 'Dashboard', 'icon' => 'fa-th-large', 'active' => request()->routeIs('dashboard'), 'href' => route('dashboard'), 'badge' => null],
                        ['label' => 'Projects', 'icon' => 'fa-briefcase', 'active' => request()->routeIs('projects'), 'href' => route('projects'), 'badge' => '12'],
                        ['label' => 'My Task', 'icon' => 'fa-tasks', 'active' => request()->routeIs('tasks'), 'href' => route('tasks'), 'badge' => '5'],
                        ['label' => 'Calendar', 'icon' => 'fa-calendar-alt', 'active' => request()->routeIs('calendar'), 'href' => route('calendar'), 'badge' => null],
                        ['label' => 'Time Manage', 'icon' => 'fa-clock', 'active' => request()->routeIs('time-manage'), 'href' => route('time-manage'), 'badge' => '3'],
                        ['label' => 'Reports', 'icon' => 'fa-chart-bar', 'active' => request()->routeIs('reports'), 'href' => route('reports'), 'badge' => null],
                        ['label' => 'Settings', 'icon' => 'fa-cog', 'active' => request()->routeIs('settings'), 'href' => route('settings'), 'badge' => null],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <a href="{{ $item['href'] }}" class="nav-item flex items-center justify-between rounded-xl px-4 py-2.5 text-xs font-medium tracking-wide transition-all duration-200 {{ $item['active'] ? 'active bg-[#eceef0] text-[#1a1a1a]' : 'text-[#6a6a6a] hover:bg-[#eceef0] hover:text-[#1a1a1a]' }}">
                        <span class="flex items-center gap-3">
                            <i class="fas {{ $item['icon'] }} w-4 text-center text-sm"></i>
                            {{ $item['label'] }}
                        </span>
                        @if($item['badge'])
                            <span class="flex h-5 min-w-[20px] items-center justify-center rounded-full bg-[#1a1a1a] px-1.5 text-[9px] font-semibold text-[#f6f7f9]">{{ $item['badge'] }}</span>
                        @endif
                    </a>
                @endforeach
            </nav>

            <div class="mt-10 rounded-2xl border border-[#e2e4e8] bg-[#f2f3f5] p-4">
                <p class="text-[9px] uppercase tracking-[0.3em] text-[#8a8a8a]">Focus mode</p>
                <p class="mt-2 text-sm font-medium text-[#1a1a1a]">Deep work is on.</p>
                <div class="mt-4 h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                    <div class="h-1.5 w-3/4 rounded-full bg-[#1a1a1a]"></div>
                </div>
                <p class="mt-2 text-xs text-[#8a8a8a]">75% of weekly goal</p>
            </div>
            
            <div class="mt-6 rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full border border-[#e2e4e8] bg-[#f2f3f5] text-[#1a1a1a]">
                        <i class="fas fa-headphones text-sm"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-[#1a1a1a]">Focus Playlist</p>
                        <p class="text-xs text-[#8a8a8a]">Lofi beats • 45 min</p>
                    </div>
                    <button class="ml-auto h-8 w-8 rounded-full bg-[#1a1a1a] text-[#f6f7f9] transition hover:bg-[#333333]">
                        <i class="fas fa-play text-xs"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-[#f2f3f5] p-4 sm:p-6 lg:p-8 lg:ml-64">
            <!-- Header -->
            <header class="mb-6 flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] px-5 py-4 shadow-[0_4px_20px_rgba(0,0,0,0.02)] sm:px-6">
                <div class="relative w-full max-w-sm">
                    <i class="fa fa-search absolute left-4 top-1/2 -translate-y-1/2 text-[#8a8a8a] text-sm"></i>
                    <input type="text" placeholder="Search workspace..." class="w-full rounded-full border border-[#e2e4e8] bg-[#f2f3f5] py-2.5 pl-10 pr-4 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9]">
                </div>
                <div class="flex items-center gap-3">
                    <button class="relative rounded-full border border-[#e2e4e8] bg-[#f2f3f5] p-2.5 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                        <i class="fa-regular fa-bell text-sm"></i>
                        <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-[#1a1a1a] animate-pulse-dot"></span>
                    </button>
                    <button class="rounded-full border border-[#e2e4e8] bg-[#f2f3f5] p-2.5 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                        <i class="fa-regular fa-moon text-sm"></i>
                    </button>
                    <div class="flex items-center gap-3 pl-2 border-l border-[#e2e4e8]">
                        <img src="assets/guest.svg" alt="User" class="h-9 w-9 rounded-full border border-[#e2e4e8] object-cover">
                        <div class="hidden sm:block">
                            <p class="text-sm font-medium text-[#1a1a1a]">User 1</p>
                            <p class="text-xs text-[#8a8a8a]">Product Designer</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Welcome Banner -->
            <div class="mb-6 rounded-2xl bg-[#1a1a1a] p-8 text-[#f2f3f5]">
                <div class="flex flex-wrap items-center justify-between">
                    <div>
                        <p class="text-sm font-light opacity-70">Good morning, admin</p>
                        <h2 class="mt-1.5 text-2xl font-semibold tracking-tight">You have 3 tasks pending review</h2>
                        <p class="mt-1 text-sm opacity-60">Your team is waiting for your feedback</p>
                    </div>
                    <button class="rounded-full border border-[#f2f3f5]/20 px-6 py-2.5 text-sm font-medium transition hover:bg-[#f2f3f5]/10">
                        View Tasks <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </button>
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-[1.35fr_0.9fr]">
                <section class="space-y-6">
                    <!-- Stats Cards -->
                    <div class="grid gap-6 lg:grid-cols-2">
                        <!-- Project Card -->
                        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[9px] uppercase tracking-[0.3em] text-[#8a8a8a]">Project pulse</p>
                                    <h2 class="mt-2 text-xl font-semibold tracking-tight text-[#1a1a1a]">Project 1</h2>
                                </div>
                                <span class="rounded-full border border-[#e2e4e8] bg-[#f2f3f5] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">
                                    High
                                </span>
                            </div>

                            <div class="mt-6">
                                <div class="mb-2 flex items-center justify-between text-sm text-[#6a6a6a]">
                                    <span>Task done</span>
                                    <span class="font-medium text-[#1a1a1a]">24 / 36</span>
                                </div>
                                <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                    <div class="h-1.5 w-2/3 rounded-full bg-[#1a1a1a]"></div>
                                </div>
                            </div>

                            <div class="mt-5 flex flex-wrap gap-2">
                                <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]">IOS APP</span>
                                <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]">UI/UX</span>
                                <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]">Design</span>
                            </div>

                            <div class="mt-6 flex items-center justify-between border-t border-[#e2e4e8] pt-4">
                                <div class="flex -space-x-2">
                                    <img class="h-8 w-8 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                    <img class="h-8 w-8 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                    <img class="h-8 w-8 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-[#f6f7f9] bg-[#eceef0] text-[9px] font-medium text-[#6a6a6a]">+5</div>
                                </div>
                                <div class="text-right">
                                    <span class="text-[9px] uppercase tracking-[0.2em] text-[#6a6a6a] font-medium">Due 20 June</span>
                                    <p class="text-[9px] text-[#8a8a8a]">4 days left</p>
                                </div>
                            </div>
                        </div>

                        <!-- Time Tracker Card - FIXED -->
                        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[9px] uppercase tracking-[0.3em] text-[#8a8a8a]">Live tracker</p>
                                    <h2 class="mt-2 text-xl font-semibold tracking-tight text-[#1a1a1a]">Time flow</h2>
                                </div>
                                <div class="flex gap-2">
                                    <button id="timerToggle" class="rounded-full bg-[#1a1a1a] px-4 py-2 text-xs font-medium uppercase tracking-[0.15em] text-[#f6f7f9] transition hover:bg-[#333333]">
                                        <i class="fa-solid fa-play mr-1.5 text-xs"></i> Start
                                    </button>
                                    <button id="resetTimer" class="rounded-full border border-[#e2e4e8] px-3 py-2 text-xs text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                                        <i class="fa-solid fa-rotate-right text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Mode Selector -->
                            <div class="mt-4 flex gap-1 rounded-xl bg-[#f2f3f5] p-1 border border-[#e2e4e8]">
                                <button class="mode-btn active flex-1 rounded-lg px-3 py-1.5 text-xs font-medium transition bg-[#1a1a1a] text-[#f6f7f9]" data-mode="stopwatch">
                                    <i class="fa-regular fa-clock mr-1.5"></i> Stopwatch
                                </button>
                                <button class="mode-btn flex-1 rounded-lg px-3 py-1.5 text-xs font-medium transition text-[#6a6a6a]" data-mode="countdown">
                                    <i class="fa-regular fa-hourglass mr-1.5"></i> Countdown
                                </button>
                            </div>

                            <div class="mt-4 rounded-xl bg-[#f2f3f5] p-5 border border-[#e2e4e8]">
                                <div class="flex items-end justify-between">
                                    <div>
                                        <p class="text-sm text-[#6a6a6a]">Current session</p>
                                        <p id="timerDisplay" class="mt-1 text-4xl font-semibold tracking-tight text-[#1a1a1a] timer-display">00:00:00</p>
                                        <p class="mt-1 text-xs text-[#8a8a8a]">Started at <span id="startTime">--:--</span></p>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <div id="timerStatus" class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]">
                                            <span id="statusDot" class="inline-block h-1.5 w-1.5 rounded-full bg-[#1a1a1a] mr-1.5"></span>
                                            <span id="statusText">Ready</span>
                                        </div>
                                        <p class="mt-1 text-xs text-[#8a8a8a]">Today's goal: 6h</p>
                                    </div>
                                </div>
                                
                                <!-- Countdown Controls -->
                                <div id="countdownControls" class="mt-4 hidden">
                                    <div class="flex flex-wrap items-center justify-center gap-2">
                                        <div class="flex items-center gap-1">
                                            <label class="text-xs text-[#6a6a6a]">H</label>
                                            <input type="number" id="countdownHours" class="countdown-input" value="0" min="0" max="23">
                                        </div>
                                        <span class="text-[#6a6a6a] font-bold">:</span>
                                        <div class="flex items-center gap-1">
                                            <label class="text-xs text-[#6a6a6a]">M</label>
                                            <input type="number" id="countdownMinutes" class="countdown-input" value="25" min="0" max="59">
                                        </div>
                                        <span class="text-[#6a6a6a] font-bold">:</span>
                                        <div class="flex items-center gap-1">
                                            <label class="text-xs text-[#6a6a6a]">S</label>
                                            <input type="number" id="countdownSeconds" class="countdown-input" value="0" min="0" max="59">
                                        </div>
                                        <button id="setCountdown" class="rounded-full bg-[#1a1a1a] px-4 py-2 text-xs font-medium text-[#f6f7f9] transition hover:bg-[#333333]">
                                            Set
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mt-4 h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                    <div id="timerProgress" class="h-1.5 w-0 rounded-full bg-[#1a1a1a] progress-bar-transition"></div>
                                </div>
                            </div>
                            
                            <div class="mt-4 grid grid-cols-3 gap-2">
                                <div class="rounded-xl bg-[#f2f3f5] p-3 text-center border border-[#e2e4e8]">
                                    <p class="text-xs text-[#8a8a8a]">Today</p>
                                    <p id="todayHours" class="mt-0.5 text-base font-semibold text-[#1a1a1a]">0.0h</p>
                                </div>
                                <div class="rounded-xl bg-[#f2f3f5] p-3 text-center border border-[#e2e4e8]">
                                    <p class="text-xs text-[#8a8a8a]">Week</p>
                                    <p id="weekHours" class="mt-0.5 text-base font-semibold text-[#1a1a1a]">22.5h</p>
                                </div>
                                <div class="rounded-xl bg-[#f2f3f5] p-3 text-center border border-[#e2e4e8]">
                                    <p class="text-xs text-[#8a8a8a]">Month</p>
                                    <p id="monthHours" class="mt-0.5 text-base font-semibold text-[#1a1a1a]">87.0h</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks and Schedule -->
                    <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr]">
                        <!-- Today's Tasks -->
                        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                            <div class="mb-5 flex items-center justify-between">
                                <div>
                                    <h3 class="text-base font-semibold tracking-tight text-[#1a1a1a]">Today's tasks</h3>
                                    <p class="text-xs text-[#8a8a8a]">5 items remaining</p>
                                </div>
                                <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">05 items</span>
                            </div>
                            <div class="space-y-2.5">
                                @php $tasks = [
                                    ['title' => 'Create product concept', 'done' => false],
                                    ['title' => 'Review design handoff', 'done' => false],
                                    ['title' => 'Finalize onboarding flow', 'done' => true],
                                    ['title' => 'Prepare sprint notes', 'done' => true],
                                    ['title' => 'Design system audit', 'done' => false],
                                ]; @endphp
                                @foreach ($tasks as $task)
                                    <div class="task-item flex items-center justify-between rounded-xl border border-[#e2e4e8] bg-[#f6f7f9] px-4 py-2.5">
                                        <div class="flex items-center gap-3">
                                            <input type="checkbox" class="h-4 w-4 rounded border-[#d1d3d8] text-[#1a1a1a] focus:ring-0" {{ $task['done'] ? 'checked' : '' }}>
                                            <span class="text-sm {{ $task['done'] ? 'text-[#8a8a8a] line-through' : 'text-[#1a1a1a]' }}">{{ $task['title'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="h-1.5 w-1.5 rounded-full {{ $task['done'] ? 'bg-[#8a8a8a]' : 'bg-[#1a1a1a]' }}"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="mt-4 w-full rounded-xl border border-[#e2e4e8] py-2.5 text-xs font-medium text-[#6a6a6a] transition hover:bg-[#f2f3f5] hover:text-[#1a1a1a]">
                                <i class="fa-solid fa-plus mr-2"></i> Add new task
                            </button>
                        </div>

                        <!-- Calendar -->
                        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                            <div class="mb-5 flex items-center justify-between">
                                <div>
                                    <h3 class="text-base font-semibold tracking-tight text-[#1a1a1a]">Schedule</h3>
                                    <p class="text-xs text-[#8a8a8a]">July 2026</p>
                                </div>
                                <div class="flex gap-1.5">
                                    <button class="rounded-full border border-[#e2e4e8] p-1.5 text-[#6a6a6a] transition hover:bg-[#f2f3f5]">
                                        <i class="fa-solid fa-chevron-left text-xs"></i>
                                    </button>
                                    <button class="rounded-full border border-[#e2e4e8] p-1.5 text-[#6a6a6a] transition hover:bg-[#f2f3f5]">
                                        <i class="fa-solid fa-chevron-right text-xs"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-7 gap-1 text-center text-xs text-[#6a6a6a]">
                                @php $days = ['M','T','W','T','F','S','S']; @endphp
                                @foreach ($days as $day)
                                    <div class="py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#8a8a8a]">{{ $day }}</div>
                                @endforeach
                                @php 
                                    $dates = [];
                                    for($i = 1; $i <= 31; $i++) {
                                        $dates[] = $i;
                                    }
                                    // Default highlights (will be replaced by API data on load)
                                    $events = [5, 12, 15, 20, 25, 28];
                                    $meetingDates = [8, 15, 22, 29];
                                @endphp
                                @foreach ($dates as $date)
                                    <div
                                        class="relative flex h-9 w-9 items-center justify-center rounded-full text-sm transition hover:bg-[#eceef0]"
                                        data-date="{{ $date }}"
                                        data-highlight="{{ in_array($date, $events) ? '1' : '0' }}"
                                        data-meeting="{{ in_array($date, $meetingDates) ? '1' : '0' }}"
                                        data-deadline="{{ $date === 20 ? '1' : '0' }}"
                                    >
                                        {{ $date }}
                                        <span
                                            class="absolute bottom-1 h-1 w-1 rounded-full transition-opacity"
                                            style="{{ in_array($date, $events) ? 'opacity:1;' : 'opacity:0;' }} background: {{ $date === 20 ? '#f6f7f9' : '#1a1a1a' }};"
                                        ></span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-4 flex items-center justify-center gap-4 border-t border-[#e2e4e8] pt-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#1a1a1a]"></span>
                                    <span class="text-xs text-[#6a6a6a]">Deadline</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#8a8a8a]"></span>
                                    <span class="text-xs text-[#6a6a6a]">Completed</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="h-1.5 w-1.5 rounded-full bg-[#c8c8c8]"></span>
                                    <span class="text-xs text-[#6a6a6a]">Meeting</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Right Sidebar -->
                <section class="space-y-6">
                    <!-- Messages -->
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                        <div class="mb-5 flex items-center justify-between">
                            <div>
                                <p class="text-[9px] uppercase tracking-[0.3em] text-[#8a8a8a]">Messages</p>
                                <h3 class="mt-1 text-base font-semibold tracking-tight text-[#1a1a1a]">Recent stream</h3>
                            </div>
                            <button class="text-xs font-medium text-[#1a1a1a] transition hover:text-[#6a6a6a]">View all</button>
                        </div>
                        <div class="space-y-2.5 max-h-[380px] overflow-y-auto pr-1">
                            @php $messages = [
                                ['name' => 'User1', 'role' => 'Design Lead', 'text' => 'Updated the onboarding states. Ready for review!', 'time' => '2m'],
                                ['name' => 'User2', 'role' => 'Frontend', 'text' => 'The sprint review is ready. Can we meet at 3?', 'time' => '12m'],
                                ['name' => 'User3', 'role' => 'Product', 'text' => 'Confirmed the final copy. Everything looks great.', 'time' => '1h'],
                                ['name' => 'User4', 'role' => 'Backend', 'text' => 'API endpoints are ready for integration.', 'time' => '2h'],
                            ]; @endphp
                            @foreach ($messages as $message)
                                <div class="flex items-start gap-3 rounded-xl border border-[#e2e4e8] bg-[#f6f7f9] p-3 transition hover:border-[#c8c8c8]">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#eceef0] text-sm font-medium text-[#1a1a1a] border border-[#e2e4e8]">
                                        {{ strtoupper(substr($message['name'], 0, 1)) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-2">
                                            <p class="text-sm font-medium text-[#1a1a1a]">{{ $message['name'] }}</p>
                                            <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a]">{{ $message['time'] }}</span>
                                        </div>
                                        <p class="text-xs text-[#8a8a8a]">{{ $message['role'] }}</p>
                                        <p class="mt-1 text-sm text-[#4a4a4a]">{{ $message['text'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 flex gap-2">
                            <input type="text" placeholder="Type a message..." class="flex-1 rounded-full border border-[#e2e4e8] bg-[#f2f3f5] px-4 py-2 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9]">
                            <button class="rounded-full bg-[#1a1a1a] px-4 py-2 text-[#f6f7f9] transition hover:bg-[#333333]">
                                <i class="fa-regular fa-paper-plane text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Momentum -->
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-base font-semibold tracking-tight text-[#1a1a1a]">Momentum</h3>
                            <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#1a1a1a] border border-[#e2e4e8]">
                                <i class="fa-solid fa-arrow-up mr-1 text-xs"></i> +12%
                            </span>
                        </div>
                        <div class="rounded-xl bg-[#f2f3f5] p-5 border border-[#e2e4e8]">
                            <div class="flex items-end justify-between">
                                <div>
                                    <p class="text-sm text-[#6a6a6a]">Weekly output</p>
                                    <p class="mt-2 text-3xl font-semibold tracking-tight text-[#1a1a1a]">82%</p>
                                    <p class="mt-1 text-xs text-[#8a8a8a]">8.5h average</p>
                                </div>
                                <div class="flex h-14 w-14 items-center justify-center rounded-full border-2 border-[#e2e4e8] bg-[#f6f7f9] text-lg font-semibold text-[#1a1a1a]">
                                    +8
                                </div>
                            </div>
                            <div class="mt-4 h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                <div class="h-1.5 w-[82%] rounded-full bg-[#1a1a1a]"></div>
                            </div>
                            <div class="mt-3 grid grid-cols-3 gap-2 text-center">
                                <div>
                                    <p class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a]">Tasks</p>
                                    <p class="text-sm font-semibold text-[#1a1a1a]">24</p>
                                </div>
                                <div>
                                    <p class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a]">Projects</p>
                                    <p class="text-sm font-semibold text-[#1a1a1a]">4</p>
                                </div>
                                <div>
                                    <p class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a]">Focus</p>
                                    <p class="text-sm font-semibold text-[#1a1a1a]">92%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script>
        // ============================================
        // ENHANCED TIMER - FULLY FIXED
        // ============================================
        
        // Timer state
        let timerMode = 'stopwatch';
        let isRunning = false;
        let timerInterval = null;
        let elapsedSeconds = 0;
        let countdownTotal = 1500; // 25 minutes default
        let startTimestamp = null;
        
        // DOM elements
        const timerDisplay = document.getElementById('timerDisplay');
        const timerToggle = document.getElementById('timerToggle');
        const resetBtn = document.getElementById('resetTimer');
        const timerStatus = document.getElementById('timerStatus');
        const statusDot = document.getElementById('statusDot');
        const statusText = document.getElementById('statusText');
        const timerProgress = document.getElementById('timerProgress');
        const startTimeDisplay = document.getElementById('startTime');
        const todayHoursEl = document.getElementById('todayHours');
        const weekHoursEl = document.getElementById('weekHours');
        const monthHoursEl = document.getElementById('monthHours');
        const countdownControls = document.getElementById('countdownControls');
        const countdownHours = document.getElementById('countdownHours');
        const countdownMinutes = document.getElementById('countdownMinutes');
        const countdownSeconds = document.getElementById('countdownSeconds');
        const setCountdownBtn = document.getElementById('setCountdown');
        const modeBtns = document.querySelectorAll('.mode-btn');
        
        // Format time
        function formatTime(totalSeconds) {
            const h = Math.floor(totalSeconds / 3600);
            const m = Math.floor((totalSeconds % 3600) / 60);
            const s = Math.floor(totalSeconds % 60);
            return `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
        }
        
        // Update display
        function updateDisplay() {
            if (timerDisplay) {
                timerDisplay.textContent = formatTime(elapsedSeconds);
            }
        }
        
        // Update progress
        function updateProgress() {
            if (!timerProgress) return;
            let progress = 0;
            if (timerMode === 'stopwatch') {
                progress = Math.min((elapsedSeconds / (8 * 3600)) * 100, 100);
            } else if (timerMode === 'countdown' && countdownTotal > 0) {
                const remaining = Math.max(countdownTotal - elapsedSeconds, 0);
                progress = (remaining / countdownTotal) * 100;
            }
            timerProgress.style.width = `${Math.max(0, Math.min(progress, 100))}%`;
        }
        
        // Update stats
        function updateStats() {
            if (timerMode === 'stopwatch') {
                const todayHoursValue = elapsedSeconds / 3600;
                if (todayHoursEl) todayHoursEl.textContent = `${todayHoursValue.toFixed(1)}h`;
                if (weekHoursEl) {
                    const weekTotal = 22.5 + (elapsedSeconds / 3600);
                    weekHoursEl.textContent = `${weekTotal.toFixed(1)}h`;
                }
                if (monthHoursEl) {
                    const monthTotal = 87 + (elapsedSeconds / 3600);
                    monthHoursEl.textContent = `${monthTotal.toFixed(1)}h`;
                }
            }
        }
        
        // Start timer
        function startTimer() {
            if (isRunning) return;
            
            // Check if countdown is complete
            if (timerMode === 'countdown' && elapsedSeconds >= countdownTotal) {
                return;
            }
            
            isRunning = true;
            startTimestamp = Date.now() - (elapsedSeconds * 1000);
            
            // Update start time
            const now = new Date();
            startTimeDisplay.textContent = now.toLocaleTimeString('en-US', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            
            timerInterval = setInterval(() => {
                const now = Date.now();
                elapsedSeconds = Math.floor((now - startTimestamp) / 1000);
                
                // Check countdown completion
                if (timerMode === 'countdown' && elapsedSeconds >= countdownTotal) {
                    elapsedSeconds = countdownTotal;
                    updateDisplay();
                    updateProgress();
                    pauseTimer();
                    timerDisplay.classList.add('countdown-pulse');
                    statusDot.className = 'inline-block h-1.5 w-1.5 rounded-full bg-red-500 mr-1.5 animate-pulse-dot';
                    statusText.textContent = 'Time\'s Up!';
                    timerStatus.className = 'rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-red-600 border border-[#e2e4e8]';
                    return;
                }
                
                updateDisplay();
                updateProgress();
                updateStats();
            }, 1000);
            
            // Update UI
            timerToggle.innerHTML = '<i class="fa-solid fa-pause mr-1.5 text-xs"></i> Pause';
            timerToggle.className = 'rounded-full bg-[#1a1a1a] px-4 py-2 text-xs font-medium uppercase tracking-[0.15em] text-[#f6f7f9] transition hover:bg-[#333333]';
            
            statusDot.className = 'inline-block h-1.5 w-1.5 rounded-full bg-green-500 mr-1.5 animate-pulse-dot';
            statusText.textContent = timerMode === 'stopwatch' ? 'Running' : 'Counting Down';
            timerStatus.className = 'rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-green-600 border border-[#e2e4e8]';
        }
        
        // Pause timer
        function pauseTimer() {
            if (!isRunning) return;
            
            isRunning = false;
            clearInterval(timerInterval);
            timerInterval = null;
            
            timerToggle.innerHTML = '<i class="fa-solid fa-play mr-1.5 text-xs"></i> Resume';
            timerToggle.className = 'rounded-full bg-[#e2e4e8] px-4 py-2 text-xs font-medium uppercase tracking-[0.15em] text-[#1a1a1a] transition hover:bg-[#d1d3d8]';
            
            statusDot.className = 'inline-block h-1.5 w-1.5 rounded-full bg-yellow-500 mr-1.5';
            statusText.textContent = 'Paused';
            timerStatus.className = 'rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-yellow-600 border border-[#e2e4e8]';
        }
        
        // Reset timer
        function resetTimer() {
            // Stop if running
            if (isRunning) {
                isRunning = false;
                clearInterval(timerInterval);
                timerInterval = null;
            }
            
            timerDisplay.classList.remove('countdown-pulse');
            
            if (timerMode === 'stopwatch') {
                elapsedSeconds = 0;
            } else if (timerMode === 'countdown') {
                elapsedSeconds = 0;
                if (countdownTotal > 0) {
                    // Reset to countdown total
                    elapsedSeconds = 0;
                }
            }
            
            updateDisplay();
            updateProgress();
            updateStats();
            
            timerToggle.innerHTML = '<i class="fa-solid fa-play mr-1.5 text-xs"></i> Start';
            timerToggle.className = 'rounded-full bg-[#1a1a1a] px-4 py-2 text-xs font-medium uppercase tracking-[0.15em] text-[#f6f7f9] transition hover:bg-[#333333]';
            
            statusDot.className = 'inline-block h-1.5 w-1.5 rounded-full bg-[#1a1a1a] mr-1.5';
            statusText.textContent = 'Ready';
            timerStatus.className = 'rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]';
            
            startTimeDisplay.textContent = '--:--';
        }
        
        // Toggle timer
        function toggleTimer() {
            if (!isRunning) {
                startTimer();
            } else {
                pauseTimer();
            }
        }
        
        // Set countdown
        function setCountdown() {
            const h = parseInt(countdownHours.value) || 0;
            const m = parseInt(countdownMinutes.value) || 0;
            const s = parseInt(countdownSeconds.value) || 0;
            
            const total = (h * 3600) + (m * 60) + s;
            
            if (total <= 0) {
                alert('Please set a valid time for countdown.');
                return;
            }
            
            countdownTotal = total;
            elapsedSeconds = 0;
            
            updateDisplay();
            updateProgress();
            
            timerDisplay.classList.remove('countdown-pulse');
            statusDot.className = 'inline-block h-1.5 w-1.5 rounded-full bg-[#1a1a1a] mr-1.5';
            statusText.textContent = 'Ready';
            timerStatus.className = 'rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]';
            
            timerToggle.innerHTML = '<i class="fa-solid fa-play mr-1.5 text-xs"></i> Start';
            timerToggle.className = 'rounded-full bg-[#1a1a1a] px-4 py-2 text-xs font-medium uppercase tracking-[0.15em] text-[#f6f7f9] transition hover:bg-[#333333]';
        }
        
        // Switch mode
        function switchMode(mode) {
            if (mode === timerMode) return;
            
            // Stop current timer
            if (isRunning) {
                isRunning = false;
                clearInterval(timerInterval);
                timerInterval = null;
            }
            
            timerMode = mode;
            
            // Update UI
            modeBtns.forEach(btn => {
                btn.classList.remove('active', 'bg-[#1a1a1a]', 'text-[#f6f7f9]');
                btn.classList.add('text-[#6a6a6a]');
                if (btn.dataset.mode === mode) {
                    btn.classList.add('active', 'bg-[#1a1a1a]', 'text-[#f6f7f9]');
                    btn.classList.remove('text-[#6a6a6a]');
                }
            });
            
            // Show/hide countdown controls
            if (mode === 'countdown') {
                countdownControls.classList.remove('hidden');
                if (countdownTotal === 0) {
                    countdownMinutes.value = 25;
                    setCountdown();
                } else {
                    elapsedSeconds = 0;
                    updateDisplay();
                    updateProgress();
                }
            } else {
                countdownControls.classList.add('hidden');
                elapsedSeconds = 0;
                updateDisplay();
                updateProgress();
                updateStats();
            }
            
            // Reset UI
            timerDisplay.classList.remove('countdown-pulse');
            timerToggle.innerHTML = '<i class="fa-solid fa-play mr-1.5 text-xs"></i> Start';
            timerToggle.className = 'rounded-full bg-[#1a1a1a] px-4 py-2 text-xs font-medium uppercase tracking-[0.15em] text-[#f6f7f9] transition hover:bg-[#333333]';
            
            statusDot.className = 'inline-block h-1.5 w-1.5 rounded-full bg-[#1a1a1a] mr-1.5';
            statusText.textContent = 'Ready';
            timerStatus.className = 'rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]';
            
            startTimeDisplay.textContent = '--:--';
        }
        
        // ============================================
        // EVENT LISTENERS
        // ============================================
        
        if (timerToggle) {
            timerToggle.addEventListener('click', toggleTimer);
        }
        
        if (resetBtn) {
            resetBtn.addEventListener('click', resetTimer);
        }
        
        if (setCountdownBtn) {
            setCountdownBtn.addEventListener('click', setCountdown);
        }
        
        modeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                switchMode(btn.dataset.mode);
            });
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
            if (e.key === ' ' || e.key === 'Space') {
                e.preventDefault();
                toggleTimer();
            }
            if (e.key === 'r' || e.key === 'R') {
                resetTimer();
            }
        });
        
        // ============================================
        // API: Schedule highlights (replace calendar marks)
        // ============================================

        async function loadScheduleHighlights() {
            try {
                const res = await fetch('/api/app/schedule');
                if (!res.ok) return;
                const data = await res.json();

                const highlights = Array.isArray(data.highlights) ? data.highlights : [];
                const meeting = Array.isArray(data.legend?.meeting) ? data.legend.meeting : [];
                const deadline = Array.isArray(data.legend?.deadline) ? data.legend.deadline : [];

                document.querySelectorAll('[data-date]').forEach(el => {
                    const date = parseInt(el.getAttribute('data-date'), 10);
                    const isHighlight = highlights.includes(date);
                    const isMeeting = meeting.includes(date);
                    const isDeadline = deadline.includes(date);

                    el.setAttribute('data-highlight', isHighlight ? '1' : '0');
                    el.setAttribute('data-meeting', isMeeting ? '1' : '0');
                    el.setAttribute('data-deadline', isDeadline ? '1' : '0');

                    // Apply styles
                    if (isMeeting) {
                        el.classList.add('font-semibold', 'text-[#1a1a1a]');
                    } else {
                        el.classList.remove('font-semibold', 'text-[#1a1a1a]');
                    }

                    if (isDeadline) {
                        el.classList.add('bg-[#1a1a1a]', 'text-[#f6f7f9]', 'hover:bg-[#333333]');
                    } else {
                        el.classList.remove('bg-[#1a1a1a]', 'text-[#f6f7f9]', 'hover:bg-[#333333]');
                    }

                    // Dot
                    const dot = el.querySelector('span.absolute');
                    if (dot) {
                        dot.style.opacity = isHighlight ? '1' : '0';
                        dot.style.background = isDeadline ? '#f6f7f9' : '#1a1a1a';
                    }
                });
            } catch (e) {
                console.warn('Schedule API load failed:', e);
            }
        }

        // ============================================
        // INITIALIZE
        // ============================================

        // Set initial state
        timerMode = 'stopwatch';
        elapsedSeconds = 0;
        countdownTotal = 1500;
        updateDisplay();
        updateProgress();
        updateStats();

        // Load schedule data after initial render
        loadScheduleHighlights();
        
        console.log('✅ Enhanced timer initialized!');

        console.log('💡 Press Space to start/pause');
        console.log('🔄 Press R to reset');
        console.log('⏱️ Switch between Stopwatch & Countdown modes');
    </script>
</body>
</html>