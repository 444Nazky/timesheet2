@extends('layouts.app')

@section('content')
<!-- App Frame Wrapper to mimic the container visual from WhatsApp Image 2026-07-09 at 21.48.45.jpeg -->
<div class="w-full min-h-screen bg-[#2D3035] p-2 sm:p-6 flex items-center justify-center font-sans antialiased">
    <div class="w-full max-w-7xl bg-[#121316] rounded-[2rem] overflow-hidden shadow-2xl border border-slate-900 flex flex-col md:flex-row">
        
        <!-- Left Side Navigation Menu -->
        <aside class="w-full md:w-64 bg-[#1C1D21] p-6 flex flex-col justify-between shrink-0 border-r border-slate-900/60">
            <div class="space-y-8">
                <!-- Branding Block -->
                <div class="flex items-center gap-3 px-3">
                    <div class="h-8 w-8 bg-white rounded-lg flex items-center justify-center shadow-sm">
                        <span class="text-black font-black text-xs tracking-tighter">03</span>
                    </div>
                </div>

                <!-- Navigation List -->
                <nav class="space-y-1.5">
                    <!-- Dashboard Active Entry -->
                    <a href="#" class="flex items-center justify-between group px-3 py-3 rounded-xl bg-gradient-to-r from-red-500/5 to-transparent text-[#F24343] font-semibold text-xs tracking-wider uppercase transition-all">
                        <div class="flex items-center gap-3.5">
                            <svg class="h-4 w-4 text-[#F24343]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                            </svg>
                            <span>Dashboard</span>
                        </div>
                        <div class="h-4 w-0.5 bg-[#F24343] rounded-full"></div>
                    </a>

                    <!-- Other Nav Items -->
                    @foreach(['Projects', 'My Task', 'Calendar', 'Time Manage', 'Reports', 'Settings'] as $item)
                    <a href="#" class="flex items-center gap-3.5 px-3 py-3 text-slate-500 hover:text-slate-300 font-medium text-xs tracking-wider uppercase transition-all">
                        @if($item == 'Projects')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        @elseif($item == 'My Task')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        @elseif($item == 'Calendar')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        @elseif($item == 'Time Manage')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @elseif($item == 'Reports')
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        @else
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        @endif
                        <span>{{ $item }}</span>
                    </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        <!-- Main Core Dashboard Space -->
        <main class="flex-1 bg-[#18191B] p-6 space-y-6 flex flex-col justify-between">
            
            <!-- Global Top Bar Console Component -->
            <div class="flex items-center justify-between w-full border-b border-slate-950 pb-4">
                <!-- Clean integrated Search System -->
                <div class="relative w-72">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="h-4 w-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" placeholder="Search" class="w-full bg-transparent text-sm text-slate-300 pl-9 pr-4 py-1 focus:outline-none placeholder-slate-600">
                </div>

                <!-- Identity profile nodes -->
                <div class="flex items-center gap-6">
                    <button class="text-slate-500 hover:text-slate-300 relative">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Avatar" class="h-7 w-7 rounded-full border border-slate-700 object-cover">
                </div>
            </div>

            <!-- Workspace Matrix Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start w-full">
                
                <!-- Left Sector Block: Project Analytics Overview Cards -->
                <div class="space-y-4">
                    <!-- Google Engine Progress Card -->
                    <div class="bg-[#212327] rounded-2xl p-5 border border-slate-800/40 space-y-5">
                        <div class="flex items-start justify-between">
                            <div class="flex gap-3">
                                <div class="h-10 w-10 rounded-xl bg-slate-900 flex items-center justify-center font-bold text-white text-lg">G</div>
                                <div>
                                    <h4 class="text-sm font-semibold text-white tracking-wide">Google</h4>
                                    <p class="text-[11px] text-slate-500 font-mono">Google inc.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5 text-slate-500">
                                <svg class="h-4 w-4 text-amber-400 fill-amber-400" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="h-4 w-4 cursor-pointer" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/></svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-slate-400 bg-slate-900 px-2.5 py-1 rounded-md tracking-wider">SELECT PROGRESS</span>
                            <span class="text-[9px] font-bold text-red-500 border border-red-500/30 px-2 py-0.5 rounded tracking-widest">HIGH</span>
                        </div>

                        <div class="space-y-1.5">
                            <div class="flex justify-between text-[11px] font-medium text-slate-300">
                                <span>Task Done: 25 / 50</span>
                            </div>
                            <div class="w-full bg-slate-950 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-[#F24343] h-full rounded-full" style="width: 50%"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div class="flex gap-1.5">
                                <span class="text-[10px] font-semibold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-md tracking-wide">IOS APP</span>
                                <span class="text-[10px] font-semibold text-blue-400 bg-blue-500/10 px-2.5 py-1 rounded-md tracking-wide">UI/UX</span>
                            </div>
                            <div class="flex -space-x-1.5 overflow-hidden">
                                <img class="inline-block h-5 w-5 rounded-full ring-2 ring-[#212327]" src="https://ui-avatars.com/api/?name=A1&background=F24343&color=fff" alt="">
                                <img class="inline-block h-5 w-5 rounded-full ring-2 ring-[#212327]" src="https://ui-avatars.com/api/?name=A2&background=3B82F6&color=fff" alt="">
                                <img class="inline-block h-5 w-5 rounded-full ring-2 ring-[#212327]" src="https://ui-avatars.com/api/?name=A3&background=10B981&color=fff" alt="">
                                <div class="flex h-5 w-5 items-center justify-center rounded-full bg-slate-900 text-[9px] font-bold text-slate-400 ring-2 ring-[#212327]">+5</div>
                            </div>
                        </div>

                        <div class="border-t border-slate-800/60 pt-3 text-center">
                            <span class="text-[10px] font-bold text-[#F24343] tracking-widest bg-red-500/5 py-1 px-3 rounded-md">DUE DATE: 20 JUNE</span>
                        </div>
                    </div>

                    <!-- Slack Engine Progress Card -->
                    <div class="bg-[#212327] rounded-2xl p-5 border border-slate-800/40 space-y-5">
                        <div class="flex items-start justify-between">
                            <div class="flex gap-3">
                                <div class="h-10 w-10 rounded-xl bg-slate-900 flex items-center justify-center font-bold text-white text-lg">S</div>
                                <div>
                                    <h4 class="text-sm font-semibold text-white tracking-wide">Slack</h4>
                                    <p class="text-[11px] text-slate-500 font-mono">Slack corporation</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2.5 text-slate-500">
                                <svg class="h-4 w-4 text-amber-400 fill-amber-400" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="h-4 w-4 cursor-pointer" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/></svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-md tracking-wider">COMPLETED</span>
                            <span class="text-[9px] font-bold text-emerald-500 border border-emerald-500/30 px-2 py-0.5 rounded tracking-widest">MEDIUM</span>
                        </div>

                        <div class="space-y-1.5">
                            <div class="flex justify-between text-[11px] font-medium text-slate-300">
                                <span>Task Done: 30 / 30</span>
                            </div>
                            <div class="w-full bg-slate-950 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-amber-500 h-full rounded-full" style="width: 100%"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div class="flex gap-1.5">
                                <span class="text-[10px] font-semibold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-md tracking-wide">IOS APP</span>
                                <span class="text-[10px] font-semibold text-amber-400 bg-amber-500/10 px-2.5 py-1 rounded-md tracking-wide">ANDROID</span>
                            </div>
                            <div class="flex -space-x-1.5 overflow-hidden">
                                <img class="inline-block h-5 w-5 rounded-full ring-2 ring-[#212327]" src="https://ui-avatars.com/api/?name=S1&background=10B981&color=fff" alt="">
                                <img class="inline-block h-5 w-5 rounded-full ring-2 ring-[#212327]" src="https://ui-avatars.com/api/?name=S2&background=F59E0B&color=fff" alt="">
                                <div class="flex h-5 w-5 items-center justify-center rounded-full bg-slate-900 text-[9px] font-bold text-slate-400 ring-2 ring-[#212327]">+2</div>
                            </div>
                        </div>

                        <div class="border-t border-slate-800/60 pt-3 text-center">
                            <span class="text-[10px] font-bold text-[#F24343] tracking-widest bg-red-500/5 py-1 px-3 rounded-md">DUE DATE: 20 JUNE</span>
                        </div>
                    </div>
                </div>

                <!-- Center Sector Block: Tasks Matrix & Realtime Tracking Stream -->
                <div class="space-y-4">
                    <!-- Tasks Listing Header Container -->
                    <div class="bg-[#212327] rounded-2xl p-5 border border-slate-800/40">
                        <h3 class="text-sm font-semibold text-white mb-4 tracking-wide">My Tasks <span class="text-slate-500 font-mono text-xs ml-1">(05)</span></h3>
                        <div class="space-y-3.5">
                            @foreach([
                                ['id' => '01', 'title' => 'Create wireframe', 'done' => false],
                                ['id' => '02', 'title' => 'Slack Logo Design', 'done' => false],
                                ['id' => '03', 'title' => 'Dashboard Design', 'done' => false],
                                ['id' => '04', 'title' => 'Create wireframe', 'done' => true],
                                ['id' => '05', 'title' => 'Google Logo Design', 'done' => true],
                                ['id' => '06', 'title' => 'Slack Logo Design', 'done' => false],
                                ['id' => '07', 'title' => 'Dashboard Design', 'done' => false],
                            ] as $task)
                            <div class="flex items-center justify-between text-xs py-1 border-b border-slate-800/30 last:border-0">
                                <div class="flex items-center gap-3">
                                    <span class="font-mono text-slate-600 text-[11px]">{{ $task['id'] }}</span>
                                    <span class="{{ $task['done'] ? 'line-through text-slate-600' : 'text-slate-300' }} font-medium">{{ $task['title'] }}</span>
                                </div>
                                <div class="h-4 w-4 rounded-full border {{ $task['done'] ? 'bg-amber-500 border-amber-500 flex items-center justify-center text-slate-950 font-bold text-[9px]' : 'border-slate-700' }}">
                                    @if($task['done']) ✓ @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Micro Telemetry Realtime Logger Stream -->
                    <div class="bg-[#212327] rounded-2xl p-4 border border-slate-800/40 space-y-3">
                        <!-- Sector Group Google -->
                        <div>
                            <h4 class="text-[11px] font-bold text-slate-500 tracking-wider uppercase mb-2">Google</h4>
                            <div class="bg-[#2D2324] border border-red-900/30 rounded-xl p-2.5 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                    <span class="text-slate-200 font-medium">Create Wireframe</span>
                                </div>
                                <div class="flex items-center gap-3 font-mono text-slate-400">
                                    <span>25m 20s</span>
                                    <button class="bg-red-500 p-1 rounded text-white shadow-sm">
                                        <svg class="h-2.5 w-2.5" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Sector Group Slack -->
                        <div>
                            <h4 class="text-[11px] font-bold text-slate-500 tracking-wider uppercase mb-2">Slack</h4>
                            <div class="space-y-1.5">
                                @foreach([['Slack logo design', '30m 10s'], ['Dashboard design', '30m 10s'], ['Create Wireframe', '30m 10s']] as $subLog)
                                <div class="bg-slate-950/40 rounded-xl p-2.5 flex items-center justify-between text-xs">
                                    <span class="text-slate-400 font-medium">{{ $subLog[0] }}</span>
                                    <div class="flex items-center gap-3 font-mono text-slate-500">
                                        <span>{{ $subLog[1] }}</span>
                                        <button class="text-slate-500 hover:text-slate-300">
                                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sector Block: Mini-Calendar Shell & Message Feed -->
                <div class="space-y-4">
                    <!-- Calendar Widget Template Component -->
                    <div class="bg-[#212327] rounded-2xl p-5 border border-slate-800/40">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-semibold text-white tracking-wide">Feb 2020</h3>
                            <div class="flex gap-1.5">
                                <button class="h-5 w-5 rounded-full bg-[#F24343] flex items-center justify-center text-white font-black text-xs">‹</button>
                                <button class="h-5 w-5 rounded-full bg-[#F24343] flex items-center justify-center text-white font-black text-xs">›</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-7 gap-y-3 text-center text-[10px] font-mono">
                            @foreach(['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'] as $day)
                            <span class="text-slate-600 font-bold">{{ $day }}</span>
                            @endforeach

                            @foreach([26,27,28,29,30,31,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29] as $date)
                            <div class="flex items-center justify-center py-0.5">
                                <span class="h-5 w-5 flex items-center justify-center rounded-full font-medium
                                    {{ $date == 5 ? 'bg-[#F24343] text-white font-bold' : '' }}
                                    {{ $loop->index < 6 ? 'text-slate-700' : 'text-slate-400' }}">
                                    {{ sprintf('%02d', $date) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Realtime Chat / Messaging Component -->
                    <div class="bg-[#212327] rounded-2xl p-5 border border-slate-800/40">
                        <h3 class="text-sm font-semibold text-white mb-4 tracking-wide">Messages</h3>
                        <div class="space-y-4">
                            @foreach([
                                ['name' => 'John Doe', 'msg' => 'Hi Angelina! How are you?', 'color' => 'bg-cyan-500'],
                                ['name' => 'Charmie', 'msg' => 'Do you need that design?', 'color' => 'bg-amber-500'],
                                ['name' => 'Jason Mandela', 'msg' => 'What is the price of hourly...', 'color' => 'bg-blue-500'],
                                ['name' => 'Charlie Chu', 'msg' => 'Awesome!', 'color' => 'bg-purple-500']
                            ] as $msg)
                            <div class="flex items-center gap-3 text-xs border-b border-slate-800/20 last:border-0 pb-3 last:pb-0">
                                <div class="relative shrink-0">
                                    <div class="h-8 w-8 rounded-full {{ $msg['color'] }} text-slate-950 font-bold flex items-center justify-center uppercase">
                                        {{ substr($msg['name'], 0, 2) }}
                                    </div>
                                    <span class="absolute bottom-0 right-0 h-2 w-2 rounded-full bg-emerald-500 ring-2 ring-[#212327]"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-slate-200 truncate">{{ $msg['name'] }}</h4>
                                    <p class="text-slate-500 text-[11px] truncate mt-0.5">{{ $msg['msg'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </main>

    </div>
</div>
@endsection