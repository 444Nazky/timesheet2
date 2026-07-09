<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>timesheet</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="min-h-screen bg-[#0b0d10] text-slate-300 antialiased selection:bg-[#ff3344] selection:text-white">
    <div class="flex min-h-screen flex-col lg:flex-row">
        <aside class="w-full border-b border-[#23272d] bg-[#12151a] px-5 py-6 lg:w-72 lg:border-b-0 lg:border-r">
            <div class="mb-8 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-2xl border border-white/20 bg-white text-sm font-black tracking-wider text-slate-950">
                    03
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-[0.35em] text-slate-500">Workspace</p>
                    <p class="text-sm font-semibold text-white">Astra OS</p>
                </div>
            </div>

            <nav class="space-y-1.5">
                @php
                    $navItems = [
                        ['label' => 'Dashboard', 'icon' => 'fa-th-large', 'active' => true],
                        ['label' => 'Projects', 'icon' => 'fa-briefcase', 'active' => false],
                        ['label' => 'My Task', 'icon' => 'fa-tasks', 'active' => false],
                        ['label' => 'Calendar', 'icon' => 'fa-calendar-alt', 'active' => false],
                        ['label' => 'Time Manage', 'icon' => 'fa-clock', 'active' => false],
                        ['label' => 'Reports', 'icon' => 'fa-chart-bar', 'active' => false],
                        ['label' => 'Settings', 'icon' => 'fa-cog', 'active' => false],
                    ];
                @endphp

                @foreach ($navItems as $item)
                    <a href="#" class="flex items-center justify-between rounded-2xl px-4 py-3 text-[11px] font-semibold uppercase tracking-[0.28em] transition {{ $item['active'] ? 'border-r-4 border-[#ff3344] bg-[#1d2128] text-[#ff3344]' : 'text-slate-500 hover:bg-[#1d2128] hover:text-white' }}">
                        <span class="flex items-center gap-3">
                            <i class="fas {{ $item['icon'] }} w-4 text-center"></i>
                            {{ $item['label'] }}
                        </span>
                    </a>
                @endforeach
            </nav>

            <div class="mt-10 rounded-3xl border border-[#262b32] bg-[#171b21] p-4">
                <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Focus mode</p>
                <p class="mt-2 text-sm font-semibold text-white">Deep work is on.</p>
                <div class="mt-4 h-2 rounded-full bg-[#23272d]">
                    <div class="h-2 w-3/4 rounded-full bg-[#ff3344]"></div>
                </div>
            </div>
        </aside>

        <main class="flex-1 bg-[#0f1216] p-4 sm:p-6 lg:p-8">
            <header class="mb-6 flex flex-wrap items-center justify-between gap-4 rounded-[2rem] border border-[#23272d] bg-[#12151a] px-4 py-4 shadow-[0_12px_40px_rgba(0,0,0,0.25)] sm:px-6">
                <div class="relative w-full max-w-sm">
                    <i class="fa fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-600"></i>
                    <input type="text" placeholder="Search workspace" class="w-full rounded-full border border-transparent bg-[#171b21] py-3 pl-11 pr-4 text-sm text-slate-200 outline-none transition focus:border-[#ff3344]/50">
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative rounded-full border border-[#23272d] bg-[#171b21] p-3 text-slate-500 transition hover:text-white">
                        <i class="fa fa-bell"></i>
                        <span class="absolute right-2 top-2 h-2.5 w-2.5 rounded-full bg-[#ff3344]"></span>
                    </button>
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="User" class="h-10 w-10 rounded-full border border-[#2b3038] object-cover">
                </div>
            </header>          

            <div class="grid gap-6 xl:grid-cols-[1.35fr_0.9fr]">
                <section class="space-y-6">
                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="rounded-[2rem] border border-[#252a32] bg-[#171b21] p-6 shadow-[0_18px_50px_rgba(0,0,0,0.25)]">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Project pulse</p>
                                    <h2 class="mt-2 text-xl font-semibold text-white">Northstar Design</h2>
                                </div>
                                <span class="rounded-full border border-[#ff3344]/25 bg-[#ff3344]/10 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.25em] text-[#ff3344]">High</span>
                            </div>

                            <div class="mt-6">
                                <div class="mb-2 flex items-center justify-between text-sm text-slate-400">
                                    <span>Task done</span>
                                    <span class="font-semibold text-white">24 / 36</span>
                                </div>
                                <div class="h-2 rounded-full bg-[#23272d]">
                                    <div class="h-2 w-2/3 rounded-full bg-[#ff3344]"></div>
                                </div>
                            </div>

                            <div class="mt-5 flex flex-wrap gap-2">
                                <span class="rounded-full bg-emerald-900/40 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.2em] text-emerald-400">IOS APP</span>
                                <span class="rounded-full bg-blue-900/40 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.2em] text-blue-400">UI/UX</span>
                            </div>

                            <div class="mt-6 flex items-center justify-between border-t border-[#23272d] pt-4">
                                <div class="flex -space-x-2">
                                    <img class="h-8 w-8 rounded-full border-2 border-[#171b21] object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=80&q=80" alt="Team member">
                                    <img class="h-8 w-8 rounded-full border-2 border-[#171b21] object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=80&q=80" alt="Team member">
                                    <img class="h-8 w-8 rounded-full border-2 border-[#171b21] object-cover" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=80&q=80" alt="Team member">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-[#171b21] bg-[#23272d] text-[10px] font-semibold text-slate-400">+5</div>
                                </div>
                                <span class="text-[10px] uppercase tracking-[0.25em] text-amber-500">Due 20 June</span>
                            </div>
                        </div>

                        <div class="rounded-[2rem] border border-[#252a32] bg-[#171b21] p-6 shadow-[0_18px_50px_rgba(0,0,0,0.25)]">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Live tracker</p>
                                    <h2 class="mt-2 text-xl font-semibold text-white">Time flow</h2>
                                </div>
                                <button class="rounded-full border border-[#ff3344]/25 bg-[#ff3344]/10 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.25em] text-[#ff3344]">Pause</button>
                            </div>

                            <div class="mt-8 rounded-[1.5rem] border border-[#23272d] bg-[#12151a] p-5">
                                <div class="flex items-end justify-between">
                                    <div>
                                        <p class="text-sm text-slate-400">Current session</p>
                                        <p class="mt-1 text-3xl font-semibold text-white">03:42:19</p>
                                    </div>
                                    <div class="rounded-full bg-amber-500/10 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.2em] text-amber-500">Active</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr]">
                        <div class="rounded-[2rem] border border-[#252a32] bg-[#171b21] p-6 shadow-[0_18px_50px_rgba(0,0,0,0.25)]">
                            <div class="mb-5 flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-white">Today’s tasks</h3>
                                <span class="text-[10px] uppercase tracking-[0.25em] text-slate-500">05 items</span>
                            </div>
                            <div class="space-y-3">
                                @php $tasks = [
                                    ['title' => 'Create product concept', 'done' => false],
                                    ['title' => 'Review design handoff', 'done' => false],
                                    ['title' => 'Finalize onboarding flow', 'done' => true],
                                    ['title' => 'Prepare sprint notes', 'done' => true],
                                ]; @endphp
                                @foreach ($tasks as $task)
                                    <div class="flex items-center justify-between rounded-2xl border border-[#23272d] bg-[#12151a] px-4 py-3">
                                        <span class="text-sm {{ $task['done'] ? 'text-slate-500 line-through' : 'text-slate-200' }}">{{ $task['title'] }}</span>
                                        <div class="h-2.5 w-2.5 rounded-full {{ $task['done'] ? 'bg-emerald-500' : 'bg-[#ff3344]' }}"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="rounded-[2rem] border border-[#252a32] bg-[#171b21] p-6 shadow-[0_18px_50px_rgba(0,0,0,0.25)]">
                            <div class="mb-5 flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-white">Schedule</h3>
                                <span class="text-[10px] uppercase tracking-[0.25em] text-slate-500">July 2026</span>
                            </div>
                            <div class="grid grid-cols-7 gap-2 text-center text-[11px] text-slate-500">
                                @php $days = ['S','M','T','W','T','F','S']; @endphp
                                @foreach ($days as $day)
                                    <div class="py-1 text-[10px] uppercase tracking-[0.2em]">{{ $day }}</div>
                                @endforeach
                                @php $dates = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]; @endphp
                                @foreach ($dates as $date)
                                    <div class="flex h-9 items-center justify-center rounded-full {{ $date === 20 ? 'bg-[#ff3344] text-white' : 'bg-[#12151a] text-slate-400' }}">{{ $date }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                <section class="space-y-6">
                    <div class="rounded-[2rem] border border-[#252a32] bg-[#171b21] p-6 shadow-[0_18px_50px_rgba(0,0,0,0.25)]">
                        <div class="mb-5 flex items-center justify-between">
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.3em] text-slate-500">Messages</p>
                                <h3 class="mt-1 text-lg font-semibold text-white">Recent stream</h3>
                            </div>
                            <button class="text-sm text-slate-500 transition hover:text-white">View all</button>
                        </div>
                        <div class="space-y-3">
                            @php $messages = [
                                ['name' => 'Nina', 'role' => 'Design Lead', 'text' => 'Updated the onboarding states.', 'time' => '2m'],
                                ['name' => 'Milo', 'role' => 'Frontend', 'text' => 'The sprint review is ready.', 'time' => '12m'],
                                ['name' => 'Rae', 'role' => 'Product', 'text' => 'Confirmed the final copy.', 'time' => '1h'],
                            ]; @endphp
                            @foreach ($messages as $message)
                                <div class="flex items-start gap-3 rounded-2xl border border-[#23272d] bg-[#12151a] p-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#23272d] text-sm font-semibold text-white">
                                        {{ strtoupper(substr($message['name'], 0, 1)) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-2">
                                            <p class="text-sm font-semibold text-white">{{ $message['name'] }}</p>
                                            <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500">{{ $message['time'] }}</span>
                                        </div>
                                        <p class="text-xs text-slate-500">{{ $message['role'] }}</p>
                                        <p class="mt-1 text-sm text-slate-300">{{ $message['text'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-[#252a32] bg-[#171b21] p-6 shadow-[0_18px_50px_rgba(0,0,0,0.25)]">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">Momentum</h3>
                            <span class="text-[10px] uppercase tracking-[0.25em] text-amber-500">+12%</span>
                        </div>
                        <div class="rounded-[1.5rem] border border-[#23272d] bg-[#12151a] p-5">
                            <div class="flex items-end justify-between">
                                <div>
                                    <p class="text-sm text-slate-400">Weekly output</p>
                                    <p class="mt-2 text-3xl font-semibold text-white">82%</p>
                                </div>
                                <div class="flex h-16 w-16 items-center justify-center rounded-full border border-[#ff3344]/30 bg-[#ff3344]/10 text-lg font-semibold text-[#ff3344]">+8</div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
