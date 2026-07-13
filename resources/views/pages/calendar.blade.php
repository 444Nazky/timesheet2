@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar - Timesheet</title>
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
        
        .animate-pulse-dot {
            animation: pulse-dot 2s infinite;
        }
        .animate-slide-up {
            animation: slide-up 0.4s ease-out forwards;
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
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 40;
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
        .nav-item:hover::after,
        .nav-item.active::after {
            transform: translateY(-50%) scaleY(1);
        }
        
        .calendar-event {
            transition: all 0.2s ease;
            cursor: pointer;
            border-radius: 8px;
            padding: 4px 8px;
            font-size: 10px;
            line-height: 1.3;
            position: relative;
            overflow: hidden;
            margin: 1px 0;
        }
        .calendar-event:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .event-purple { background: #ede7f6; color: #5e35b1; border-left: 3px solid #7c4dff; }
        .event-blue { background: #e3f2fd; color: #0d47a1; border-left: 3px solid #2979ff; }
        .event-green { background: #e8f5e9; color: #1b5e20; border-left: 3px solid #00c853; }
        .event-orange { background: #fff3e0; color: #bf360c; border-left: 3px solid #ff9100; }
        .event-pink { background: #fce4ec; color: #880e4f; border-left: 3px solid #ff4081; }
        
        .day-cell {
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
            min-height: 100px;
        }
        .day-cell:hover {
            background: #f8f9fb;
        }
        
        .day-cell .date-number {
            font-size: 13px;
            font-weight: 600;
            color: #1a1a1a;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }
        .day-cell .date-number.today {
            background: #1a1a1a;
            color: #ffffff;
        }
        .day-cell .date-number.weekend {
            color: #b0b0b0;
        }
        .day-cell .date-number.selected {
            background: #e2e4e8;
            color: #1a1a1a;
        }
        
        .event-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            border: 1.5px solid #ffffff;
        }
        .event-dot.deadline { background: #7c4dff; }
        .event-dot.meeting { background: #2979ff; }
        .event-dot.completed { background: #00c853; }
        
        .view-btn {
            transition: all 0.2s ease;
            padding: 4px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
        }
        .view-btn.active {
            background: #1a1a1a;
            color: #f6f7f9;
        }
        .view-btn:not(.active):hover {
            background: #eceef0;
        }
        
        .filter-pill {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .filter-pill:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .filter-pill.active {
            background: #1a1a1a;
            color: #f6f7f9;
            border-color: #1a1a1a;
        }
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 100;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active {
            display: flex;
        }
        
        .modal-content {
            background: #f6f7f9;
            border-radius: 1.5rem;
            padding: 2rem;
            max-width: 480px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slide-up 0.3s ease-out forwards;
            border: 1px solid #e2e4e8;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        
        .modal-content input,
        .modal-content select,
        .modal-content textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e4e8;
            border-radius: 10px;
            background: #f2f3f5;
            color: #1a1a1a;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        .modal-content input:focus,
        .modal-content select:focus,
        .modal-content textarea:focus {
            outline: none;
            border-color: #1a1a1a;
            background: #f6f7f9;
        }
        
        .modal-content label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #6a6a6a;
            margin-bottom: 4px;
        }
        
        .event-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .event-badge.deadline { background: #ede7f6; color: #5e35b1; }
        .event-badge.meeting { background: #e3f2fd; color: #0d47a1; }
        .event-badge.completed { background: #e8f5e9; color: #1b5e20; }
        
        .agenda-item {
            transition: all 0.2s ease;
        }
        .agenda-item:hover {
            background: #f8f9fb;
            transform: translateX(4px);
        }
        
        .tool-btn {
            transition: all 0.2s ease;
        }
        .tool-btn:hover {
            background: #eceef0;
            transform: translateY(-1px);
        }
        
        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        }
    </style>
</head>
<body class="min-h-screen bg-[#f2f3f5] text-[#1a1a1a] antialiased selection:bg-[#1a1a1a] selection:text-[#f2f3f5]">
    <div class="flex min-h-screen">
        <!-- Fixed Sidebar -->
        <aside class="sidebar w-64 border-r border-[#e2e4e8] bg-[#f6f7f9] px-6 py-6 flex flex-col">
            <div class="mb-10 flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] text-xs font-black tracking-wider text-[#1a1a1a]">
                    03
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.3em] text-[#8a8a8a]">Workspace</p>
                    <p class="text-sm font-semibold text-[#1a1a1a]">TimeSheet</p>
                </div>
            </div>

            <nav class="space-y-1 flex-1">
                @php
                    $navItems = [
                        ['label' => 'Dashboard', 'icon' => 'fa-th-large', 'route' => 'dashboard', 'active' => false, 'badge' => null],
                        ['label' => 'Projects', 'icon' => 'fa-briefcase', 'route' => 'projects', 'active' => false, 'badge' => '12'],
                        ['label' => 'My Task', 'icon' => 'fa-tasks', 'route' => 'tasks', 'active' => false, 'badge' => '5'],
                        ['label' => 'Calendar', 'icon' => 'fa-calendar-alt', 'route' => 'calendar', 'active' => true, 'badge' => null],
                        ['label' => 'Time Manage', 'icon' => 'fa-clock', 'route' => 'dashboard', 'active' => false, 'badge' => '3'],
                        ['label' => 'Reports', 'icon' => 'fa-chart-bar', 'route' => 'reports', 'active' => false, 'badge' => null],
                        ['label' => 'Settings', 'icon' => 'fa-cog', 'route' => 'dashboard', 'active' => false, 'badge' => null],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="nav-item flex items-center justify-between rounded-xl px-4 py-2.5 text-xs font-medium tracking-wide transition-all duration-200 {{ $item['active'] ? 'active bg-[#eceef0] text-[#1a1a1a]' : 'text-[#6a6a6a] hover:bg-[#eceef0] hover:text-[#1a1a1a]' }}">
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

            <div class="mt-6 rounded-2xl border border-[#e2e4e8] bg-[#f2f3f5] p-4">
                <p class="text-[9px] uppercase tracking-[0.3em] text-[#8a8a8a]">Focus mode</p>
                <p class="mt-2 text-sm font-medium text-[#1a1a1a]">Deep work is on.</p>
                <div class="mt-4 h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                    <div class="h-1.5 w-3/4 rounded-full bg-[#1a1a1a]"></div>
                </div>
                <p class="mt-2 text-xs text-[#8a8a8a]">75% of weekly goal</p>
            </div>
            
            <div class="mt-4 rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-4">
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

        <!-- Main Content - Full Width -->
        <main class="flex-1 ml-64 bg-[#f2f3f5] p-6 lg:p-8 w-full">
            <!-- Global Navbar -->
            <header class="mb-6 flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] px-5 py-4 shadow-[0_4px_20px_rgba(0,0,0,0.02)] sm:px-6 w-full">
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

            <!-- Page Header -->
            <div class="flex flex-wrap items-start justify-between gap-4 mb-6 w-full">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight text-[#1a1a1a]">Calendar</h1>
                    <p class="mt-1 text-sm text-[#6a6a6a]">Manage your schedule and events</p>
                </div>
                <button id="addEventBtn" class="rounded-full bg-[#1a1a1a] px-5 py-2.5 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333] shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                    <i class="fa-regular fa-plus mr-2"></i> Add Event
                </button>
            </div>

            <!-- Interactive Filter Pills + Quick Tools -->
            <div class="flex flex-wrap items-center gap-2 mb-6 w-full">
                <div class="filter-pill active flex items-center gap-2 rounded-full border border-[#e2e4e8] bg-[#1a1a1a] text-[#f6f7f9] px-4 py-2 cursor-pointer" data-filter="all">
                    <i class="fa-regular fa-calendar text-xs"></i>
                    <span class="text-xs font-medium">All Events</span>
                    <span class="text-xs font-semibold bg-white/20 px-2 py-0.5 rounded-full" id="totalCount">0</span>
                </div>
                <div class="filter-pill flex items-center gap-2 rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-4 py-2 cursor-pointer text-[#6a6a6a]" data-filter="deadline">
                    <span class="inline-block h-2.5 w-2.5 rounded-full bg-[#7c4dff]"></span>
                    <span class="text-xs font-medium">Deadlines</span>
                    <span class="text-xs font-semibold bg-[#ede7f6] text-[#5e35b1] px-2 py-0.5 rounded-full" id="deadlineCount">0</span>
                </div>
                <div class="filter-pill flex items-center gap-2 rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-4 py-2 cursor-pointer text-[#6a6a6a]" data-filter="meeting">
                    <span class="inline-block h-2.5 w-2.5 rounded-full bg-[#2979ff]"></span>
                    <span class="text-xs font-medium">Meetings</span>
                    <span class="text-xs font-semibold bg-[#e3f2fd] text-[#0d47a1] px-2 py-0.5 rounded-full" id="meetingCount">0</span>
                </div>
                <div class="filter-pill flex items-center gap-2 rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-4 py-2 cursor-pointer text-[#6a6a6a]" data-filter="completed">
                    <span class="inline-block h-2.5 w-2.5 rounded-full bg-[#00c853]"></span>
                    <span class="text-xs font-medium">Completed</span>
                    <span class="text-xs font-semibold bg-[#e8f5e9] text-[#1b5e20] px-2 py-0.5 rounded-full" id="completedCount">0</span>
                </div>
                
                <div class="flex-1"></div>
                
                <div class="flex items-center gap-2">
                    <button class="tool-btn rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-3 py-2 text-xs font-medium text-[#6a6a6a] transition">
                        <i class="fa-brands fa-google mr-1.5"></i> Sync
                    </button>
                    <button class="tool-btn rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-3 py-2 text-xs font-medium text-[#6a6a6a] transition">
                        <i class="fa-solid fa-print mr-1.5"></i> Print
                    </button>
                    <button class="tool-btn rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-3 py-2 text-xs font-medium text-[#6a6a6a] transition">
                        <i class="fa-solid fa-file-export mr-1.5"></i> Export
                    </button>
                </div>
            </div>

            <!-- Calendar Controls -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6 w-full">
                <div>
                    <h2 class="text-lg font-semibold tracking-tight text-[#1a1a1a]" id="currentMonthDisplay">July 2026</h2>
                </div>
                <div class="flex items-center gap-3">
                    <button id="prevMonth" class="rounded-full border border-[#e2e4e8] p-2 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>
                    <button id="todayBtn" class="rounded-full border border-[#e2e4e8] px-4 py-1.5 text-xs font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                        Today
                    </button>
                    <button id="nextMonth" class="rounded-full border border-[#e2e4e8] p-2 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                    <div class="w-px h-6 bg-[#e2e4e8] mx-1"></div>
                    <div class="flex gap-1 rounded-xl bg-[#f2f3f5] p-1 border border-[#e2e4e8]">
                        <button class="view-btn active" data-view="month">Month</button>
                        <button class="view-btn" data-view="week">Week</button>
                        <button class="view-btn" data-view="day">Day</button>
                    </div>
                </div>
            </div>

            <!-- Two-Column Layout -->
            <div class="flex gap-6 w-full">
                <!-- Left Column - Calendar -->
                <div class="flex-1 min-w-0 space-y-6">
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.02)] w-full">
                        <div id="calendarHeaders" class="grid grid-cols-7 border-b border-[#e2e4e8]">
                            @php
                                $dayHeaders = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            @endphp
                            @foreach ($dayHeaders as $day)
                                <div class="py-3 text-center border-r border-[#e2e4e8] last:border-r-0">
                                    <div class="text-xs font-medium text-[#8a8a8a] uppercase">{{ substr($day, 0, 3) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div id="calendarGrid" class="grid grid-cols-7 w-full">
                            <!-- Rendered by JavaScript -->
                        </div>
                    </div>
                </div>

                <!-- Right Column - Analytics Sidebar -->
                <div class="w-80 flex-shrink-0 space-y-6">
                    <!-- Schedule Metrics Card -->
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] stat-card">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">Schedule Metrics</h3>
                            <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a]">This Week</span>
                        </div>
                        
                        <div class="flex items-center justify-center mb-4">
                            <div class="relative w-32 h-32">
                                <svg class="progress-ring w-full h-full" viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" fill="none" stroke="#e2e4e8" stroke-width="6"/>
                                    <circle cx="50" cy="50" r="45" fill="none" stroke="#1a1a1a" stroke-width="6" 
                                            stroke-dasharray="283" stroke-dashoffset="71" stroke-linecap="round"/>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center">
                                        <span class="text-2xl font-bold text-[#1a1a1a]">75%</span>
                                        <p class="text-[9px] text-[#8a8a8a] uppercase">Productive</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 rounded-xl bg-[#f2f3f5]">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-clock text-xs text-[#6a6a6a]"></i>
                                    <span class="text-xs text-[#6a6a6a]">Meeting Hours</span>
                                </div>
                                <span class="text-sm font-semibold text-[#1a1a1a]">12.5h</span>
                            </div>
                            <div class="flex items-center justify-between p-3 rounded-xl bg-[#f2f3f5]">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-flag text-xs text-[#6a6a6a]"></i>
                                    <span class="text-xs text-[#6a6a6a]">Deadlines Met</span>
                                </div>
                                <span class="text-sm font-semibold text-[#1a1a1a]">8/10</span>
                            </div>
                            <div class="flex items-center justify-between p-3 rounded-xl bg-[#f2f3f5]">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-hourglass-half text-xs text-[#6a6a6a]"></i>
                                    <span class="text-xs text-[#6a6a6a]">Time Tracked</span>
                                </div>
                                <span class="text-sm font-semibold text-[#1a1a1a]">32.5h</span>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Agenda -->
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] stat-card">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">Upcoming Agenda</h3>
                            <span class="text-xs font-medium text-[#1a1a1a] bg-[#f2f3f5] px-3 py-1 rounded-full" id="selectedDateDisplay">Today</span>
                        </div>
                        
                        <div id="agendaList" class="space-y-2 max-h-80 overflow-y-auto pr-1">
                            <div class="text-center py-8">
                                <i class="fa-regular fa-calendar-check text-3xl text-[#c8c8c8] mb-2"></i>
                                <p class="text-xs text-[#8a8a8a]">Select a date to view agenda</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-[#e2e4e8]">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-[#8a8a8a]">Total events today</span>
                                <span class="text-sm font-semibold text-[#1a1a1a]" id="agendaCount">0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Overview -->
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] stat-card">
                        <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a] mb-4">Monthly Overview</h3>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-[#6a6a6a]">Events Completed</span>
                                    <span class="font-medium text-[#1a1a1a]" id="monthCompleted">0/0</span>
                                </div>
                                <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                    <div class="h-1.5 rounded-full bg-[#1a1a1a]" style="width: 65%" id="monthProgressBar"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2 mt-3">
                                <div class="rounded-xl bg-[#f2f3f5] p-3 text-center">
                                    <p class="text-lg font-bold text-[#1a1a1a]" id="weekEvents">12</p>
                                    <p class="text-[9px] text-[#8a8a8a] uppercase">This Week</p>
                                </div>
                                <div class="rounded-xl bg-[#f2f3f5] p-3 text-center">
                                    <p class="text-lg font-bold text-[#1a1a1a]" id="monthEvents">45</p>
                                    <p class="text-[9px] text-[#8a8a8a] uppercase">This Month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add/Edit Event Modal -->
    <div id="eventModal" class="modal-overlay">
        <div class="modal-content">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold tracking-tight text-[#1a1a1a]" id="modalTitle">Add Event</h3>
                <button id="closeModal" class="rounded-full border border-[#e2e4e8] p-2 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form id="eventForm" class="space-y-4">
                <input type="hidden" id="eventId" value="">
                
                <div>
                    <label for="eventTitle">Event Title</label>
                    <input type="text" id="eventTitle" placeholder="Enter event title" required>
                </div>
                
                <div>
                    <label for="eventDate">Date</label>
                    <input type="date" id="eventDate" required>
                </div>
                
                <div>
                    <label for="eventTime">Time</label>
                    <input type="time" id="eventTime">
                </div>
                
                <div>
                    <label for="eventType">Event Type</label>
                    <select id="eventType" required>
                        <option value="meeting">Meeting</option>
                        <option value="deadline">Deadline</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                
                <div>
                    <label for="eventDescription">Description (Optional)</label>
                    <textarea id="eventDescription" rows="3" placeholder="Add description..."></textarea>
                </div>
                
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 rounded-full bg-[#1a1a1a] px-6 py-3 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333]">
                        <i class="fa-regular fa-check mr-2"></i> Save Event
                    </button>
                    <button type="button" id="deleteEventBtn" class="rounded-full border border-red-500 px-6 py-3 text-sm font-medium text-red-500 transition hover:bg-red-50 hidden">
                        <i class="fa-regular fa-trash mr-2"></i> Delete
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        class CalendarApp {
            constructor() {
                this.currentDate = new Date();
                this.currentMonth = this.currentDate.getMonth();
                this.currentYear = this.currentDate.getFullYear();
                this.currentView = 'month';
                this.selectedDate = this.formatDate(new Date());
                this.activeFilter = 'all';
                this.events = [];
                
                this.init();
            }
            
            init() {
                this.loadSampleEvents();
                this.setupEventListeners();
                this.updateAgendaForDate(this.selectedDate);
            }
            
            loadSampleEvents() {
                const today = new Date();
                const currentMonth = today.getMonth();
                const currentYear = today.getFullYear();
                
                this.events = [
                    { id: 1, date: this.formatDate(new Date(currentYear, currentMonth, 5)), title: 'Project Deadline', type: 'deadline', description: 'Submit final deliverables', time: '10:00' },
                    { id: 2, date: this.formatDate(new Date(currentYear, currentMonth, 12)), title: 'Team Meeting', type: 'meeting', description: 'Weekly sync with team', time: '14:00' },
                    { id: 3, date: this.formatDate(new Date(currentYear, currentMonth, 15)), title: 'Design Review', type: 'deadline', description: 'Review UI designs', time: '11:30' },
                    { id: 4, date: this.formatDate(new Date(currentYear, currentMonth, 20)), title: 'Sprint Planning', type: 'meeting', description: 'Plan next sprint', time: '09:00' },
                    { id: 5, date: this.formatDate(new Date(currentYear, currentMonth, 25)), title: 'Client Presentation', type: 'deadline', description: 'Present to client', time: '15:00' },
                    { id: 6, date: this.formatDate(new Date(currentYear, currentMonth, 28)), title: 'Code Review', type: 'meeting', description: 'Review pull requests', time: '16:30' },
                    { id: 7, date: this.formatDate(new Date(currentYear, currentMonth, 8)), title: 'Documentation Complete', type: 'completed', description: 'API docs finished', time: '13:00' },
                    { id: 8, date: this.formatDate(new Date(currentYear, currentMonth, 18)), title: 'Budget Review', type: 'meeting', description: 'Monthly budget analysis', time: '11:00' },
                    { id: 9, date: this.formatDate(today), title: 'Daily Standup', type: 'meeting', description: 'Quick team sync', time: '09:00' },
                    { id: 10, date: this.formatDate(today), title: 'Lunch & Learn', type: 'meeting', description: 'Knowledge sharing session', time: '12:00' },
                ];
                
                this.renderCalendar();
                this.updateStats();
                this.updateMonthlyOverview();
            }
            
            formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }
            
            getMonthName(month) {
                return ['January', 'February', 'March', 'April', 'May', 'June', 
                       'July', 'August', 'September', 'October', 'November', 'December'][month];
            }
            
            getDaysInMonth(month, year) {
                return new Date(year, month + 1, 0).getDate();
            }
            
            getFirstDayOfMonth(month, year) {
                return new Date(year, month, 1).getDay();
            }
            
            getEventsForDate(dateStr) {
                return this.events.filter(e => e.date === dateStr);
            }
            
            renderCalendar() {
                const grid = document.getElementById('calendarGrid');
                const monthDisplay = document.getElementById('currentMonthDisplay');
                
                if (!grid) return;
                
                if (monthDisplay) {
                    monthDisplay.textContent = `${this.getMonthName(this.currentMonth)} ${this.currentYear}`;
                }
                
                const daysInMonth = this.getDaysInMonth(this.currentMonth, this.currentYear);
                const firstDay = this.getFirstDayOfMonth(this.currentMonth, this.currentYear);
                const firstDayMonday = firstDay === 0 ? 6 : firstDay - 1;
                
                const today = new Date();
                const todayDate = today.getDate();
                const todayMonth = today.getMonth();
                const todayYear = today.getFullYear();
                
                let html = '';
                
                for (let i = 0; i < firstDayMonday; i++) {
                    html += `<div class="border-r border-b border-[#e2e4e8] p-2 min-h-[100px] bg-[#fafafa]"></div>`;
                }
                
                for (let day = 1; day <= daysInMonth; day++) {
                    const date = new Date(this.currentYear, this.currentMonth, day);
                    const dateStr = this.formatDate(date);
                    const dayEvents = this.getEventsForDate(dateStr);
                    
                    const isToday = day === todayDate && this.currentMonth === todayMonth && this.currentYear === todayYear;
                    const isWeekend = date.getDay() === 0 || date.getDay() === 6;
                    const isSelected = dateStr === this.selectedDate;
                    
                    const hasDeadline = dayEvents.some(e => e.type === 'deadline');
                    const hasMeeting = dayEvents.some(e => e.type === 'meeting');
                    const hasCompleted = dayEvents.some(e => e.type === 'completed');
                    
                    let dotClass = '';
                    if (hasDeadline) dotClass = 'deadline';
                    else if (hasMeeting) dotClass = 'meeting';
                    else if (hasCompleted) dotClass = 'completed';
                    
                    const hasEvents = hasDeadline || hasMeeting || hasCompleted;
                    
                    html += `
                        <div class="day-cell border-r border-b border-[#e2e4e8] p-2 min-h-[100px] relative ${isSelected ? 'bg-[#f8f9fb]' : ''}" 
                             data-date="${dateStr}"
                             onclick="window.calendar.selectDate('${dateStr}')">
                            <div class="flex items-start justify-between mb-1">
                                <span class="date-number ${isToday ? 'today' : ''} ${isWeekend && !isToday ? 'weekend' : ''} ${isSelected && !isToday ? 'selected' : ''}">
                                    ${day}
                                </span>
                                ${hasEvents ? `<span class="event-dot ${dotClass}"></span>` : ''}
                            </div>
                            <div class="space-y-1">
                                ${dayEvents.slice(0, 3).map(event => `
                                    <div class="calendar-event ${event.type === 'deadline' ? 'event-purple' : event.type === 'meeting' ? 'event-blue' : 'event-green'}">
                                        ${event.time ? `<span style="font-weight:600;font-size:9px;opacity:0.7">${event.time}</span> ` : ''}
                                        <span style="font-weight:600;font-size:10px">${event.title}</span>
                                    </div>
                                `).join('')}
                                ${dayEvents.length > 3 ? `<div style="font-size:8px;color:#8a8a8a;padding:0 8px">+${dayEvents.length - 3} more</div>` : ''}
                            </div>
                        </div>
                    `;
                }
                
                const totalCells = firstDayMonday + daysInMonth;
                const remainingCells = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
                for (let i = 0; i < remainingCells; i++) {
                    html += `<div class="border-r border-b border-[#e2e4e8] p-2 min-h-[100px] bg-[#fafafa]"></div>`;
                }
                
                grid.innerHTML = html;
            }
            
            selectDate(dateStr) {
                this.selectedDate = dateStr;
                this.renderCalendar();
                this.updateAgendaForDate(dateStr);
            }
            
            updateAgendaForDate(dateStr) {
                const agendaList = document.getElementById('agendaList');
                const agendaCount = document.getElementById('agendaCount');
                const selectedDateDisplay = document.getElementById('selectedDateDisplay');
                
                if (!agendaList) return;
                
                const dateObj = new Date(dateStr + 'T00:00:00');
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1);
                
                let dateLabel = dateObj.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                if (this.formatDate(dateObj) === this.formatDate(today)) dateLabel = 'Today';
                else if (this.formatDate(dateObj) === this.formatDate(tomorrow)) dateLabel = 'Tomorrow';
                
                if (selectedDateDisplay) selectedDateDisplay.textContent = dateLabel;
                
                const dayEvents = this.getEventsForDate(dateStr);
                
                if (agendaCount) agendaCount.textContent = dayEvents.length;
                
                if (dayEvents.length === 0) {
                    agendaList.innerHTML = `
                        <div class="text-center py-8">
                            <i class="fa-regular fa-calendar-check text-3xl text-[#c8c8c8] mb-2"></i>
                            <p class="text-xs text-[#8a8a8a]">No events for this date</p>
                        </div>
                    `;
                    return;
                }
                
                const typeIcons = {
                    deadline: 'fa-flag',
                    meeting: 'fa-users',
                    completed: 'fa-check-circle'
                };
                const typeColors = {
                    deadline: 'deadline',
                    meeting: 'meeting',
                    completed: 'completed'
                };
                
                let html = '';
                dayEvents.sort((a, b) => (a.time || '').localeCompare(b.time || ''));
                
                dayEvents.forEach(event => {
                    html += `
                        <div class="agenda-item flex items-start gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white cursor-pointer hover:border-[#d1d3d8]" onclick="window.calendar.editEvent(${event.id})">
                            <div class="event-badge ${typeColors[event.type] || 'meeting'} mt-0.5">
                                <i class="fa-regular ${typeIcons[event.type] || 'fa-calendar'} text-xs"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-[#1a1a1a]">${event.title}</p>
                                ${event.description ? `<p class="text-[10px] text-[#8a8a8a] truncate">${event.description}</p>` : ''}
                                ${event.time ? `<p class="text-[10px] text-[#8a8a8a] mt-0.5">${event.time}</p>` : ''}
                            </div>
                        </div>
                    `;
                });
                
                agendaList.innerHTML = html;
            }
            
            updateStats() {
                const deadlineCount = this.events.filter(e => e.type === 'deadline').length;
                const meetingCount = this.events.filter(e => e.type === 'meeting').length;
                const completedCount = this.events.filter(e => e.type === 'completed').length;
                const totalCount = this.events.length;
                
                const deadlineEl = document.getElementById('deadlineCount');
                const meetingEl = document.getElementById('meetingCount');
                const completedEl = document.getElementById('completedCount');
                const totalEl = document.getElementById('totalCount');
                
                if (deadlineEl) deadlineEl.textContent = deadlineCount;
                if (meetingEl) meetingEl.textContent = meetingCount;
                if (completedEl) completedEl.textContent = completedCount;
                if (totalEl) totalEl.textContent = totalCount;
            }
            
            updateMonthlyOverview() {
                const monthEvents = this.events.filter(e => {
                    const d = new Date(e.date);
                    return d.getMonth() === this.currentMonth && d.getFullYear() === this.currentYear;
                });
                const completedEvents = monthEvents.filter(e => e.type === 'completed');
                const percentage = monthEvents.length > 0 ? Math.round((completedEvents.length / monthEvents.length) * 100) : 0;
                
                const monthCompletedEl = document.getElementById('monthCompleted');
                const monthProgressBar = document.getElementById('monthProgressBar');
                const monthEventsEl = document.getElementById('monthEvents');
                const weekEventsEl = document.getElementById('weekEvents');
                
                if (monthCompletedEl) monthCompletedEl.textContent = `${completedEvents.length}/${monthEvents.length}`;
                if (monthProgressBar) monthProgressBar.style.width = `${percentage}%`;
                if (monthEventsEl) monthEventsEl.textContent = monthEvents.length;
                
                const today = new Date();
                const weekStart = new Date(today);
                weekStart.setDate(today.getDate() - today.getDay() + 1);
                const weekEvents = this.events.filter(e => new Date(e.date) >= weekStart);
                if (weekEventsEl) weekEventsEl.textContent = weekEvents.length;
            }
            
            openModal(event = null, date = null) {
                const modal = document.getElementById('eventModal');
                const title = document.getElementById('modalTitle');
                const deleteBtn = document.getElementById('deleteEventBtn');
                
                if (!modal) return;
                
                if (event) {
                    title.textContent = 'Edit Event';
                    document.getElementById('eventId').value = event.id;
                    document.getElementById('eventTitle').value = event.title;
                    document.getElementById('eventDate').value = event.date;
                    document.getElementById('eventTime').value = event.time || '';
                    document.getElementById('eventType').value = event.type;
                    document.getElementById('eventDescription').value = event.description || '';
                    deleteBtn.classList.remove('hidden');
                } else {
                    title.textContent = 'Add Event';
                    document.getElementById('eventId').value = '';
                    document.getElementById('eventTitle').value = '';
                    document.getElementById('eventDate').value = date || this.formatDate(this.currentDate);
                    document.getElementById('eventTime').value = '';
                    document.getElementById('eventType').value = 'meeting';
                    document.getElementById('eventDescription').value = '';
                    deleteBtn.classList.add('hidden');
                }
                
                modal.classList.add('active');
            }
            
            closeModal() {
                const modal = document.getElementById('eventModal');
                if (modal) modal.classList.remove('active');
            }
            
            editEvent(id) {
                const event = this.events.find(e => e.id === id);
                if (event) {
                    this.openModal(event);
                }
            }
            
            previousMonth() {
                this.currentMonth--;
                if (this.currentMonth < 0) {
                    this.currentMonth = 11;
                    this.currentYear--;
                }
                this.renderCalendar();
                this.updateMonthlyOverview();
            }
            
            nextMonth() {
                this.currentMonth++;
                if (this.currentMonth > 11) {
                    this.currentMonth = 0;
                    this.currentYear++;
                }
                this.renderCalendar();
                this.updateMonthlyOverview();
            }
            
            goToToday() {
                const today = new Date();
                this.currentMonth = today.getMonth();
                this.currentYear = today.getFullYear();
                this.selectedDate = this.formatDate(today);
                this.renderCalendar();
                this.updateAgendaForDate(this.selectedDate);
                this.updateMonthlyOverview();
            }
            
            switchView(view) {
                this.currentView = view;
                document.querySelectorAll('.view-btn').forEach(btn => {
                    btn.classList.remove('active', 'bg-[#1a1a1a]', 'text-[#f6f7f9]');
                    btn.classList.add('text-[#6a6a6a]');
                    if (btn.dataset.view === view) {
                        btn.classList.add('active', 'bg-[#1a1a1a]', 'text-[#f6f7f9]');
                        btn.classList.remove('text-[#6a6a6a]');
                    }
                });
            }
            
            setFilter(filter) {
                this.activeFilter = filter;
                document.querySelectorAll('.filter-pill').forEach(pill => {
                    pill.classList.remove('active', 'bg-[#1a1a1a]', 'text-[#f6f7f9]');
                    pill.classList.add('bg-[#f6f7f9]', 'text-[#6a6a6a]');
                });
                const activePill = document.querySelector(`[data-filter="${filter}"]`);
                if (activePill) {
                    activePill.classList.add('active', 'bg-[#1a1a1a]', 'text-[#f6f7f9]');
                    activePill.classList.remove('bg-[#f6f7f9]', 'text-[#6a6a6a]');
                }
            }
            
            setupEventListeners() {
                document.getElementById('prevMonth')?.addEventListener('click', () => this.previousMonth());
                document.getElementById('nextMonth')?.addEventListener('click', () => this.nextMonth());
                document.getElementById('todayBtn')?.addEventListener('click', () => this.goToToday());
                
                document.querySelectorAll('.view-btn').forEach(btn => {
                    btn.addEventListener('click', () => this.switchView(btn.dataset.view));
                });
                
                document.querySelectorAll('.filter-pill').forEach(pill => {
                    pill.addEventListener('click', () => this.setFilter(pill.dataset.filter));
                });
                
                document.getElementById('addEventBtn')?.addEventListener('click', () => this.openModal());
                document.getElementById('closeModal')?.addEventListener('click', () => this.closeModal());
                document.getElementById('eventModal')?.addEventListener('click', (e) => {
                    if (e.target === e.currentTarget) this.closeModal();
                });
                
                document.getElementById('eventForm')?.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const eventData = {
                        title: document.getElementById('eventTitle').value,
                        date: document.getElementById('eventDate').value,
                        time: document.getElementById('eventTime').value,
                        type: document.getElementById('eventType').value,
                        description: document.getElementById('eventDescription').value,
                    };
                    
                    const eventId = document.getElementById('eventId').value;
                    if (eventId) {
                        const index = this.events.findIndex(e => e.id === parseInt(eventId));
                        if (index !== -1) {
                            this.events[index] = { ...this.events[index], ...eventData };
                        }
                    } else {
                        eventData.id = Date.now();
                        this.events.push(eventData);
                    }
                    
                    this.renderCalendar();
                    this.updateStats();
                    this.updateMonthlyOverview();
                    this.updateAgendaForDate(this.selectedDate);
                    this.closeModal();
                });
                
                document.getElementById('deleteEventBtn')?.addEventListener('click', () => {
                    const eventId = parseInt(document.getElementById('eventId').value);
                    if (eventId && confirm('Are you sure you want to delete this event?')) {
                        this.events = this.events.filter(e => e.id !== eventId);
                        this.renderCalendar();
                        this.updateStats();
                        this.updateMonthlyOverview();
                        this.updateAgendaForDate(this.selectedDate);
                        this.closeModal();
                    }
                });
            }
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            window.calendar = new CalendarApp();
        });
    </script>
</body>
</html>
@endsection