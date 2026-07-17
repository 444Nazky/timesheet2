@extends('layouts.app')

@section('content')
<div class="w-full">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold tracking-tight text-[#1a1a1a]">Time Management</h1>
            <p class="mt-2 text-sm text-[#6a6a6a]">Plan your sessions, track progress, and review your week</p>
        </div>

        <div class="flex items-center gap-3 flex-shrink-0">
            <a href="{{ route('reports') }}" class="tool-btn rounded-lg border border-[#e2e4e8] bg-[#f6f7f9] px-4 py-2 text-sm font-medium text-[#6a6a6a] transition hover:bg-[#eceef0]">
                <i class="fa-solid fa-file-export mr-2"></i> View Reports
            </a>
            <button id="startTimerBtn" class="rounded-lg bg-[#1a1a1a] px-5 py-2 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333] shadow-sm">
                <i class="fa-regular fa-clock mr-2"></i> Start Focus
            </button>
        </div>
    </div>

    <div class="grid w-full grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-sm stat-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Today Focus</span>
                <span class="w-8 h-8 rounded-full bg-[#f2f3f5] flex items-center justify-center">
                    <i class="fas fa-bullseye text-xs text-[#1a1a1a]"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-[#1a1a1a] timer-display">00:00:00</p>
            <p class="mt-1 text-xs text-[#6a6a6a]">Live session timer</p>
        </div>

        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-sm stat-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Weekly Progress</span>
                <span class="w-8 h-8 rounded-full bg-[#ede7f6] flex items-center justify-center">
                    <i class="fas fa-chart-line text-xs text-[#7c4dff]"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-[#1a1a1a]">0%</p>
            <div class="mt-2 h-1.5 w-full rounded-full bg-[#e2e4e8] overflow-hidden">
                <div id="weeklyProgressFill" class="h-1.5 rounded-full bg-[#1a1a1a] progress-bar-animated" style="width: 0%"></div>
            </div>
            <p class="mt-1 text-xs text-[#6a6a6a]">Complete sessions to increase</p>
        </div>

        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-sm stat-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Time Logged</span>
                <span class="w-8 h-8 rounded-full bg-[#e3f2fd] flex items-center justify-center">
                    <i class="fas fa-hourglass-half text-xs text-[#2979ff]"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-[#1a1a1a]">00h</p>
            <p class="mt-1 text-xs text-[#6a6a6a]">From completed sessions</p>
        </div>

        <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5 shadow-sm stat-card">
            <div class="flex items-center justify-between mb-3">
                <span class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Efficiency</span>
                <span class="w-8 h-8 rounded-full bg-[#e8f5e9] flex items-center justify-center">
                    <i class="fas fa-bolt text-xs text-[#00c853]"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-[#1a1a1a]">0%</p>
            <p class="mt-1 text-xs text-[#6a6a6a]">Based on focused time</p>
        </div>
    </div>

    <div class="grid w-full grid-cols-1 gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)]">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">Active Session</h3>
                        <p class="text-xs text-[#8a8a8a] mt-0.5">Focus subject: <span class="font-medium text-[#1a1a1a]">(demo)</span></p>
                    </div>
                    <span class="text-xs font-semibold text-[#1a1a1a] bg-[#f2f3f5] px-3 py-1 rounded-full">Project: Timesheet</span>
                </div>

                <div class="flex items-center justify-center mb-6">
                    <div class="text-center">
                        <p id="sessionTimer" class="text-6xl font-bold text-[#1a1a1a] timer-display tracking-tight">00:00:00</p>
                        <p class="text-xs text-[#8a8a8a] mt-2">Elapsed Time</p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3">
                    <button id="pauseTimerBtn" class="rounded-full border border-[#e2e4e8] px-6 py-3 text-sm font-medium text-[#6a6a6a] transition hover:bg-[#eceef0]">
                        <i class="fa-solid fa-pause mr-2"></i> Pause
                    </button>
                    <button id="stopTimerBtn" class="rounded-full border border-red-500 px-6 py-3 text-sm font-medium text-red-500 transition hover:bg-red-50">
                        <i class="fa-solid fa-stop mr-2"></i> Stop
                    </button>
                    <button id="completeTimerBtn" class="rounded-full bg-[#1a1a1a] px-6 py-3 text-sm font-medium text-[#f6f7f9] transition hover:bg-[#333333]">
                        <i class="fa-regular fa-circle-check mr-2"></i> Complete
                    </button>
                </div>

                <div class="mt-6">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="rounded-xl border border-[#e2e4e8] bg-white p-4">
                            <p class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Recommended break</p>
                            <p class="mt-2 text-sm font-semibold text-[#1a1a1a]">5 minutes</p>
                        </div>
                        <div class="rounded-xl border border-[#e2e4e8] bg-white p-4">
                            <p class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Focus mode</p>
                            <p class="mt-2 text-sm font-semibold text-[#1a1a1a]">Deep work</p>
                        </div>
                        <div class="rounded-xl border border-[#e2e4e8] bg-white p-4">
                            <p class="text-[9px] uppercase tracking-[0.2em] text-[#8a8a8a] font-medium">Session goal</p>
                            <p class="mt-2 text-sm font-semibold text-[#1a1a1a]">30 minutes</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">Completed Sessions</h3>
                        <p class="text-xs text-[#8a8a8a] mt-0.5">Your latest tracked focus blocks</p>
                    </div>
                    <a href="{{ route('time-manage') }}" class="text-xs font-medium text-[#1a1a1a] hover:underline">Back to Time Manage</a>
                </div>

                <div id="completedSessions" class="space-y-2">
                    <div class="text-center py-10 text-[#6a6a6a] text-xs">
                        No completed sessions yet.
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full space-y-6">
            <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5">
                <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">Quick Actions</h3>
                <div class="space-y-2 mt-4">
                    <button id="addManualEntryBtn" class="w-full flex items-center justify-center gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white text-sm font-medium text-[#1a1a1a] transition hover:bg-[#f8f9fb]">
                        <i class="fa-regular fa-plus-circle"></i>
                        Manual Time Entry (demo)
                    </button>
                    <button id="assignToProjectBtn" class="w-full flex items-center justify-center gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white text-sm font-medium text-[#1a1a1a] transition hover:bg-[#f8f9fb]">
                        <i class="fa-regular fa-folder-open"></i>
                        Assign to Project (demo)
                    </button>
                    <button class="w-full flex items-center justify-center gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white text-sm font-medium text-[#1a1a1a] transition hover:bg-[#f8f9fb]" onclick="alert('Add note (demo)')">
                        <i class="fa-regular fa-note-sticky"></i>
                        Add Note
                    </button>
                    <button class="w-full flex items-center justify-center gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white text-sm font-medium text-[#1a1a1a] transition hover:bg-[#f8f9fb]" onclick="window.location='{{ route('calendar') }}'">
                        <i class="fa-regular fa-calendar"></i>
                        Open Calendar
                    </button>
                </div>
            </div>

            <div class="rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] p-5">
                <h3 class="text-sm font-semibold tracking-tight text-[#1a1a1a]">This Week Snapshot</h3>
                <div class="mt-4 space-y-3">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-white border border-[#e2e4e8]">
                        <span class="text-xs text-[#6a6a6a]">Goal completion</span>
                        <span id="weeklyGoalCompletion" class="text-sm font-semibold text-[#1a1a1a]">0/0</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-xl bg-white border border-[#e2e4e8]">
                        <span class="text-xs text-[#6a6a6a]">Sessions done</span>
                        <span id="sessionsDone" class="text-sm font-semibold text-[#1a1a1a]">0</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-xl bg-white border border-[#e2e4e8]">
                        <span class="text-xs text-[#6a6a6a]">Total focused</span>
                        <span id="totalFocused" class="text-sm font-semibold text-[#1a1a1a]">00:00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const timerEl = document.getElementById('sessionTimer');
        const pauseBtn = document.getElementById('pauseTimerBtn');
        const stopBtn = document.getElementById('stopTimerBtn');
        const completeBtn = document.getElementById('completeTimerBtn');
        const completedSessionsEl = document.getElementById('completedSessions');

        const weeklyProgressFill = document.getElementById('weeklyProgressFill');
        const weeklyGoalCompletion = document.getElementById('weeklyGoalCompletion');
        const sessionsDoneEl = document.getElementById('sessionsDone');
        const totalFocusedEl = document.getElementById('totalFocused');

        const startBtn = document.getElementById('startTimerBtn');
        const manualBtn = document.getElementById('addManualEntryBtn');
        const assignBtn = document.getElementById('assignToProjectBtn');

        let isRunning = false;
        let seconds = 0;
        let interval = null;

        let completed = [];
        const weeklyGoalSeconds = 30 * 60; // demo: 30 minutes goal

        function pad(n) { return String(n).padStart(2, '0'); }

        function formatHMS(totalSeconds) {
            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const secs = totalSeconds % 60;
            return `${pad(hours)}:${pad(minutes)}:${pad(secs)}`;
        }

        function updateTimer() {
            timerEl.textContent = formatHMS(seconds);
        }

        function setRunning(running) {
            isRunning = running;
            if (pauseBtn) pauseBtn.disabled = !isRunning;
        }

        function start() {
            if (isRunning) return;
            setRunning(true);
            interval = setInterval(() => {
                seconds += 1;
                updateTimer();
            }, 1000);
        }

        function pause() {
            if (!isRunning) return;
            setRunning(false);
            clearInterval(interval);
            interval = null;
        }

        function stop() {
            pause();
            seconds = 0;
            updateTimer();
        }

        function complete() {
            if (seconds <= 0) {
                alert('Run a session first.');
                return;
            }
            pause();

            const durationSeconds = seconds;
            const now = new Date();
            completed.push({
                durationSeconds,
                at: now.toLocaleString()
            });

            seconds = 0;
            updateTimer();

            renderCompleted();
            updateSnapshot();
        }

        function renderCompleted() {
            if (!completedSessionsEl) return;

            if (completed.length === 0) {
                completedSessionsEl.innerHTML = '<div class="text-center py-10 text-[#6a6a6a] text-xs">No completed sessions yet.</div>';
                return;
            }

            const recent = completed.slice().reverse().slice(0, 5);
            completedSessionsEl.innerHTML = recent.map(item => {
                return `
                    <div class="session-card flex flex-wrap items-center justify-between gap-3 p-3 rounded-xl border border-[#e2e4e8] bg-white">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#e8f5e9] flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-circle-nodes text-sm text-[#00c853]"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-[#1a1a1a] truncate">Focus Session</p>
                                <p class="text-xs text-[#6a6a6a]">${item.at}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <span class="text-sm font-semibold text-[#1a1a1a]">${formatHMS(item.durationSeconds)}</span>
                            <span class="text-xs font-medium text-[#00c853] bg-[#e8f5e9] px-2 py-1 rounded-full">Completed</span>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function updateSnapshot() {
            if (!weeklyGoalCompletion || !sessionsDoneEl || !totalFocusedEl) return;

            const totalCompletedSeconds = completed.reduce((acc, x) => acc + x.durationSeconds, 0);
            const capped = Math.min(totalCompletedSeconds, weeklyGoalSeconds);
            const percent = weeklyGoalSeconds === 0 ? 0 : Math.round((capped / weeklyGoalSeconds) * 100);

            weeklyProgressFill && (weeklyProgressFill.style.width = `${percent}%`);

            weeklyGoalCompletion.textContent = `${Math.floor(capped/60)}m / ${Math.floor(weeklyGoalSeconds/60)}m`;
            sessionsDoneEl.textContent = String(completed.length);
            totalFocusedEl.textContent = formatHMS(totalCompletedSeconds).replace(/^00:/,'');

            // also adjust efficiency demo labels
            const efficiencyEl = document.querySelectorAll('.rounded-2xl')[3]?.querySelector('p.text-2xl');
            if (efficiencyEl) efficiencyEl.textContent = `${percent}%`;

            const weeklyProgressPercentEl = document.querySelectorAll('.rounded-2xl')[1]?.querySelector('p.text-2xl');
            if (weeklyProgressPercentEl) weeklyProgressPercentEl.textContent = `${percent}%`;

            const timeLoggedEl = document.querySelectorAll('.rounded-2xl')[2]?.querySelector('p.text-2xl');
            if (timeLoggedEl) timeLoggedEl.textContent = `${(totalCompletedSeconds/3600).toFixed(1)}h`;
        }

        // wire events
        if (startBtn) startBtn.addEventListener('click', start);
        if (pauseBtn) pauseBtn.addEventListener('click', pause);
        if (stopBtn) stopBtn.addEventListener('click', stop);
        if (completeBtn) completeBtn.addEventListener('click', complete);

        if (manualBtn) manualBtn.addEventListener('click', () => alert('Manual time entry is a demo button.'));
        if (assignBtn) assignBtn.addEventListener('click', () => alert('Assign to project is a demo button.'));

        updateTimer();
        setRunning(false);
        updateSnapshot();
    })();
</script>

<style>
    * { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
    .progress-bar-animated { animation: progress-fill 1s ease-out forwards; }
    @keyframes progress-fill { from { width: 0%; } }
    .stat-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.06); }
    .session-card { transition: all 0.2s ease; }
</style>
@endsection

