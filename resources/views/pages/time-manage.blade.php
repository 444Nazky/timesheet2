@extends('layouts.app')

@section('content')
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
    @keyframes progress-fill {
        from { width: 0%; }
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
    
    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
    }
    
    .timer-display {
        font-variant-numeric: tabular-nums;
        letter-spacing: -0.02em;
    }
    
    .session-card {
        transition: all 0.2s ease;
    }
    .session-card:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }
    
    .progress-bar-animated {
        animation: progress-fill 1s ease-out forwards;
    }
    
    .tool-btn {
        transition: all 0.2s ease;
    }
    .tool-btn:hover {
        background: #eceef0;
        transform: translateY(-1px);
    }
</style>

<div class="w-full">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-[#1a1a1a]">Time Manage</h1>
            <p class="mt-2 text-sm text-[#6a6a6a]">Plan, track, and manage your time effectively</p>
        </div>
        <div class="flex items-center gap-3 flex-shrink-0">
            <button class="tool-btn rounded-lg border border-[#e2e4e8] bg-[#f6f7f9] px-4 py-2 text-sm font-medium text-[#6a6a6a]">
                <i class="fa-solid fa-download mr-2"></i> Export Report
            </button>
            <button id="startTimerBtn" class="rounded-lg bg-[#1a1a1a] px-5 py-2 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333] shadow-sm">
                <i class="fa-regular fa-clock mr-2"></i> Start Timer
            </button>
        </div>
    </div>

    <!-- Top Stats Row - 4 Column Responsive Grid -->
    <div class="grid w-full grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-sm stat-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Today's Focus</span>
                <span class="w-8 h-8 rounded-full bg-[#f2f3f5] flex items-center justify-center">
                    <i class="fas fa-bullseye text-xs text-[#1a1a1a]"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-[#1a1a1a] timer-display">04:32:15</p>
            <p class="mt-1 text-xs text-[#6a6a6a]">2 focus sessions completed</p>
        </div>

        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-sm stat-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Weekly Progress</span>
                <span class="w-8 h-8 rounded-full bg-[#ede7f6] flex items-center justify-center">
                    <i class="fas fa-chart-line text-xs text-[#7c4dff]"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-[#1a1a1a]">75%</p>
            <div class="mt-2 h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                <div class="h-1.5 rounded-full bg-[#1a1a1a] progress-bar-animated" style="width: 75%"></div>
            </div>
            <p class="mt-1 text-xs text-[#6a6a6a]">12 / 16 hours completed</p>
        </div>

        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-sm stat-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Tasks Tracked</span>
                <span class="w-8 h-8 rounded-full bg-[#e3f2fd] flex items-center justify-center">
                    <i class="fas fa-tasks text-xs text-[#2979ff]"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-[#1a1a1a]">24</p>
            <p class="mt-1 text-xs text-[#6a6a6a]">8 completed this week</p>
        </div>

        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-sm stat-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Efficiency</span>
                <span class="w-8 h-8 rounded-full bg-[#e8f5e9] flex items-center justify-center">
                    <i class="fas fa-bolt text-xs text-[#00c853]"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-[#1a1a1a]">92%</p>
            <p class="mt-1 text-xs text-[#6a6a6a]">+5% from last week</p>
        </div>
    </div>

    <!-- Two-Column Main Layout -->
    <div class="grid w-full grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Left Column - Main Content (2 cols) -->
        <div class="lg:col-span-2 space-y-6 w-full">
        <!-- Active Timer Card -->
        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] stat-card">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">Current Session</h3>
                    <p class="text-xs text-[#8a8a8a] mt-0.5">Frontend Development</p>
                </div>
                <span class="text-xs font-semibold text-[#1a1a1a] bg-[#f2f3f5] px-3 py-1 rounded-full">Project: Dashboard UI</span>
            </div>
            
            <div class="flex items-center justify-center mb-6">
                <div class="text-center">
                    <p class="text-6xl font-bold text-[#1a1a1a] timer-display tracking-tight">02:45:30</p>
                    <p class="text-xs text-[#8a8a8a] mt-2">Elapsed Time</p>
                </div>
            </div>

            <div class="flex items-center justify-center gap-3">
                <button class="rounded-full bg-[#1a1a1a] px-6 py-3 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333] shadow-[0_4px_12px_rgba(0,0,0,0.1)]">
                    <i class="fa-solid fa-pause mr-2"></i> Pause
                </button>
                <button class="rounded-full border border-red-500 px-6 py-3 text-sm font-medium text-red-500 transition hover:bg-red-50">
                    <i class="fa-solid fa-stop mr-2"></i> Stop
                </button>
            </div>
        </div>

        <!-- Time Entries List -->
        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">Recent Time Entries</h3>
                    <p class="text-xs text-[#8a8a8a] mt-0.5">Today's tracked sessions</p>
                </div>
                <button class="text-xs font-medium text-[#1a1a1a] hover:underline">View All</button>
            </div>

            <div class="space-y-2">
                <div class="session-card flex flex-wrap items-center justify-between gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#ede7f6] flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-code text-sm text-[#7c4dff]"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-[#1a1a1a] truncate">Frontend Development</p>
                            <p class="text-xs text-[#8a8a8a]">Dashboard UI • 09:00 - 11:30</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <span class="text-sm font-semibold text-[#1a1a1a]">2h 30m</span>
                        <span class="text-xs font-medium text-[#00c853] bg-[#e8f5e9] px-2 py-1 rounded-full">Completed</span>
                    </div>
                </div>

                <div class="session-card flex flex-wrap items-center justify-between gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#e3f2fd] flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-users text-sm text-[#2979ff]"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-[#1a1a1a] truncate">Team Standup</p>
                            <p class="text-xs text-[#8a8a8a]">Daily Meeting • 08:30 - 09:00</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <span class="text-sm font-semibold text-[#1a1a1a]">30m</span>
                        <span class="text-xs font-medium text-[#00c853] bg-[#e8f5e9] px-2 py-1 rounded-full">Completed</span>
                    </div>
                </div>

                <div class="session-card flex flex-wrap items-center justify-between gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#fff3e0] flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-pen text-sm text-[#ff9100]"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-[#1a1a1a] truncate">Design Review</p>
                            <p class="text-xs text-[#8a8a8a]">UI Updates • 11:30 - 12:00</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <span class="text-sm font-semibold text-[#1a1a1a]">30m</span>
                        <span class="text-xs font-medium text-[#1a1a1a] bg-[#f2f3f5] px-2 py-1 rounded-full">In Progress</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - Analytics & Tools -->
    <div class="w-full space-y-6">
        <!-- Time Distribution -->
        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] stat-card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">Time Distribution</h3>
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a]">This Week</span>
            </div>
            
            <div class="space-y-3">
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#7c4dff]"></span>
                            <span class="text-xs text-[#6a6a6a]">Development</span>
                        </div>
                        <span class="text-xs font-semibold text-[#1a1a1a]">8h</span>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                        <div class="h-1.5 rounded-full bg-[#7c4dff]" style="width: 50%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#2979ff]"></span>
                            <span class="text-xs text-[#6a6a6a]">Meetings</span>
                        </div>
                        <span class="text-xs font-semibold text-[#1a1a1a]">4h</span>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                        <div class="h-1.5 rounded-full bg-[#2979ff]" style="width: 25%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#ff9100]"></span>
                            <span class="text-xs text-[#6a6a6a]">Design</span>
                        </div>
                        <span class="text-xs font-semibold text-[#1a1a1a]">3h</span>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                        <div class="h-1.5 rounded-full bg-[#ff9100]" style="width: 19%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#00c853]"></span>
                            <span class="text-xs text-[#6a6a6a]">Learning</span>
                        </div>
                        <span class="text-xs font-semibold text-[#1a1a1a]">1h</span>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                        <div class="h-1.5 rounded-full bg-[#00c853]" style="width: 6%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-[#e2e4e8]">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-[#8a8a8a]">Total Tracked</span>
                    <span class="text-sm font-bold text-[#1a1a1a]">16 hours</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] stat-card">
            <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a] mb-4">Quick Actions</h3>
            <div class="space-y-2">
                <button class="w-full flex items-center gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white text-sm font-medium text-[#1a1a1a] transition hover:bg-[#f8f9fb]">
                    <i class="fa-regular fa-plus-circle"></i>
                    Manual Time Entry
                </button>
                <button class="w-full flex items-center gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white text-sm font-medium text-[#1a1a1a] transition hover:bg-[#f8f9fb]">
                    <i class="fa-regular fa-folder-open"></i>
                    Assign to Project
                </button>
                <button class="w-full flex items-center gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white text-sm font-medium text-[#1a1a1a] transition hover:bg-[#f8f9fb]">
                    <i class="fa-regular fa-note-sticky"></i>
                    Add Note
                </button>
                <button class="w-full flex items-center gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white text-sm font-medium text-[#1a1a1a] transition hover:bg-[#f8f9fb]">
                    <i class="fa-solid fa-chart-simple"></i>
                    View Reports
                </button>
            </div>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.02)] stat-card">
            <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a] mb-4">Upcoming Deadlines</h3>
            <div class="space-y-2">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-[#f2f3f5]">
                    <div class="w-8 h-8 rounded-full bg-[#ede7f6] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-flag text-xs text-[#7c4dff]"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-[#1a1a1a] truncate">Q3 Project Review</p>
                        <p class="text-[10px] text-[#8a8a8a]">Tomorrow at 2:00 PM</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-[#f2f3f5]">
                    <div class="w-8 h-8 rounded-full bg-[#e3f2fd] flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-file text-xs text-[#2979ff]"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-[#1a1a1a] truncate">Submit Timesheet</p>
                        <p class="text-[10px] text-[#8a8a8a]">Friday at 5:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    class TimerManager {
        constructor() {
            this.isRunning = true;
            this.seconds = 9930;
            this.timerInterval = null;
            this.init();
        }
        
        init() {
            this.startTimer();
            this.setupEventListeners();
        }
        
        startTimer() {
            this.timerInterval = setInterval(() => {
                this.seconds++;
                this.updateDisplay();
            }, 1000);
        }
        
        pauseTimer() {
            clearInterval(this.timerInterval);
            this.isRunning = false;
        }
        
        stopTimer() {
            clearInterval(this.timerInterval);
            this.isRunning = false;
            this.seconds = 0;
            this.updateDisplay();
        }
        
        updateDisplay() {
            const hours = Math.floor(this.seconds / 3600);
            const minutes = Math.floor((this.seconds % 3600) / 60);
            const secs = this.seconds % 60;
            const display = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
            
            document.querySelectorAll('.timer-display').forEach(el => {
                if (el.closest('.stat-card')?.querySelector('.text-6xl')) {
                    el.textContent = display;
                }
            });
        }
        
        setupEventListeners() {
            document.querySelectorAll('button').forEach(btn => {
                if (btn.textContent.includes('Pause')) {
                    btn.addEventListener('click', () => this.pauseTimer());
                }
                if (btn.textContent.includes('Stop')) {
                    btn.addEventListener('click', () => this.stopTimer());
                }
                if (btn.textContent.includes('Start Timer')) {
                    btn.addEventListener('click', () => {
                        if (!this.isRunning) {
                            this.startTimer();
                            this.isRunning = true;
                        }
                    });
                }
            });
        }
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        new TimerManager();
    });
</script>
@endsection