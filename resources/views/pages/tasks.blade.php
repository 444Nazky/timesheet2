@extends('layouts.app')

@section('content')
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
                    ['label' => 'Dashboard', 'icon' => 'fa-th-large', 'route' => 'dashboard', 'active' => false, 'badge' => null],
                    ['label' => 'Projects', 'icon' => 'fa-briefcase', 'route' => 'projects', 'active' => false, 'badge' => '12'],
                    ['label' => 'My Task', 'icon' => 'fa-tasks', 'route' => 'tasks', 'active' => true, 'badge' => '5'],
                    ['label' => 'Reports', 'icon' => 'fa-chart-bar', 'route' => 'reports', 'active' => false, 'badge' => null],
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
                <input type="text" placeholder="Search tasks..." class="w-full rounded-full border border-[#e2e4e8] bg-[#f2f3f5] py-2.5 pl-10 pr-4 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9]">
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
                    <img src="{{ asset('assets/guest.svg') }}" alt="User" class="h-9 w-9 rounded-full border border-[#e2e4e8] object-cover">
                    <div class="hidden sm:block">
                        <p class="text-sm font-medium text-[#1a1a1a]">User 1</p>
                        <p class="text-xs text-[#8a8a8a]">Product Designer</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Tasks Content -->
        <div class="space-y-6">
            <!-- Welcome Banner -->
            <div class="rounded-2xl bg-[#1a1a1a] p-6 text-[#f2f3f5]">
                <div class="flex flex-wrap items-center justify-between">
                    <div>
                        <p class="text-sm font-light opacity-70">📋 Task Overview</p>
                        <h2 class="mt-1 text-xl font-semibold tracking-tight">You have <span class="text-white font-bold">8 tasks</span> to complete</h2>
                        <p class="mt-1 text-sm opacity-60">4 high priority tasks need your attention</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-xs opacity-60">Completion rate</p>
                            <p class="text-2xl font-bold">75%</p>
                        </div>
                        <div class="h-12 w-12 rounded-full border-2 border-white/20 flex items-center justify-center">
                            <svg class="h-10 w-10 -rotate-90 transform">
                                <circle cx="20" cy="20" r="16" stroke="rgba(255,255,255,0.1)" stroke-width="3" fill="none"/>
                                <circle cx="20" cy="20" r="16" stroke="#10b981" stroke-width="3" fill="none" 
                                    stroke-dasharray="100.48" stroke-dashoffset="25.12"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Header -->
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight text-[#1a1a1a]">My Tasks</h1>
                    <p class="mt-1 text-sm text-[#8a8a8a]">Plan, track, and update your task progress</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <button class="rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-5 py-2.5 text-sm font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                        <i class="fa-regular fa-sliders mr-2"></i> Filter
                    </button>
                    <button id="openTaskModal" class="rounded-full bg-[#1a1a1a] px-5 py-2.5 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333] shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                        <i class="fa-regular fa-plus mr-2"></i> New Task
                    </button>
                </div>
            </div>

            <!-- Stats Summary -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">Total Tasks</p>
                            <p class="mt-1.5 text-2xl font-semibold text-[#1a1a1a]">24</p>
                            <p class="text-[10px] text-emerald-600">↑ 12% this week</p>
                        </div>
                        <div class="rounded-xl bg-[#eceef0] p-2.5 group-hover:bg-[#1a1a1a] group-hover:text-[#f6f7f9] transition-colors">
                            <i class="fa-regular fa-list-check text-[#1a1a1a] group-hover:text-[#f6f7f9]"></i>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">To Do</p>
                            <p class="mt-1.5 text-2xl font-semibold text-[#1a1a1a]">8</p>
                            <p class="text-[10px] text-[#8a8a8a]">Need to start</p>
                        </div>
                        <div class="rounded-xl bg-[#eceef0] p-2.5 group-hover:bg-[#1a1a1a] group-hover:text-[#f6f7f9] transition-colors">
                            <i class="fa-regular fa-circle text-[#1a1a1a] group-hover:text-[#f6f7f9]"></i>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">In Progress</p>
                            <p class="mt-1.5 text-2xl font-semibold text-blue-600">5</p>
                            <p class="text-[10px] text-blue-600">⚡ Active</p>
                        </div>
                        <div class="rounded-xl bg-blue-50 p-2.5 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fa-regular fa-spinner text-blue-600 group-hover:text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">Done</p>
                            <p class="mt-1.5 text-2xl font-semibold text-emerald-600">12</p>
                            <p class="text-[10px] text-emerald-600">✓ Completed</p>
                        </div>
                        <div class="rounded-xl bg-emerald-50 p-2.5 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <i class="fa-regular fa-check-circle text-emerald-600 group-hover:text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover group">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">High Priority</p>
                            <p class="mt-1.5 text-2xl font-semibold text-red-600">4</p>
                            <p class="text-[10px] text-red-600">⚠️ Urgent</p>
                        </div>
                        <div class="rounded-xl bg-red-50 p-2.5 group-hover:bg-red-600 group-hover:text-white transition-colors">
                            <i class="fa-regular fa-flag text-red-600 group-hover:text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Toggle & Sort -->
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2 rounded-xl border border-[#e2e4e8] bg-[#f6f7f9] p-1">
                    <button class="rounded-lg bg-[#1a1a1a] px-4 py-1.5 text-xs font-medium text-[#f6f7f9]">
                        <i class="fa-regular fa-table-columns mr-1.5"></i> Board
                    </button>
                    <button class="rounded-lg px-4 py-1.5 text-xs font-medium text-[#6a6a6a] transition hover:text-[#1a1a1a]">
                        <i class="fa-regular fa-list mr-1.5"></i> List
                    </button>
                    <button class="rounded-lg px-4 py-1.5 text-xs font-medium text-[#6a6a6a] transition hover:text-[#1a1a1a]">
                        <i class="fa-regular fa-calendar mr-1.5"></i> Calendar
                    </button>
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-xs text-[#8a8a8a]">Sort by:</label>
                    <select class="rounded-xl border border-[#e2e4e8] bg-[#f6f7f9] px-3 py-1.5 text-xs text-[#1a1a1a] focus:border-[#1a1a1a] focus:outline-none">
                        <option>Due Date (Earliest)</option>
                        <option>Priority (High First)</option>
                        <option>Recently Added</option>
                        <option>Recently Updated</option>
                    </select>
                </div>
            </div>

            <!-- Board / Columns -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                @php
                    $tasks = [
                        [
                            'title' => 'Design task flow',
                            'status' => 'todo',
                            'priority' => 'high',
                            'due' => '2026-07-15',
                            'assignees' => ['assets/guest.svg', 'assets/guest.svg'],
                            'desc' => 'Update the task flow diagram and review with the team.',
                            'comments' => 3,
                            'attachments' => 2,
                            'project' => 'Project Alpha',
                            'labels' => ['Design', 'UI/UX']
                        ],
                        [
                            'title' => 'Implement task filters',
                            'status' => 'in_progress',
                            'priority' => 'medium',
                            'due' => '2026-07-18',
                            'assignees' => ['assets/guest.svg'],
                            'desc' => 'Add filter and sorting logic to the UI with proper state management.',
                            'comments' => 1,
                            'attachments' => 0,
                            'project' => 'Project Beta',
                            'labels' => ['Frontend', 'Development']
                        ],
                        [
                            'title' => 'Fix dashboard UI alignment',
                            'status' => 'in_progress',
                            'priority' => 'high',
                            'due' => '2026-07-14',
                            'assignees' => ['assets/guest.svg', 'assets/guest.svg', 'assets/guest.svg'],
                            'desc' => 'Adjust spacing and component hover states across the dashboard.',
                            'comments' => 5,
                            'attachments' => 1,
                            'project' => 'Project Alpha',
                            'labels' => ['UI', 'Bug Fix']
                        ],
                        [
                            'title' => 'Write report summary',
                            'status' => 'done',
                            'priority' => 'low',
                            'due' => '2026-07-01',
                            'assignees' => ['assets/guest.svg'],
                            'desc' => 'Draft weekly summary and share with admin for review.',
                            'comments' => 0,
                            'attachments' => 0,
                            'project' => 'Project Gamma',
                            'labels' => ['Documentation']
                        ],
                        [
                            'title' => 'QA tasks list page',
                            'status' => 'todo',
                            'priority' => 'medium',
                            'due' => '2026-07-21',
                            'assignees' => ['assets/guest.svg'],
                            'desc' => 'Verify empty states, loading states, and sorting functionality.',
                            'comments' => 2,
                            'attachments' => 1,
                            'project' => 'Project Alpha',
                            'labels' => ['Testing', 'QA']
                        ],
                        [
                            'title' => 'Submit timesheet export',
                            'status' => 'done',
                            'priority' => 'medium',
                            'due' => '2026-06-28',
                            'assignees' => ['assets/guest.svg', 'assets/guest.svg'],
                            'desc' => 'Export timesheet data (CSV) for review and approval.',
                            'comments' => 0,
                            'attachments' => 2,
                            'project' => 'Project Beta',
                            'labels' => ['Data', 'Export']
                        ],
                        [
                            'title' => 'Update user documentation',
                            'status' => 'todo',
                            'priority' => 'low',
                            'due' => '2026-07-25',
                            'assignees' => ['assets/guest.svg'],
                            'desc' => 'Update the user guide with new features and screenshots.',
                            'comments' => 0,
                            'attachments' => 0,
                            'project' => 'Project Gamma',
                            'labels' => ['Documentation', 'Training']
                        ],
                        [
                            'title' => 'Deploy to production',
                            'status' => 'todo',
                            'priority' => 'high',
                            'due' => '2026-07-12',
                            'assignees' => ['assets/guest.svg', 'assets/guest.svg', 'assets/guest.svg'],
                            'desc' => 'Final deployment checklist and verification.',
                            'comments' => 4,
                            'attachments' => 3,
                            'project' => 'Project Alpha',
                            'labels' => ['DevOps', 'Deployment']
                        ],
                    ];

                    $col = [
                        'todo' => ['label' => 'To Do', 'badge' => 'text-[#1a1a1a]', 'dot' => 'bg-[#1a1a1a]', 'bg' => 'bg-[#f2f3f5]'],
                        'in_progress' => ['label' => 'In Progress', 'badge' => 'text-blue-600', 'dot' => 'bg-blue-500', 'bg' => 'bg-blue-50/30'],
                        'done' => ['label' => 'Done', 'badge' => 'text-emerald-600', 'dot' => 'bg-emerald-500', 'bg' => 'bg-emerald-50/30'],
                    ];

                    $priorityMap = [
                        'high' => ['bg' => 'bg-red-50', 'text' => 'text-red-600', 'border' => 'border-red-200', 'label' => 'High', 'icon' => 'fa-arrow-up'],
                        'medium' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-200', 'label' => 'Medium', 'icon' => 'fa-minus'],
                        'low' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-200', 'label' => 'Low', 'icon' => 'fa-arrow-down'],
                    ];
                @endphp

                @foreach(['todo', 'in_progress', 'done'] as $status)
                    @php $meta = $col[$status]; @endphp
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="h-2 w-2 rounded-full {{ $meta['dot'] }}"></span>
                                <h2 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">{{ $meta['label'] }}</h2>
                            </div>
                            <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium text-[#6a6a6a]">
                                {{ collect($tasks)->where('status', $status)->count() }}
                            </span>
                        </div>

                        <div class="mt-4 space-y-3 max-h-[600px] overflow-y-auto pr-1 scrollbar-thin">
                            @foreach($tasks as $t)
                                @if($t['status'] === $status)
                                    @php
                                        $p = $priorityMap[$t['priority']];
                                        $isOverdue = strtotime($t['due']) < strtotime(date('Y-m-d')) && $status !== 'done';
                                        $isToday = strtotime($t['due']) === strtotime(date('Y-m-d'));
                                    @endphp

                                    <div class="group rounded-2xl border border-[#e2e4e8] bg-white p-4 transition-all duration-200 hover:border-[#c8c8c8] hover:shadow-[0_4px_12px_rgba(0,0,0,0.04)]">
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="min-w-0 flex-1">
                                                <div class="flex items-center gap-2">
                                                    <input type="checkbox" class="task-checkbox h-4 w-4 rounded border-[#d1d3d8] text-[#1a1a1a] focus:ring-0 cursor-pointer" {{ $status === 'done' ? 'checked' : '' }}>
                                                    <p class="text-xs text-[#8a8a8a]">
                                                        <span class="inline-flex items-center gap-1">
                                                            <i class="fa-regular fa-calendar text-[10px]"></i>
                                                            Due <span class="{{ $isOverdue ? 'text-red-600 font-semibold' : ($isToday ? 'text-amber-600 font-semibold' : '') }}">{{ $t['due'] }}</span>
                                                        </span>
                                                        @if($isOverdue)
                                                            <span class="ml-1 inline-flex items-center gap-1 text-red-600 text-[10px] font-semibold">
                                                                <i class="fa-regular fa-triangle-exclamation"></i> Overdue
                                                            </span>
                                                        @endif
                                                        @if($isToday && !$isOverdue)
                                                            <span class="ml-1 inline-flex items-center gap-1 text-amber-600 text-[10px] font-semibold">
                                                                <i class="fa-regular fa-clock"></i> Due Today
                                                            </span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <h3 class="mt-1 text-sm font-semibold text-[#1a1a1a] truncate group-hover:text-[#1a1a1a]">{{ $t['title'] }}</h3>
                                                <p class="mt-1 text-xs text-[#6a6a6a] line-clamp-2">{{ $t['desc'] }}</p>
                                                <div class="mt-2 flex flex-wrap gap-1.5">
                                                    <span class="inline-flex items-center gap-1 text-[10px] text-[#8a8a8a]">
                                                        <i class="fa-regular fa-folder-open text-[8px]"></i>
                                                        {{ $t['project'] }}
                                                    </span>
                                                    @foreach($t['labels'] as $label)
                                                        <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">{{ $label }}</span>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-end gap-2 flex-shrink-0">
                                                <span class="rounded-full border px-2.5 py-0.5 text-[9px] font-medium {{ $p['bg'] }} {{ $p['text'] }} {{ $p['border'] }}">
                                                    <i class="fa-regular {{ $p['icon'] }} mr-1 text-[8px]"></i>
                                                    {{ $p['label'] }}
                                                </span>
                                                <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <button class="rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-2.5 py-1 text-[10px] font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                                                        <i class="fa-regular fa-pen-to-square mr-1"></i> Edit
                                                    </button>
                                                    <button class="rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-2.5 py-1 text-[10px] font-medium text-red-500 transition hover:bg-red-50 hover:text-red-600">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4 flex items-center justify-between gap-4 pt-3 border-t border-[#e2e4e8]">
                                            <div class="flex -space-x-2">
                                                @foreach($t['assignees'] as $a)
                                                    <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="{{ $a }}" alt="Assignee">
                                                @endforeach
                                                @if(count($t['assignees']) > 3)
                                                    <div class="flex h-7 w-7 items-center justify-center rounded-full border-2 border-white bg-[#eceef0] text-[9px] font-medium text-[#6a6a6a]">+{{ count($t['assignees']) - 3 }}</div>
                                                @endif
                                            </div>

                                            <div class="flex items-center gap-3 text-xs text-[#8a8a8a]">
                                                @if($t['comments'] > 0)
                                                    <span class="flex items-center gap-1 hover:text-[#1a1a1a] transition-colors cursor-pointer">
                                                        <i class="fa-regular fa-comment"></i>
                                                        {{ $t['comments'] }}
                                                    </span>
                                                @endif
                                                @if($t['attachments'] > 0)
                                                    <span class="flex items-center gap-1 hover:text-[#1a1a1a] transition-colors cursor-pointer">
                                                        <i class="fa-regular fa-paperclip"></i>
                                                        {{ $t['attachments'] }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            @if(collect($tasks)->where('status', $status)->isEmpty())
                                <div class="rounded-2xl border border-[#e2e4e8] bg-white p-8 text-center">
                                    <i class="fa-regular fa-inbox text-3xl text-[#d1d3d8]"></i>
                                    <p class="mt-2 text-sm text-[#8a8a8a]">No tasks in this column</p>
                                    <button class="mt-3 text-xs font-medium text-[#1a1a1a] hover:underline">Add a task →</button>
                                </div>
                            @endif

                            <!-- Add Task Button for each column -->
                            <button class="w-full rounded-xl border-2 border-dashed border-[#e2e4e8] bg-white py-3 text-xs font-medium text-[#6a6a6a] transition hover:border-[#1a1a1a] hover:text-[#1a1a1a] hover:bg-[#f2f3f5]">
                                <i class="fa-regular fa-plus mr-2"></i> Add task
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Quick Stats Footer -->
            <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="flex items-center gap-3">
                        <div class="rounded-xl bg-[#eceef0] p-2.5">
                            <i class="fa-regular fa-clock text-[#1a1a1a]"></i>
                        </div>
                        <div>
                            <p class="text-xs text-[#8a8a8a]">Avg. completion time</p>
                            <p class="text-sm font-semibold text-[#1a1a1a]">3.2 days</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="rounded-xl bg-emerald-50 p-2.5">
                            <i class="fa-regular fa-check-double text-emerald-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-[#8a8a8a]">Tasks completed</p>
                            <p class="text-sm font-semibold text-emerald-600">12 / 24</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="rounded-xl bg-amber-50 p-2.5">
                            <i class="fa-regular fa-hourglass-half text-amber-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-[#8a8a8a]">In progress</p>
                            <p class="text-sm font-semibold text-amber-600">5 tasks</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="rounded-xl bg-red-50 p-2.5">
                            <i class="fa-regular fa-triangle-exclamation text-red-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-[#8a8a8a]">Overdue tasks</p>
                            <p class="text-sm font-semibold text-red-600">2 tasks</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Task Modal -->
<div id="taskModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden">
    <div class="w-full max-w-2xl rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-8 shadow-[0_20px_60px_rgba(0,0,0,0.15)] animate-slide-up">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold tracking-tight text-[#1a1a1a]">Create New Task</h2>
                <p class="mt-1 text-sm text-[#8a8a8a]">Add a new task to your workspace</p>
            </div>
            <button id="closeTaskModal" class="rounded-full border border-[#e2e4e8] bg-[#f2f3f5] p-2 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                <i class="fa-regular fa-xmark"></i>
            </button>
        </div>

        <form class="space-y-4">
            <div>
                <label class="text-xs font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">Task Title</label>
                <input type="text" class="mt-1.5 w-full rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-4 py-3 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9] focus:outline-none" placeholder="Enter task title...">
            </div>

            <div>
                <label class="text-xs font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">Description</label>
                <textarea rows="3" class="mt-1.5 w-full rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-4 py-3 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9] focus:outline-none" placeholder="Add task details..."></textarea>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="text-xs font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">Due Date</label>
                    <input type="date" class="mt-1.5 w-full rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-4 py-3 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9] focus:outline-none">
                </div>
                <div>
                    <label class="text-xs font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">Priority</label>
                    <select class="mt-1.5 w-full rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-4 py-3 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9] focus:outline-none">
                        <option>High</option>
                        <option selected>Medium</option>
                        <option>Low</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="text-xs font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">Status</label>
                    <select class="mt-1.5 w-full rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-4 py-3 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9] focus:outline-none">
                        <option>To Do</option>
                        <option>In Progress</option>
                        <option>Done</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">Assign To</label>
                    <select class="mt-1.5 w-full rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-4 py-3 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9] focus:outline-none">
                        <option>Myself</option>
                        <option>Team Member 1</option>
                        <option>Team Member 2</option>
                        <option>Team Member 3</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="text-xs font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">Project</label>
                <select class="mt-1.5 w-full rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-4 py-3 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9] focus:outline-none">
                    <option>Project Alpha</option>
                    <option>Project Beta</option>
                    <option>Project Gamma</option>
                </select>
            </div>

            <div class="flex flex-wrap items-center justify-end gap-3 pt-4 border-t border-[#e2e4e8]">
                <button type="button" id="closeTaskModalBtn" class="rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-6 py-2.5 text-sm font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                    Cancel
                </button>
                <button type="submit" class="rounded-xl bg-[#1a1a1a] px-6 py-2.5 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333] shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                    <i class="fa-regular fa-plus mr-2"></i> Create Task
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.85); }
    }
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(20px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    
    .animate-pulse-dot {
        animation: pulse-dot 2s infinite;
    }
    .animate-slide-up {
        animation: slide-up 0.3s ease-out forwards;
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
    
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 32px -12px rgba(0, 0, 0, 0.08);
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
    }
    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #c8c8c8;
        border-radius: 20px;
    }
    
    .task-checkbox:checked + div h3 {
        text-decoration: line-through;
        opacity: 0.6;
    }
</style>

<script>
    // Modal functionality
    const taskModal = document.getElementById('taskModal');
    const openModalBtn = document.getElementById('openTaskModal');
    const closeModalBtn = document.getElementById('closeTaskModal');
    const closeModalBtn2 = document.getElementById('closeTaskModalBtn');

    function openModal() {
        taskModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        taskModal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    if (openModalBtn) openModalBtn.addEventListener('click', openModal);
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (closeModalBtn2) closeModalBtn2.addEventListener('click', closeModal);

    // Close modal on outside click
    taskModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !taskModal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Task checkbox functionality with animation
    document.querySelectorAll('.task-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const taskCard = this.closest('.group');
            const title = taskCard.querySelector('h3');
            
            if (this.checked) {
                taskCard.style.transition = 'all 0.3s ease';
                taskCard.style.opacity = '0.6';
                title.style.textDecoration = 'line-through';
                title.style.transition = 'all 0.3s ease';
                
                // Add a subtle check animation
                this.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            } else {
                taskCard.style.opacity = '1';
                title.style.textDecoration = 'none';
            }
        });
    });

    // View toggle functionality
    document.querySelectorAll('.rounded-lg.px-4.py-1\\.5').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active state from all view buttons
            document.querySelectorAll('.rounded-lg.px-4.py-1\\.5').forEach(b => {
                b.classList.remove('bg-[#1a1a1a]', 'text-[#f6f7f9]');
                b.classList.add('text-[#6a6a6a]');
            });
            // Add active state to clicked button
            this.classList.add('bg-[#1a1a1a]', 'text-[#f6f7f9]');
            this.classList.remove('text-[#6a6a6a]');
        });
    });

    // Column add task button
    document.querySelectorAll('.border-2.border-dashed').forEach(btn => {
        btn.addEventListener('click', function() {
            openModal();
        });
    });

    console.log('✅ My Tasks page initialized!');
    console.log('📋 Total tasks: 24');
    console.log('💡 Click "New Task" or any "Add task" button to create a task');
</script>
@endsection