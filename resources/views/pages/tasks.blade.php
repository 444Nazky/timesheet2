<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks - Timesheet</title>
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
        
        .task-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .task-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
        }
        
        .status-badge {
            transition: all 0.2s ease;
        }
        
        .task-checkbox {
            transition: all 0.2s ease;
        }
        .task-checkbox:checked + .task-content h3 {
            text-decoration: line-through;
            opacity: 0.6;
        }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="min-h-screen bg-[#f2f3f5] text-[#1a1a1a] antialiased selection:bg-[#1a1a1a] selection:text-[#f2f3f5]">
    <div class="flex min-h-screen flex-col lg:flex-row">
        <!-- Sidebar -->
        @include('partials.sidebar')

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
                        <img src="assets/guest.svg" alt="User" class="h-9 w-9 rounded-full border border-[#e2e4e8] object-cover">
                        <div class="hidden sm:block">
                            <p class="text-sm font-medium text-[#1a1a1a]">User 1</p>
                            <p class="text-xs text-[#8a8a8a]">Product Designer</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Tasks Content -->
            <div class="space-y-6">
                <!-- Page Header -->
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-semibold tracking-tight text-[#1a1a1a]">My Tasks</h1>
                        <p class="mt-1 text-sm text-[#8a8a8a]">Plan, track, and update your task progress</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Quick Stats Badges -->
                        <div class="flex items-center gap-2 rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-4 py-1.5">
                            <span class="flex items-center gap-1.5 text-xs text-[#6a6a6a]">
                                <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
                                Done: <span class="font-medium text-[#1a1a1a]">12</span>
                            </span>
                            <span class="w-px h-4 bg-[#e2e4e8]"></span>
                            <span class="flex items-center gap-1.5 text-xs text-[#6a6a6a]">
                                <span class="inline-block h-2 w-2 rounded-full bg-blue-500"></span>
                                In Progress: <span class="font-medium text-[#1a1a1a]">5</span>
                            </span>
                            <span class="w-px h-4 bg-[#e2e4e8]"></span>
                            <span class="flex items-center gap-1.5 text-xs text-[#6a6a6a]">
                                <span class="inline-block h-2 w-2 rounded-full bg-red-500"></span>
                                Overdue: <span class="font-medium text-[#1a1a1a]">2</span>
                            </span>
                        </div>
                        <button class="rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-5 py-2.5 text-sm font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                            <i class="fa-regular fa-sliders mr-2"></i> Filter
                        </button>
                        <button class="rounded-full bg-[#1a1a1a] px-5 py-2.5 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333] shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                            <i class="fa-regular fa-plus mr-2"></i> New Task
                        </button>
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
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-xs text-[#8a8a8a]">Sort by:</label>
                        <select class="rounded-xl border border-[#e2e4e8] bg-[#f6f7f9] px-3 py-1.5 text-xs text-[#1a1a1a] focus:border-[#1a1a1a] focus:outline-none">
                            <option>Due Date</option>
                            <option>Priority</option>
                            <option>Status</option>
                            <option>Title</option>
                        </select>
                    </div>
                </div>

                <!-- Stats Summary -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">Total Tasks</p>
                                <p class="mt-1.5 text-2xl font-semibold text-[#1a1a1a]">24</p>
                            </div>
                            <div class="rounded-xl bg-[#eceef0] p-2.5">
                                <i class="fa-regular fa-list-check text-[#1a1a1a]"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">To Do</p>
                                <p class="mt-1.5 text-2xl font-semibold text-[#1a1a1a]">7</p>
                            </div>
                            <div class="rounded-xl bg-[#eceef0] p-2.5">
                                <i class="fa-regular fa-circle text-[#1a1a1a]"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">In Progress</p>
                                <p class="mt-1.5 text-2xl font-semibold text-blue-600">5</p>
                            </div>
                            <div class="rounded-xl bg-blue-50 p-2.5">
                                <i class="fa-regular fa-spinner text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">Done</p>
                                <p class="mt-1.5 text-2xl font-semibold text-emerald-600">12</p>
                            </div>
                            <div class="rounded-xl bg-emerald-50 p-2.5">
                                <i class="fa-regular fa-check-circle text-emerald-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tasks Board -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <!-- To Do Column -->
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="h-2 w-2 rounded-full bg-[#1a1a1a]"></span>
                                <h2 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">To Do</h2>
                            </div>
                            <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium text-[#6a6a6a]">7</span>
                        </div>

                        <div class="mt-4 space-y-3 max-h-[600px] overflow-y-auto pr-1">
                            <!-- Task Card 1 -->
                            <div class="group task-card rounded-2xl border border-[#e2e4e8] bg-white p-4 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" class="task-checkbox h-4 w-4 rounded border-[#d1d3d8] text-[#1a1a1a] focus:ring-0 cursor-pointer">
                                            <div class="task-content">
                                                <p class="text-xs text-[#8a8a8a]">
                                                    <i class="fa-regular fa-calendar text-[10px] mr-1"></i>
                                                    Due <span class="text-red-600 font-semibold">2026-07-15</span>
                                                    <span class="ml-1 inline-flex items-center gap-1 text-red-600 text-[10px] font-semibold">
                                                        <i class="fa-regular fa-triangle-exclamation"></i> Overdue
                                                    </span>
                                                </p>
                                                <h3 class="mt-1 text-sm font-semibold text-[#1a1a1a] group-hover:text-[#1a1a1a]">Design task flow</h3>
                                                <p class="mt-1 text-xs text-[#6a6a6a] line-clamp-2">Update the task flow diagram and review with the team.</p>
                                                <div class="mt-2 flex flex-wrap gap-1.5">
                                                    <span class="inline-flex items-center gap-1 text-[10px] text-[#8a8a8a]">
                                                        <i class="fa-regular fa-folder-open text-[8px]"></i>
                                                        Project Alpha
                                                    </span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Design</span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">UI/UX</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end gap-2 flex-shrink-0">
                                        <span class="rounded-full border px-2.5 py-0.5 text-[9px] font-medium bg-red-50 text-red-600 border-red-200">
                                            <i class="fa-regular fa-arrow-up mr-1 text-[8px]"></i>
                                            High
                                        </span>
                                        <button class="rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-2.5 py-1 text-[10px] font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                            <i class="fa-regular fa-pen-to-square mr-1"></i> Edit
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-4 pt-3 border-t border-[#e2e4e8]">
                                    <div class="flex -space-x-2">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                        <div class="flex h-7 w-7 items-center justify-center rounded-full border-2 border-white bg-[#eceef0] text-[9px] font-medium text-[#6a6a6a]">+2</div>
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-[#8a8a8a]">
                                        <span class="flex items-center gap-1 hover:text-[#1a1a1a] transition-colors cursor-pointer">
                                            <i class="fa-regular fa-comment"></i> 3
                                        </span>
                                        <span class="flex items-center gap-1 hover:text-[#1a1a1a] transition-colors cursor-pointer">
                                            <i class="fa-regular fa-paperclip"></i> 2
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Task Card 2 -->
                            <div class="group task-card rounded-2xl border border-[#e2e4e8] bg-white p-4 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" class="task-checkbox h-4 w-4 rounded border-[#d1d3d8] text-[#1a1a1a] focus:ring-0 cursor-pointer">
                                            <div class="task-content">
                                                <p class="text-xs text-[#8a8a8a]">
                                                    <i class="fa-regular fa-calendar text-[10px] mr-1"></i>
                                                    Due <span>2026-07-21</span>
                                                </p>
                                                <h3 class="mt-1 text-sm font-semibold text-[#1a1a1a] group-hover:text-[#1a1a1a]">QA tasks list page</h3>
                                                <p class="mt-1 text-xs text-[#6a6a6a] line-clamp-2">Verify empty states, loading states, and sorting functionality.</p>
                                                <div class="mt-2 flex flex-wrap gap-1.5">
                                                    <span class="inline-flex items-center gap-1 text-[10px] text-[#8a8a8a]">
                                                        <i class="fa-regular fa-folder-open text-[8px]"></i>
                                                        Project Alpha
                                                    </span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Testing</span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">QA</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end gap-2 flex-shrink-0">
                                        <span class="rounded-full border px-2.5 py-0.5 text-[9px] font-medium bg-amber-50 text-amber-600 border-amber-200">
                                            <i class="fa-regular fa-minus mr-1 text-[8px]"></i>
                                            Medium
                                        </span>
                                        <button class="rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-2.5 py-1 text-[10px] font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                            <i class="fa-regular fa-pen-to-square mr-1"></i> Edit
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-4 pt-3 border-t border-[#e2e4e8]">
                                    <div class="flex -space-x-2">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-[#8a8a8a]">
                                        <span class="flex items-center gap-1 hover:text-[#1a1a1a] transition-colors cursor-pointer">
                                            <i class="fa-regular fa-comment"></i> 2
                                        </span>
                                        <span class="flex items-center gap-1 hover:text-[#1a1a1a] transition-colors cursor-pointer">
                                            <i class="fa-regular fa-paperclip"></i> 1
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Add Task Button -->
                            <button class="w-full rounded-xl border-2 border-dashed border-[#e2e4e8] bg-white py-3 text-xs font-medium text-[#6a6a6a] transition hover:border-[#1a1a1a] hover:text-[#1a1a1a] hover:bg-[#f2f3f5]">
                                <i class="fa-regular fa-plus mr-2"></i> Add task
                            </button>
                        </div>
                    </div>

                    <!-- In Progress Column -->
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                                <h2 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">In Progress</h2>
                            </div>
                            <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium text-[#6a6a6a]">5</span>
                        </div>

                        <div class="mt-4 space-y-3 max-h-[600px] overflow-y-auto pr-1">
                            <!-- Task Card 3 -->
                            <div class="group task-card rounded-2xl border border-[#e2e4e8] bg-white p-4 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" class="task-checkbox h-4 w-4 rounded border-[#d1d3d8] text-[#1a1a1a] focus:ring-0 cursor-pointer">
                                            <div class="task-content">
                                                <p class="text-xs text-[#8a8a8a]">
                                                    <i class="fa-regular fa-calendar text-[10px] mr-1"></i>
                                                    Due <span class="text-amber-600 font-semibold">2026-07-14</span>
                                                    <span class="ml-1 inline-flex items-center gap-1 text-amber-600 text-[10px] font-semibold">
                                                        <i class="fa-regular fa-clock"></i> Due Today
                                                    </span>
                                                </p>
                                                <h3 class="mt-1 text-sm font-semibold text-[#1a1a1a] group-hover:text-[#1a1a1a]">Fix dashboard UI alignment</h3>
                                                <p class="mt-1 text-xs text-[#6a6a6a] line-clamp-2">Adjust spacing and component hover states across the dashboard.</p>
                                                <div class="mt-2 flex flex-wrap gap-1.5">
                                                    <span class="inline-flex items-center gap-1 text-[10px] text-[#8a8a8a]">
                                                        <i class="fa-regular fa-folder-open text-[8px]"></i>
                                                        Project Alpha
                                                    </span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">UI</span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Bug Fix</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end gap-2 flex-shrink-0">
                                        <span class="rounded-full border px-2.5 py-0.5 text-[9px] font-medium bg-red-50 text-red-600 border-red-200">
                                            <i class="fa-regular fa-arrow-up mr-1 text-[8px]"></i>
                                            High
                                        </span>
                                        <button class="rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-2.5 py-1 text-[10px] font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                            <i class="fa-regular fa-pen-to-square mr-1"></i> Edit
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-4 pt-3 border-t border-[#e2e4e8]">
                                    <div class="flex -space-x-2">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-[#8a8a8a]">
                                        <span class="flex items-center gap-1 hover:text-[#1a1a1a] transition-colors cursor-pointer">
                                            <i class="fa-regular fa-comment"></i> 5
                                        </span>
                                        <span class="flex items-center gap-1 hover:text-[#1a1a1a] transition-colors cursor-pointer">
                                            <i class="fa-regular fa-paperclip"></i> 1
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Task Card 4 -->
                            <div class="group task-card rounded-2xl border border-[#e2e4e8] bg-white p-4 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" class="task-checkbox h-4 w-4 rounded border-[#d1d3d8] text-[#1a1a1a] focus:ring-0 cursor-pointer">
                                            <div class="task-content">
                                                <p class="text-xs text-[#8a8a8a]">
                                                    <i class="fa-regular fa-calendar text-[10px] mr-1"></i>
                                                    Due <span>2026-07-18</span>
                                                </p>
                                                <h3 class="mt-1 text-sm font-semibold text-[#1a1a1a] group-hover:text-[#1a1a1a]">Implement task filters</h3>
                                                <p class="mt-1 text-xs text-[#6a6a6a] line-clamp-2">Add filter and sorting logic to the UI with proper state management.</p>
                                                <div class="mt-2 flex flex-wrap gap-1.5">
                                                    <span class="inline-flex items-center gap-1 text-[10px] text-[#8a8a8a]">
                                                        <i class="fa-regular fa-folder-open text-[8px]"></i>
                                                        Project Beta
                                                    </span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Frontend</span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Development</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end gap-2 flex-shrink-0">
                                        <span class="rounded-full border px-2.5 py-0.5 text-[9px] font-medium bg-amber-50 text-amber-600 border-amber-200">
                                            <i class="fa-regular fa-minus mr-1 text-[8px]"></i>
                                            Medium
                                        </span>
                                        <button class="rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-2.5 py-1 text-[10px] font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                            <i class="fa-regular fa-pen-to-square mr-1"></i> Edit
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-4 pt-3 border-t border-[#e2e4e8]">
                                    <div class="flex -space-x-2">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-[#8a8a8a]">
                                        <span class="flex items-center gap-1 hover:text-[#1a1a1a] transition-colors cursor-pointer">
                                            <i class="fa-regular fa-comment"></i> 1
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Add Task Button -->
                            <button class="w-full rounded-xl border-2 border-dashed border-[#e2e4e8] bg-white py-3 text-xs font-medium text-[#6a6a6a] transition hover:border-[#1a1a1a] hover:text-[#1a1a1a] hover:bg-[#f2f3f5]">
                                <i class="fa-regular fa-plus mr-2"></i> Add task
                            </button>
                        </div>
                    </div>

                    <!-- Done Column -->
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                <h2 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">Done</h2>
                            </div>
                            <span class="rounded-full bg-[#eceef0] px-3 py-1 text-[9px] font-medium text-[#6a6a6a]">12</span>
                        </div>

                        <div class="mt-4 space-y-3 max-h-[600px] overflow-y-auto pr-1">
                            <!-- Task Card 5 -->
                            <div class="group task-card rounded-2xl border border-[#e2e4e8] bg-white p-4 shadow-[0_4px_20px_rgba(0,0,0,0.02)] opacity-60">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" class="task-checkbox h-4 w-4 rounded border-[#d1d3d8] text-[#1a1a1a] focus:ring-0 cursor-pointer" checked>
                                            <div class="task-content">
                                                <p class="text-xs text-[#8a8a8a]">
                                                    <i class="fa-regular fa-calendar text-[10px] mr-1"></i>
                                                    Completed <span>2026-07-01</span>
                                                </p>
                                                <h3 class="mt-1 text-sm font-semibold text-[#1a1a1a] line-through group-hover:text-[#1a1a1a]">Write report summary</h3>
                                                <p class="mt-1 text-xs text-[#6a6a6a] line-clamp-2">Draft weekly summary and share with admin for review.</p>
                                                <div class="mt-2 flex flex-wrap gap-1.5">
                                                    <span class="inline-flex items-center gap-1 text-[10px] text-[#8a8a8a]">
                                                        <i class="fa-regular fa-folder-open text-[8px]"></i>
                                                        Project Gamma
                                                    </span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Documentation</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end gap-2 flex-shrink-0">
                                        <span class="rounded-full border px-2.5 py-0.5 text-[9px] font-medium bg-blue-50 text-blue-600 border-blue-200">
                                            <i class="fa-regular fa-arrow-down mr-1 text-[8px]"></i>
                                            Low
                                        </span>
                                        <button class="rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-2.5 py-1 text-[10px] font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                            <i class="fa-regular fa-pen-to-square mr-1"></i> Edit
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-4 pt-3 border-t border-[#e2e4e8]">
                                    <div class="flex -space-x-2">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-[#8a8a8a]">
                                        <span class="flex items-center gap-1 text-emerald-600">
                                            <i class="fa-regular fa-check-circle"></i> Completed
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Task Card 6 -->
                            <div class="group task-card rounded-2xl border border-[#e2e4e8] bg-white p-4 shadow-[0_4px_20px_rgba(0,0,0,0.02)] opacity-60">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" class="task-checkbox h-4 w-4 rounded border-[#d1d3d8] text-[#1a1a1a] focus:ring-0 cursor-pointer" checked>
                                            <div class="task-content">
                                                <p class="text-xs text-[#8a8a8a]">
                                                    <i class="fa-regular fa-calendar text-[10px] mr-1"></i>
                                                    Completed <span>2026-06-28</span>
                                                </p>
                                                <h3 class="mt-1 text-sm font-semibold text-[#1a1a1a] line-through group-hover:text-[#1a1a1a]">Submit timesheet export</h3>
                                                <p class="mt-1 text-xs text-[#6a6a6a] line-clamp-2">Export timesheet data (CSV) for review and approval.</p>
                                                <div class="mt-2 flex flex-wrap gap-1.5">
                                                    <span class="inline-flex items-center gap-1 text-[10px] text-[#8a8a8a]">
                                                        <i class="fa-regular fa-folder-open text-[8px]"></i>
                                                        Project Beta
                                                    </span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Data</span>
                                                    <span class="rounded-full bg-[#eceef0] px-2 py-0.5 text-[8px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Export</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end gap-2 flex-shrink-0">
                                        <span class="rounded-full border px-2.5 py-0.5 text-[9px] font-medium bg-amber-50 text-amber-600 border-amber-200">
                                            <i class="fa-regular fa-minus mr-1 text-[8px]"></i>
                                            Medium
                                        </span>
                                        <button class="rounded-xl border border-[#e2e4e8] bg-[#f2f3f5] px-2.5 py-1 text-[10px] font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                            <i class="fa-regular fa-pen-to-square mr-1"></i> Edit
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-4 pt-3 border-t border-[#e2e4e8]">
                                    <div class="flex -space-x-2">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                        <img class="h-7 w-7 rounded-full border-2 border-white object-cover" src="assets/guest.svg" alt="Assignee">
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-[#8a8a8a]">
                                        <span class="flex items-center gap-1 text-emerald-600">
                                            <i class="fa-regular fa-check-circle"></i> Completed
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Add Task Button -->
                            <button class="w-full rounded-xl border-2 border-dashed border-[#e2e4e8] bg-white py-3 text-xs font-medium text-[#6a6a6a] transition hover:border-[#1a1a1a] hover:text-[#1a1a1a] hover:bg-[#f2f3f5]">
                                <i class="fa-regular fa-plus mr-2"></i> Add task
                            </button>
                        </div>
                    </div>
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
                                <p class="text-xs text-[#8a8a8a]">Completion rate</p>
                                <p class="text-sm font-semibold text-emerald-600">50%</p>
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

    <script>
        // Task checkbox functionality
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const taskCard = this.closest('.group');
                const title = taskCard.querySelector('h3');
                const content = this.closest('.flex').querySelector('.task-content');
                
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
                document.querySelectorAll('.rounded-lg.px-4.py-1\\.5').forEach(b => {
                    b.classList.remove('bg-[#1a1a1a]', 'text-[#f6f7f9]');
                    b.classList.add('text-[#6a6a6a]');
                });
                this.classList.add('bg-[#1a1a1a]', 'text-[#f6f7f9]');
                this.classList.remove('text-[#6a6a6a]');
            });
        });

        // Add task button in columns
        document.querySelectorAll('.border-2.border-dashed').forEach(btn => {
            btn.addEventListener('click', function() {
                alert('Open Create Task Modal');
            });
        });

        console.log('✅ My Tasks page loaded successfully!');
        console.log('📋 Total tasks: 24');
        console.log('📊 To Do: 7 | In Progress: 5 | Done: 12');
        console.log('⚠️ Overdue tasks: 2');
    </script>
</body>
</html>