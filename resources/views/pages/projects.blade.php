<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Timesheet</title>
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
        
        .project-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
        }
        
        .status-badge {
            transition: all 0.2s ease;
        }
        
        .progress-ring {
            transition: stroke-dashoffset 0.8s ease;
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
                        ['label' => 'Dashboard', 'icon' => 'fa-th-large', 'route' => 'dashboard', 'active' => false, 'badge' => null],
                        ['label' => 'Projects', 'icon' => 'fa-briefcase', 'route' => 'projects', 'active' => true, 'badge' => '12'],
                        ['label' => 'My Task', 'icon' => 'fa-tasks', 'route' => 'tasks', 'active' => false, 'badge' => '5'],
                        
                        ['label' => 'Calendar', 'icon' => 'fa-calendar-alt', 'route' => 'dashboard', 'active' => false, 'badge' => null],
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
                    <input type="text" placeholder="Search projects..." class="w-full rounded-full border border-[#e2e4e8] bg-[#f2f3f5] py-2.5 pl-10 pr-4 text-sm text-[#1a1a1a] transition focus:border-[#1a1a1a] focus:bg-[#f6f7f9]">
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

            <!-- Projects Content -->
            <div class="space-y-6">
                <!-- Page Header -->
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-semibold tracking-tight text-[#1a1a1a]">Projects</h1>
                        <p class="mt-1 text-sm text-[#8a8a8a]">Manage your projects and track progress</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <!-- Quick Stats Badges -->
                        <div class="flex items-center gap-2 rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-4 py-1.5">
                            <span class="flex items-center gap-1.5 text-xs text-[#6a6a6a]">
                                <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
                                Active: <span class="font-medium text-[#1a1a1a]">14</span>
                            </span>
                            <span class="w-px h-4 bg-[#e2e4e8]"></span>
                            <span class="flex items-center gap-1.5 text-xs text-[#6a6a6a]">
                                <span class="inline-block h-2 w-2 rounded-full bg-amber-500"></span>
                                On Hold: <span class="font-medium text-[#1a1a1a]">6</span>
                            </span>
                            <span class="w-px h-4 bg-[#e2e4e8]"></span>
                            <span class="flex items-center gap-1.5 text-xs text-[#6a6a6a]">
                                <span class="inline-block h-2 w-2 rounded-full bg-blue-500"></span>
                                Completed: <span class="font-medium text-[#1a1a1a]">4</span>
                            </span>
                        </div>
                        <button class="rounded-full border border-[#e2e4e8] bg-[#f6f7f9] px-5 py-2.5 text-sm font-medium text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a]">
                            <i class="fa-regular fa-sliders mr-2"></i> Filter
                        </button>
                        <button class="rounded-full bg-[#1a1a1a] px-5 py-2.5 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333] shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                            <i class="fa-regular fa-plus mr-2"></i> New Project
                        </button>
                    </div>
                </div>

                <!-- View Toggle & Sort -->
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-2 rounded-xl border border-[#e2e4e8] bg-[#f6f7f9] p-1">
                        <button class="rounded-lg bg-[#1a1a1a] px-4 py-1.5 text-xs font-medium text-[#f6f7f9]">
                            <i class="fa-regular fa-grid-2 mr-1.5"></i> Grid
                        </button>
                        <button class="rounded-lg px-4 py-1.5 text-xs font-medium text-[#6a6a6a] transition hover:text-[#1a1a1a]">
                            <i class="fa-regular fa-list mr-1.5"></i> List
                        </button>
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-xs text-[#8a8a8a]">Sort by:</label>
                        <select class="rounded-xl border border-[#e2e4e8] bg-[#f6f7f9] px-3 py-1.5 text-xs text-[#1a1a1a] focus:border-[#1a1a1a] focus:outline-none">
                            <option>Due Date</option>
                            <option>Progress</option>
                            <option>Priority</option>
                            <option>Name</option>
                        </select>
                    </div>
                </div>

                <!-- Stats Summary -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">Total Projects</p>
                                <p class="mt-1.5 text-2xl font-semibold text-[#1a1a1a]">24</p>
                            </div>
                            <div class="rounded-xl bg-[#eceef0] p-2.5">
                                <i class="fa-regular fa-folder text-[#1a1a1a]"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">Active</p>
                                <p class="mt-1.5 text-2xl font-semibold text-emerald-600">14</p>
                            </div>
                            <div class="rounded-xl bg-emerald-50 p-2.5">
                                <i class="fa-regular fa-play text-emerald-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">On Hold</p>
                                <p class="mt-1.5 text-2xl font-semibold text-amber-600">6</p>
                            </div>
                            <div class="rounded-xl bg-amber-50 p-2.5">
                                <i class="fa-regular fa-pause text-amber-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] card-hover">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-[#8a8a8a] font-medium uppercase tracking-[0.2em]">Completed</p>
                                <p class="mt-1.5 text-2xl font-semibold text-blue-600">4</p>
                            </div>
                            <div class="rounded-xl bg-blue-50 p-2.5">
                                <i class="fa-regular fa-check-circle text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projects Grid -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Project Card 1 -->
                    <div class="group project-card rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="inline-block h-2 w-2 rounded-full bg-red-500 animate-pulse-dot"></span>
                                    <span class="text-[9px] font-medium uppercase tracking-[0.2em] text-[#8a8a8a]">High Priority</span>
                                </div>
                                <h3 class="text-lg font-semibold text-[#1a1a1a] group-hover:text-[#1a1a1a]">Project Alpha</h3>
                                <p class="mt-1 text-sm text-[#6a6a6a]">Product design & development</p>
                            </div>
                            <button class="rounded-full border border-[#e2e4e8] bg-[#f2f3f5] p-1.5 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                <i class="fa-regular fa-ellipsis-vertical text-xs"></i>
                            </button>
                        </div>

                        <div class="mt-4">
                            <div class="mb-1.5 flex items-center justify-between text-xs text-[#6a6a6a]">
                                <span>Progress</span>
                                <span class="font-medium text-[#1a1a1a]">50%</span>
                            </div>
                            <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                <div class="h-1.5 w-1/2 rounded-full bg-gradient-to-r from-red-500 to-red-400 transition-all duration-1000"></div>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 border-t border-[#e2e4e8] pt-4">
                            <div class="flex -space-x-2">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <div class="flex h-7 w-7 items-center justify-center rounded-full border-2 border-[#f6f7f9] bg-[#eceef0] text-[9px] font-medium text-[#6a6a6a]">+3</div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar text-[10px] text-[#8a8a8a]"></i>
                                    <span class="text-xs text-[#6a6a6a]">Jun 20</span>
                                </div>
                                <span class="rounded-full bg-red-50 px-2 py-0.5 text-[10px] font-medium text-red-600 border border-red-200">Urgent</span>
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Design</span>
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Development</span>
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">UI/UX</span>
                        </div>
                    </div>

                    <!-- Project Card 2 -->
                    <div class="group project-card rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="inline-block h-2 w-2 rounded-full bg-amber-500"></span>
                                    <span class="text-[9px] font-medium uppercase tracking-[0.2em] text-[#8a8a8a]">Medium Priority</span>
                                </div>
                                <h3 class="text-lg font-semibold text-[#1a1a1a] group-hover:text-[#1a1a1a]">Project Beta</h3>
                                <p class="mt-1 text-sm text-[#6a6a6a]">Mobile app development</p>
                            </div>
                            <button class="rounded-full border border-[#e2e4e8] bg-[#f2f3f5] p-1.5 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                <i class="fa-regular fa-ellipsis-vertical text-xs"></i>
                            </button>
                        </div>

                        <div class="mt-4">
                            <div class="mb-1.5 flex items-center justify-between text-xs text-[#6a6a6a]">
                                <span>Progress</span>
                                <span class="font-medium text-[#1a1a1a]">75%</span>
                            </div>
                            <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                <div class="h-1.5 w-3/4 rounded-full bg-gradient-to-r from-amber-500 to-amber-400 transition-all duration-1000"></div>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 border-t border-[#e2e4e8] pt-4">
                            <div class="flex -space-x-2">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <div class="flex h-7 w-7 items-center justify-center rounded-full border-2 border-[#f6f7f9] bg-[#eceef0] text-[9px] font-medium text-[#6a6a6a]">+2</div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar text-[10px] text-[#8a8a8a]"></i>
                                    <span class="text-xs text-[#6a6a6a]">Jul 5</span>
                                </div>
                                <span class="rounded-full bg-amber-50 px-2 py-0.5 text-[10px] font-medium text-amber-600 border border-amber-200">On Track</span>
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">iOS</span>
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Android</span>
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Flutter</span>
                        </div>
                    </div>

                    <!-- Project Card 3 -->
                    <div class="group project-card rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-[9px] font-medium uppercase tracking-[0.2em] text-[#8a8a8a]">Low Priority</span>
                                </div>
                                <h3 class="text-lg font-semibold text-[#1a1a1a] group-hover:text-[#1a1a1a]">Project Gamma</h3>
                                <p class="mt-1 text-sm text-[#6a6a6a]">Documentation & training</p>
                            </div>
                            <button class="rounded-full border border-[#e2e4e8] bg-[#f2f3f5] p-1.5 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                <i class="fa-regular fa-ellipsis-vertical text-xs"></i>
                            </button>
                        </div>

                        <div class="mt-4">
                            <div class="mb-1.5 flex items-center justify-between text-xs text-[#6a6a6a]">
                                <span>Progress</span>
                                <span class="font-medium text-[#1a1a1a]">30%</span>
                            </div>
                            <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                <div class="h-1.5 w-[30%] rounded-full bg-gradient-to-r from-emerald-500 to-emerald-400 transition-all duration-1000"></div>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 border-t border-[#e2e4e8] pt-4">
                            <div class="flex -space-x-2">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar text-[10px] text-[#8a8a8a]"></i>
                                    <span class="text-xs text-[#6a6a6a]">Aug 15</span>
                                </div>
                                <span class="rounded-full bg-blue-50 px-2 py-0.5 text-[10px] font-medium text-blue-600 border border-blue-200">Planning</span>
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Documentation</span>
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Training</span>
                        </div>
                    </div>

                    <!-- Project Card 4 -->
                    <div class="group project-card rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="inline-block h-2 w-2 rounded-full bg-purple-500"></span>
                                    <span class="text-[9px] font-medium uppercase tracking-[0.2em] text-[#8a8a8a]">Medium Priority</span>
                                </div>
                                <h3 class="text-lg font-semibold text-[#1a1a1a] group-hover:text-[#1a1a1a]">Project Delta</h3>
                                <p class="mt-1 text-sm text-[#6a6a6a]">Marketing website redesign</p>
                            </div>
                            <button class="rounded-full border border-[#e2e4e8] bg-[#f2f3f5] p-1.5 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                <i class="fa-regular fa-ellipsis-vertical text-xs"></i>
                            </button>
                        </div>

                        <div class="mt-4">
                            <div class="mb-1.5 flex items-center justify-between text-xs text-[#6a6a6a]">
                                <span>Progress</span>
                                <span class="font-medium text-[#1a1a1a]">60%</span>
                            </div>
                            <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                <div class="h-1.5 w-3/5 rounded-full bg-gradient-to-r from-purple-500 to-purple-400 transition-all duration-1000"></div>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 border-t border-[#e2e4e8] pt-4">
                            <div class="flex -space-x-2">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <div class="flex h-7 w-7 items-center justify-center rounded-full border-2 border-[#f6f7f9] bg-[#eceef0] text-[9px] font-medium text-[#6a6a6a]">+4</div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar text-[10px] text-[#8a8a8a]"></i>
                                    <span class="text-xs text-[#6a6a6a]">Jul 28</span>
                                </div>
                                <span class="rounded-full bg-purple-50 px-2 py-0.5 text-[10px] font-medium text-purple-600 border border-purple-200">In Progress</span>
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Marketing</span>
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Web Design</span>
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">SEO</span>
                        </div>
                    </div>

                    <!-- Add New Project Card -->
                    <div class="group project-card rounded-2xl border-2 border-dashed border-[#e2e4e8] bg-[#f6f7f9] p-6 transition-all duration-300 hover:border-[#1a1a1a] hover:bg-[#eceef0] cursor-pointer flex items-center justify-center min-h-[220px]">
                        <div class="text-center">
                            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-[#eceef0] group-hover:bg-[#e2e4e8] transition-colors">
                                <i class="fa-regular fa-plus text-xl text-[#6a6a6a] group-hover:text-[#1a1a1a]"></i>
                            </div>
                            <h3 class="text-sm font-medium text-[#6a6a6a] group-hover:text-[#1a1a1a]">Create New Project</h3>
                            <p class="mt-1 text-xs text-[#8a8a8a]">Start a new project</p>
                        </div>
                    </div>

                    <!-- Project Card 5 -->
                    <div class="group project-card rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="inline-block h-2 w-2 rounded-full bg-blue-500"></span>
                                    <span class="text-[9px] font-medium uppercase tracking-[0.2em] text-[#8a8a8a]">Low Priority</span>
                                </div>
                                <h3 class="text-lg font-semibold text-[#1a1a1a] group-hover:text-[#1a1a1a]">Project Epsilon</h3>
                                <p class="mt-1 text-sm text-[#6a6a6a]">Data migration & analytics</p>
                            </div>
                            <button class="rounded-full border border-[#e2e4e8] bg-[#f2f3f5] p-1.5 text-[#6a6a6a] transition hover:bg-[#eceef0] hover:text-[#1a1a1a] opacity-0 group-hover:opacity-100">
                                <i class="fa-regular fa-ellipsis-vertical text-xs"></i>
                            </button>
                        </div>

                        <div class="mt-4">
                            <div class="mb-1.5 flex items-center justify-between text-xs text-[#6a6a6a]">
                                <span>Progress</span>
                                <span class="font-medium text-[#1a1a1a]">15%</span>
                            </div>
                            <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                                <div class="h-1.5 w-[15%] rounded-full bg-gradient-to-r from-blue-500 to-blue-400 transition-all duration-1000"></div>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2 border-t border-[#e2e4e8] pt-4">
                            <div class="flex -space-x-2">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <img class="h-7 w-7 rounded-full border-2 border-[#f6f7f9] object-cover" src="assets/guest.svg" alt="Team member">
                                <div class="flex h-7 w-7 items-center justify-center rounded-full border-2 border-[#f6f7f9] bg-[#eceef0] text-[9px] font-medium text-[#6a6a6a]">+1</div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-regular fa-calendar text-[10px] text-[#8a8a8a]"></i>
                                    <span class="text-xs text-[#6a6a6a]">Sep 10</span>
                                </div>
                                <span class="rounded-full bg-blue-50 px-2 py-0.5 text-[10px] font-medium text-blue-600 border border-blue-200">Planning</span>
                            </div>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-1.5">
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Data</span>
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Analytics</span>
                            <span class="rounded-full bg-[#eceef0] px-2.5 py-0.5 text-[9px] font-medium text-[#6a6a6a] border border-[#e2e4e8]">Migration</span>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Recent Activity -->
                <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-base font-semibold tracking-tight text-[#1a1a1a]">Recent Activity</h3>
                            <p class="text-xs text-[#8a8a8a]">Latest updates from your projects</p>
                        </div>
                        <button class="text-xs font-medium text-[#1a1a1a] transition hover:text-[#6a6a6a] flex items-center gap-1">
                            View all <i class="fa-regular fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>
                    <div class="relative">
                        <!-- Timeline line -->
                        <div class="absolute left-5 top-0 h-full w-0.5 bg-[#e2e4e8]"></div>
                        
                        <div class="space-y-4">
                            <div class="relative flex items-start gap-4 pl-12">
                                <div class="absolute left-3 top-1 flex h-4 w-4 items-center justify-center rounded-full bg-emerald-100 border-2 border-white">
                                    <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                                </div>
                                <div class="flex-1 rounded-xl border border-[#e2e4e8] bg-white p-3 transition hover:border-[#d1d3d8]">
                                    <div class="flex flex-wrap items-start justify-between gap-2">
                                        <div>
                                            <p class="text-sm font-medium text-[#1a1a1a]">Task status updated</p>
                                            <p class="text-xs text-[#8a8a8a]">Project Alpha • "Design review" marked as complete</p>
                                        </div>
                                        <span class="text-[10px] text-[#8a8a8a] whitespace-nowrap">Just now</span>
                                    </div>
                                    <div class="mt-2 flex items-center gap-2">
                                        <img class="h-5 w-5 rounded-full border border-[#e2e4e8]" src="assets/guest.svg" alt="User">
                                        <span class="text-[10px] text-[#6a6a6a]">Sarah Chen</span>
                                    </div>
                                </div>
                            </div>

                            <div class="relative flex items-start gap-4 pl-12">
                                <div class="absolute left-3 top-1 flex h-4 w-4 items-center justify-center rounded-full bg-blue-100 border-2 border-white">
                                    <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                                </div>
                                <div class="flex-1 rounded-xl border border-[#e2e4e8] bg-white p-3 transition hover:border-[#d1d3d8]">
                                    <div class="flex flex-wrap items-start justify-between gap-2">
                                        <div>
                                            <p class="text-sm font-medium text-[#1a1a1a]">New milestone created</p>
                                            <p class="text-xs text-[#8a8a8a]">Project Beta • "Beta release v1.0" milestone added</p>
                                        </div>
                                        <span class="text-[10px] text-[#8a8a8a] whitespace-nowrap">30m ago</span>
                                    </div>
                                    <div class="mt-2 flex items-center gap-2">
                                        <img class="h-5 w-5 rounded-full border border-[#e2e4e8]" src="assets/guest.svg" alt="User">
                                        <span class="text-[10px] text-[#6a6a6a]">Mike Johnson</span>
                                    </div>
                                </div>
                            </div>

                            <div class="relative flex items-start gap-4 pl-12">
                                <div class="absolute left-3 top-1 flex h-4 w-4 items-center justify-center rounded-full bg-purple-100 border-2 border-white">
                                    <div class="h-2 w-2 rounded-full bg-purple-500"></div>
                                </div>
                                <div class="flex-1 rounded-xl border border-[#e2e4e8] bg-white p-3 transition hover:border-[#d1d3d8]">
                                    <div class="flex flex-wrap items-start justify-between gap-2">
                                        <div>
                                            <p class="text-sm font-medium text-[#1a1a1a]">Comment added</p>
                                            <p class="text-xs text-[#8a8a8a]">Project Gamma • "Documentation needs review"</p>
                                        </div>
                                        <span class="text-[10px] text-[#8a8a8a] whitespace-nowrap">2h ago</span>
                                    </div>
                                    <div class="mt-2 flex items-center gap-2">
                                        <img class="h-5 w-5 rounded-full border border-[#e2e4e8]" src="assets/guest.svg" alt="User">
                                        <span class="text-[10px] text-[#6a6a6a]">Emily Davis</span>
                                    </div>
                                </div>
                            </div>

                            <div class="relative flex items-start gap-4 pl-12">
                                <div class="absolute left-3 top-1 flex h-4 w-4 items-center justify-center rounded-full bg-amber-100 border-2 border-white">
                                    <div class="h-2 w-2 rounded-full bg-amber-500"></div>
                                </div>
                                <div class="flex-1 rounded-xl border border-[#e2e4e8] bg-white p-3 transition hover:border-[#d1d3d8]">
                                    <div class="flex flex-wrap items-start justify-between gap-2">
                                        <div>
                                            <p class="text-sm font-medium text-[#1a1a1a]">Team member added</p>
                                            <p class="text-xs text-[#8a8a8a]">Project Alpha • Sarah joined the team</p>
                                        </div>
                                        <span class="text-[10px] text-[#8a8a8a] whitespace-nowrap">4h ago</span>
                                    </div>
                                    <div class="mt-2 flex items-center gap-2">
                                        <img class="h-5 w-5 rounded-full border border-[#e2e4e8]" src="assets/guest.svg" alt="User">
                                        <span class="text-[10px] text-[#6a6a6a]">Alex Rivera</span>
                                    </div>
                                </div>
                            </div>

                            <div class="relative flex items-start gap-4 pl-12">
                                <div class="absolute left-3 top-1 flex h-4 w-4 items-center justify-center rounded-full bg-pink-100 border-2 border-white">
                                    <div class="h-2 w-2 rounded-full bg-pink-500"></div>
                                </div>
                                <div class="flex-1 rounded-xl border border-[#e2e4e8] bg-white p-3 transition hover:border-[#d1d3d8]">
                                    <div class="flex flex-wrap items-start justify-between gap-2">
                                        <div>
                                            <p class="text-sm font-medium text-[#1a1a1a]">File uploaded</p>
                                            <p class="text-xs text-[#8a8a8a]">Project Delta • "Wireframes_v2.fig" uploaded</p>
                                        </div>
                                        <span class="text-[10px] text-[#8a8a8a] whitespace-nowrap">6h ago</span>
                                    </div>
                                    <div class="mt-2 flex items-center gap-2">
                                        <img class="h-5 w-5 rounded-full border border-[#e2e4e8]" src="assets/guest.svg" alt="User">
                                        <span class="text-[10px] text-[#6a6a6a]">Lisa Park</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>