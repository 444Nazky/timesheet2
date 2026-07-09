<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astra OS - Timesheet Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        /* Custom animations */
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.85); }
        }
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes subtle-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(0, 0, 0, 0.02); }
            50% { box-shadow: 0 0 40px rgba(0, 0, 0, 0.04); }
        }
        
        .animate-pulse-dot {
            animation: pulse-dot 2s infinite;
        }
        .animate-slide-up {
            animation: slide-up 0.4s ease-out forwards;
        }
        .subtle-glow {
            animation: subtle-glow 3s ease-in-out infinite;
        }
        
        /* Custom scrollbar - minimal */
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
        
        /* Minimal hover effects */
        .hover-lift {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.05);
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
        
        .status-badge {
            transition: all 0.2s ease;
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 32px -12px rgba(0, 0, 0, 0.06);
        }
        
        /* Minimal focus states */
        input:focus, button:focus {
            outline: none;
        }
        input:focus-visible, button:focus-visible {
            outline: 2px solid #1a1a1a;
            outline-offset: 2px;
        }
        
        /* Clean typography */
        .tracking-tight {
            letter-spacing: -0.02em;
        }
        .tracking-wide {
            letter-spacing: 0.02em;
        }
        
        /* Progress bar animation */
        .progress-bar {
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
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
                        ['label' => 'Dashboard', 'icon' => 'fa-th-large', 'active' => true, 'badge' => null],
                        ['label' => 'Projects', 'icon' => 'fa-briefcase', 'active' => false, 'badge' => '12'],
                        ['label' => 'My Task', 'icon' => 'fa-tasks', 'active' => false, 'badge' => '5'],
                        ['label' => 'Calendar', 'icon' => 'fa-calendar-alt', 'active' => false, 'badge' => null],
                        ['label' => 'Time Manage', 'icon' => 'fa-clock', 'active' => false, 'badge' => '3'],
                        ['label' => 'Reports', 'icon' => 'fa-chart-bar', 'active' => false, 'badge' => null],
                        ['label' => 'Settings', 'icon' => 'fa-cog', 'active' => false, 'badge' => null],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <a href="#" class="nav-item flex items-center justify-between rounded-xl px-4 py-2.5 text-xs font-medium tracking-wide transition-all duration-200 {{ $item['active'] ? 'active bg-[#eceef0] text-[#1a1a1a]' : 'text-[#6a6a6a] hover:bg-[#eceef0] hover:text-[#1a1a1a]' }}">
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
                    <div class="h-1.5 w-3/4 rounded-full bg-[#1a1a1a] progress-bar"></div>
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
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="User" class="h-9 w-9 rounded-full border border-[#e2e4e8] object-cover">
                        <div class="hidden sm:block">
                            <p class="text-sm font-medium text-[#1a1a1a]">Sarah Chen</p>
                            <p class="text-xs text-[#8a8a8a]">Product Designer</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Welcome Banner - Minimal -->
            <div class="mb-6 rounded-2xl bg-[#1a1a1a] p-8 text-[#f2f3f5]">
                <div class="flex flex-wrap items-center justify-between">
                    <div>
                        <p class="text-sm font-light opacity-70">Good morning, Sarah</p>
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
                                    <h2 class="mt-2 text-xl font-semibold tracking-tight text-[#1a1a1a]">Northstar Design</h2>
                                </div>
                                <span class="status-badge rounded-full border border-[#e2e4e8] bg-[#f2f3f5] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">
                                    High
                                </span>
                            </div>

                            <div class="mt-6">
                                <div class="mb-2 flex items-center justify-between text-sm text-[#6a6a6a]">
                                    <span>Task done</span>
                                    <span class="font-medium text-[#1a1a1a]">24 / 36</span>
                                </div>
                                <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                    <div class="h-1.5 w-2/3 rounded-full bg-[#1a1a1a] progress-bar"></div>
                                </div>
                            </div>

                            <div class="mt-5 flex flex-wrap gap-2">
                                <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]">IOS APP</span>
                                <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]">UI/UX</span>
                                <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]">Design</span>
                            </div>

                            <div class="mt-6 flex items-center justify-between border-t border-[#e2e4e8] pt-4">
                                <div class="flex -space-x-2">
                                    <img class="h-8 w-8 rounded-full border-2 border-[#f6f7f9] object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=80&q=80" alt="Team member">
                                    <img class="h-8 w-8 rounded-full border-2 border-[#f6f7f9] object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=80&q=80" alt="Team member">
                                    <img class="h-8 w-8 rounded-full border-2 border-[#f6f7f9] object-cover" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=80&q=80" alt="Team member">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-[#f6f7f9] bg-[#eceef0] text-[9px] font-medium text-[#6a6a6a]">+5</div>
                                </div>
                                <div class="text-right">
                                    <span class="text-[9px] uppercase tracking-[0.2em] text-[#6a6a6a] font-medium">Due 20 June</span>
                                    <p class="text-[9px] text-[#8a8a8a]">4 days left</p>
                                </div>
                            </div>
                        </div>

                        <!-- Time Tracker Card -->
                        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[9px] uppercase tracking-[0.3em] text-[#8a8a8a]">Live tracker</p>
                                    <h2 class="mt-2 text-xl font-semibold tracking-tight text-[#1a1a1a]">Time flow</h2>
                                </div>
                                <button class="rounded-full bg-[#1a1a1a] px-4 py-2 text-xs font-medium uppercase tracking-[0.15em] text-[#f6f7f9] transition hover:bg-[#333333]">
                                    <i class="fa-solid fa-pause mr-1.5 text-xs"></i> Pause
                                </button>
                            </div>

                            <div class="mt-8 rounded-xl bg-[#f2f3f5] p-5 border border-[#e2e4e8]">
                                <div class="flex items-end justify-between">
                                    <div>
                                        <p class="text-sm text-[#6a6a6a]">Current session</p>
                                        <p class="mt-1 text-4xl font-semibold tracking-tight text-[#1a1a1a]">03:42:19</p>
                                        <p class="mt-1 text-xs text-[#8a8a8a]">Started at 9:30 AM</p>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <div class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium uppercase tracking-[0.2em] text-[#6a6a6a] border border-[#e2e4e8]">
                                            <span class="inline-block h-1.5 w-1.5 rounded-full bg-[#1a1a1a] mr-1.5 animate-pulse-dot"></span>
                                            Active
                                        </div>
                                        <p class="mt-1 text-xs text-[#8a8a8a]">Today's goal: 6h</p>
                                    </div>
                                </div>
                                <div class="mt-4 h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                    <div class="h-1.5 w-[65%] rounded-full bg-[#1a1a1a] progress-bar"></div>
                                </div>
                            </div>
                            
                            <div class="mt-4 grid grid-cols-3 gap-2">
                                <div class="rounded-xl bg-[#f2f3f5] p-3 text-center border border-[#e2e4e8]">
                                    <p class="text-xs text-[#8a8a8a]">Today</p>
                                    <p class="mt-0.5 text-base font-semibold text-[#1a1a1a]">4.5h</p>
                                </div>
                                <div class="rounded-xl bg-[#f2f3f5] p-3 text-center border border-[#e2e4e8]">
                                    <p class="text-xs text-[#8a8a8a]">Week</p>
                                    <p class="mt-0.5 text-base font-semibold text-[#1a1a1a]">22.5h</p>
                                </div>
                                <div class="rounded-xl bg-[#f2f3f5] p-3 text-center border border-[#e2e4e8]">
                                    <p class="text-xs text-[#8a8a8a]">Month</p>
                                    <p class="mt-0.5 text-base font-semibold text-[#1a1a1a]">87h</p>
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
                                    $events = [5, 12, 15, 20, 25, 28];
                                @endphp
                                @foreach ($dates as $date)
                                    <div class="relative flex h-9 w-9 items-center justify-center rounded-full text-sm transition hover:bg-[#eceef0] {{ in_array($date, [8, 15, 22, 29]) ? 'font-semibold text-[#1a1a1a]' : '' }} {{ $date === 20 ? 'bg-[#1a1a1a] text-[#f6f7f9] hover:bg-[#333333]' : '' }}">
                                        {{ $date }}
                                        @if(in_array($date, $events))
                                            <span class="absolute bottom-1 h-1 w-1 rounded-full {{ $date === 20 ? 'bg-[#f6f7f9]' : 'bg-[#1a1a1a]' }}"></span>
                                        @endif
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
                                ['name' => 'Nina', 'role' => 'Design Lead', 'text' => 'Updated the onboarding states. Ready for review!', 'time' => '2m'],
                                ['name' => 'Milo', 'role' => 'Frontend', 'text' => 'The sprint review is ready. Can we meet at 3?', 'time' => '12m'],
                                ['name' => 'Rae', 'role' => 'Product', 'text' => 'Confirmed the final copy. Everything looks great.', 'time' => '1h'],
                                ['name' => 'Tom', 'role' => 'Backend', 'text' => 'API endpoints are ready for integration.', 'time' => '2h'],
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
                                <div class="h-1.5 w-[82%] rounded-full bg-[#1a1a1a] progress-bar"></div>
                            </div>
                            <div class="mt-3 grid grid-cols-3 gap-2 text-center">
                                <div>
                                    <p class="text-[9px] uppercase tracking-[0.2em] text-[#8a