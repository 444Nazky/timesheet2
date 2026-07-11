@extends('layouts.app')

@section('content')
<!-- Outer Frame Wrapper -->
<div class="w-full min-h-screen bg-[#32363c] p-4 md:p-12 flex items-center justify-center font-sans antialiased text-slate-300">
    
    <!-- Main Application Shell Container -->
    <div class="w-full max-w-7xl bg-[#1e2022] rounded-[2.5rem] overflow-hidden shadow-[0_25px_60px_-15px_rgba(0,0,0,0.7)] border border-[#2d3035] flex flex-col md:flex-row min-h-[760px]">
        
        <!-- Left Side Navigation Menu Panel -->
        <aside class="w-full md:w-64 bg-[#24272c] p-7 flex flex-col justify-between shrink-0 border-r border-[#1a1c1e]/40">
            <div class="space-y-10">
                <!-- Premium Branding Block / Custom Logo -->
                <div class="flex items-center gap-3 px-3">
                    <div class="h-10 w-10 bg-transparent border-2 border-white rounded-xl flex items-center justify-center shadow-sm">
                        <span class="text-white font-black text-sm tracking-tighter">03</span>
                    </div>
                </div>

                <!-- Navigation List System -->
                <nav class="space-y-2">
                    <!-- Dashboard Link (Active State) -->
                    <a href="#" class="flex items-center justify-between group px-4 py-3.5 rounded-xl bg-[#2b2e35]/40 text-[#f24343] font-bold text-xs tracking-widest uppercase transition-all">
                        <div class="flex items-center gap-3.5">
                            <svg class="h-4 w-4 text-[#f24343]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                            </svg>
                            <span>Dashboard</span>
                        </div>
                        <!-- Active vertical edge indicator pill -->
                        <div class="h-4 w-1 bg-[#f24343] rounded-full"></div>
                    </a>

                    <!-- Other Functional Inactive Nav Links -->
                    @foreach([
                        'Projects' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                        'My Task' => 'M4 6h16M4 12h16M4 18h7',
                        'Calendar' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'Time Manage' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'Reports' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'Settings' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'
                    ] as $item => $path)
                    <a href="#" class="flex items-center gap-3.5 px-4 py-3.5 text-slate-500 hover:text-slate-300 font-bold text-xs tracking-widest uppercase transition-all">
                        <svg class="h-4 w-4 text-slate-500 group-hover:text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}"/>
                        </svg>
                        <span>{{ $item }}</span>
                    </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        <!-- Main Workspace Viewport -->
        <main class="flex-1 bg-[#1a1c1e] p-6 lg:p-8 space-y-6 flex flex-col justify-between">
            
            <!-- Global Top Bar Console -->
            <div class="flex items-center justify-between w-full pb-2">
                <!-- Clean Integrated Search Bar Container -->
                <div class="relative w-80">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="h-4 w-4 text-slate-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" placeholder="Search" class="w-full bg-transparent text-sm text-slate-300 pl-9 pr-4 py-1.5 focus:outline-none placeholder-slate-600 font-medium">
                </div>

                <!-- Identity Action Controls -->
                <div class="flex items-center gap-6">
                    <button class="text-slate-500 hover:text-slate-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>
<img src="assets/guest.svg" alt="Avatar User" class="h-8 w-8 rounded-full border border-slate-700 object-cover">
                </div>
            </div>

            <!-- Dashboard Matrix Workspace Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start w-full h-full">
                
                <!-- COLUMN 1: Analytics Project Management Overview -->
                <div class="space-y-5">
                    <!-- Google Engine Progress Component Card -->
                    <div class="bg-[#272a30] rounded-[2rem] p-6 border border-slate-800/20 space-y-5 shadow-lg shadow-black/10">
                        <div class="flex items-start justify-between">
                            <div class="flex gap-3.5">
                                <div class="h-11 w-11 rounded-xl bg-[#1e2022] flex items-center justify-center shadow-inner">
                                    <!-- Google Colored SVG Logo Icon Layout -->
                                    <svg class="h-5 w-5" viewBox="0 0 24 24">
                                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white tracking-wide">Google</h4>
                                    <p class="text-[11px] text-slate-500 font-mono tracking-tight mt-0.5">Google inc.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 text-slate-500">
                                <svg class="h-4 w-4 text-amber-500 fill-amber-500" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="h-4 w-4 text-slate-600 cursor-pointer" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/></svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-extrabold text-slate-400 bg-[#1e2022] px-3 py-1.5 rounded-lg tracking-wider">SELECT PROGRESS</span>
                            <span class="text-[9px] font-bold text-[#f24343] border border-[#f24343]/40 px-2 py-0.5 rounded tracking-widest bg-[#f24343]/5">HIGH</span>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-semibold text-slate-300">
                                <span>Task Done: 25 / 50</span>
                            </div>
                            <div class="w-full bg-[#1e2022] h-2 rounded-full overflow-hidden p-[1px]">
                                <div class="bg-[#f24343] h-full rounded-full shadow-[0_0_8px_rgba(242,67,67,0.5)]" style="width: 50%"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div class="flex gap-2">
                                <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-md tracking-wider uppercase">IOS APP</span>
                                <span class="text-[10px] font-bold text-blue-400 bg-blue-500/10 px-2.5 py-1 rounded-md tracking-wider uppercase">UI/UX</span>
                            </div>
                            <div class="flex -space-x-2 overflow-hidden">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#272a30] object-cover" src="assets/guest.svg" alt="">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#272a30] object-cover" src="assets/guest.svg" alt="">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#272a30] object-cover" src="assets/guest.svg" alt="">
                                <div class="flex h-6 w-6 items-center justify-center rounded-full bg-[#1e2022] text-[9px] font-bold text-slate-400 ring-2 ring-[#272a30]">+5</div>
                            </div>
                        </div>

                        <div class="pt-3 text-left">
                            <span class="text-[10px] font-extrabold text-[#f24343] tracking-widest bg-[#f24343]/5 py-1.5 px-3 rounded-lg border border-[#f24343]/10">DUE DATE: 20 JUNE</span>
                        </div>
                    </div>

                    <!-- Slack Engine Progress Component Card -->
                    <div class="bg-[#272a30] rounded-[2rem] p-6 border border-slate-800/20 space-y-5 shadow-lg shadow-black/10">
                        <div class="flex items-start justify-between">
                            <div class="flex gap-3.5">
                                <div class="h-11 w-11 rounded-xl bg-[#1e2022] flex items-center justify-center shadow-inner">
                                    <!-- Slack Authentic Icon Presentation -->
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M5.042 15.165a2.528 2.528 0 0 1-2.52 2.523 2.528 2.528 0 0 1-2.522-2.523 2.528 2.528 0 0 1 2.522-2.52h2.52v2.52zm1.261 0a2.528 2.528 0 0 1 2.52-2.52h5.043a2.528 2.528 0 0 1 2.522 2.52v5.042a2.528 2.528 0 0 1-2.522 2.52H8.823a2.528 2.528 0 0 1-2.52-2.52v-5.042zM8.823 5.043a2.528 2.528 0 0 1-2.52-2.522A2.528 2.528 0 0 1 8.823 0a2.528 2.528 0 0 1 2.52 2.521v2.522h-2.52zm0 1.261a2.528 2.528 0 0 1 2.52 2.52v5.043a2.528 2.528 0 0 1-2.52 2.522H3.78a2.528 2.528 0 0 1-2.522-2.522V8.824a2.528 2.528 0 0 1 2.522-2.52h5.043zm10.135 2.52a2.528 2.528 0 0 1 2.522-2.522 2.528 2.528 0 0 1 2.52 2.522v2.52h-2.52a2.528 2.528 0 0 1-2.522-2.52zm-1.262 0a2.528 2.528 0 0 1-2.52 2.52h-5.043a2.528 2.528 0 0 1-2.522-2.52V3.782a2.528 2.528 0 0 1 2.522-2.52h5.043a2.528 2.528 0 0 1 2.52 2.52v5.043zm-3.781 10.135a2.528 2.528 0 0 1 2.52 2.522a2.528 2.528 0 0 1-2.52 2.522a2.528 2.528 0 0 1-2.522-2.522v-2.52h2.522zm0-1.262a2.528 2.528 0 0 1-2.52-2.52v-5.043a2.528 2.528 0 0 1 2.52-2.522h5.043a2.528 2.528 0 0 1 2.522 2.522v5.043a2.528 2.528 0 0 1-2.522 2.52h-5.043z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white tracking-wide">Slack</h4>
                                    <p class="text-[11px] text-slate-500 font-mono tracking-tight mt-0.5">Slack corporation</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 text-slate-500">
                                <svg class="h-4 w-4 text-amber-500 fill-amber-500" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="h-4 w-4 text-slate-600 cursor-pointer" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/></svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-extrabold text-emerald-400 bg-emerald-500/10 px-3 py-1.5 rounded-lg tracking-wider">COMPLETED</span>
                            <span class="text-[9px] font-bold text-emerald-500 border border-emerald-500/30 px-2 py-0.5 rounded tracking-widest bg-emerald-500/5">MEDIUM</span>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-semibold text-slate-300">
                                <span>Task Done: 30 / 30</span>
                            </div>
                            <div class="w-full bg-[#1e2022] h-2 rounded-full overflow-hidden p-[1px]">
                                <div class="bg-amber-500 h-full rounded-full shadow-[0_0_8px_rgba(245,158,11,0.5)]" style="width: 100%"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div class="flex gap-2">
                                <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-md tracking-wider uppercase">IOS APP</span>
                                <span class="text-[10px] font-bold text-amber-500 bg-amber-500/10 px-2.5 py-1 rounded-md tracking-wider uppercase">ANDROID</span>
                            </div>
                            <div class="flex -space-x-2 overflow-hidden">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#272a30] object-cover" src="assets/guest.svg" alt="">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#272a30] object-cover" src="assets/guest.svg" alt="">
                                <div class="flex h-6 w-6 items-center justify-center rounded-full bg-[#1e2022] text-[9px] font-bold text-slate-400 ring-2 ring-[#272a30]">+2</div>
                            </div>
                        </div>

                        <div class="pt-3 text-left">
                            <span class="text-[10px] font-extrabold text-[#f24343] tracking-widest bg-[#f24343]/5 py-1.5 px-3 rounded-lg border border-[#f24343]/10">DUE DATE: 20 JUNE</span>
                        </div>
                    </div>
                </div>

                <!-- COLUMN 2: Tasks Matrix Console & Telemetry Stream -->
                <div class="space-y-5">
                    <!-- Tasks Listing Card Container -->
                    <div class="bg-[#272a30] rounded-[2rem] p-6 border border-slate-800/20 shadow-lg shadow-black/10">
                        <h3 class="text-sm font-bold text-white mb-5 tracking-wide flex items-center">
                            My Tasks <span class="text-slate-500 font-mono text-xs ml-2"> (05)</span>
                        </h3>
                        <div class="space-y-4">
                            @foreach([
                                ['id' => '01', 'title' => 'Create wireframe', 'done' => false, 'meta' => false],
                                ['id' => '02', 'title' => 'Slack Logo Design', 'done' => false, 'meta' => true, 'chats' => 3, 'links' => 5],
                                ['id' => '03', 'title' => 'Dashboard Design', 'done' => false, 'meta' => true, 'chats' => 5],
                                ['id' => '04', 'title' => 'Create wireframe', 'done' => true, 'meta' => false],
                                ['id' => '05', 'title' => 'Google Logo Design', 'done' => true, 'meta' => false],
                                ['id' => '06', 'title' => 'Slack Logo Design', 'done' => false, 'meta' => false],
                                ['id' => '07', 'title' => 'Dashboard Design', 'done' => false, 'meta' => true, 'chats' => 5],
                            ] as $task)
                            <div class="flex items-center justify-between text-xs py-1.5 border-b border-slate-800/40 last:border-0">
                                <div class="flex items-center gap-4 min-w-0">
                                    <span class="font-mono text-slate-600 text-[11px] font-bold">{{ $task['id'] }}</span>
                                    <div class="flex items-center gap-2 min-w-0">
                                        <span class="{{ $task['done'] ? 'line-through text-slate-600' : 'text-slate-300' }} font-semibold truncate">{{ $task['title'] }}</span>
                                        
                                        <!-- Realtime Micro Task Meta Logs Contextual Indicators -->
                                        @if($task['meta'])
                                        <div class="flex items-center gap-2 text-[10px] text-slate-500 ml-1 font-mono shrink-0">
                                            @if(isset($task['chats']))
                                            <span class="flex items-center gap-0.5"><svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>{{ $task['chats'] }}</span>
                                            @endif
                                            @if(isset($task['links']))
                                            <span class="flex items-center gap-0.5"><svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>{{ $task['links'] }}</span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="h-4.5 w-4.5 rounded-full border shrink-0 flex items-center justify-center transition-all {{ $task['done'] ? 'bg-amber-500 border-amber-500 text-[#1e2022]' : 'border-slate-700' }}">
                                    @if($task['done'])
                                        <span class="text-[10px] font-black">✓</span>
                                    @else
                                        <span class="h-1.5 w-1.5 rounded-full bg-transparent"></span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Micro Telemetry Time Logger Stream System -->
                    <div class="bg-[#272a30] rounded-[2rem] p-5 border border-slate-800/20 space-y-4 shadow-lg shadow-black/10">
                        <!-- Sector Group Matrix Active Component: Google -->
                        <div>
                            <h4 class="text-[11px] font-bold text-slate-500 tracking-widest uppercase mb-2.5">Google</h4>
                            <!-- Premium Tracking Container -->
                            <div class="relative bg-[#2e2326] border border-red-900/30 rounded-2xl p-3 flex items-center justify-between text-xs overflow-hidden">
                                <!-- Edge Active Red Pill Marker -->
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#f24343]"></div>
                                <div class="flex items-center gap-2.5 pl-1">
                                    <span class="h-2 w-2 rounded-full bg-[#f24343] animate-pulse"></span>
                                    <span class="text-white font-bold">Create Wireframe</span>
                                </div>
                                <div class="flex items-center gap-3.5 font-mono text-white font-semibold">
                                    <span>25m 20s</span>
                                    <button class="bg-[#f24343] p-1.5 rounded-lg text-white shadow-md shadow-[#f24343]/20">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Sector Group Matrix Historic Component: Slack -->
                        <div>
                            <h4 class="text-[11px] font-bold text-slate-500 tracking-widest uppercase mb-2.5">Slack</h4>
                            <div class="space-y-2">
                                @foreach([['Slack logo design', '30m 10s'], ['Dashboard design', '30m 10s'], ['Create Wireframe', '30m 10s']] as $subLog)
                                <div class="bg-[#1e2022]/40 rounded-2xl p-3 flex items-center justify-between text-xs border border-transparent hover:border-slate-800/40 transition-all">
                                    <span class="text-slate-400 font-semibold pl-1">{{ $subLog[0] }}</span>
                                    <div class="flex items-center gap-3.5 font-mono text-slate-500">
                                        <span class="font-semibold text-slate-400">{{ $subLog[1] }}</span>
                                        <button class="text-slate-500 hover:text-slate-300 bg-[#1e2022] p-1.5 rounded-lg border border-slate-800/30">
                                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COLUMN 3: Productivity Core Calendar & Realtime Messaging -->
                <div class="space-y-5">
                    <!-- Calendar Widget Template Block -->
                    <div class="bg-[#272a30] rounded-[2rem] p-6 border border-slate-800/20 shadow-lg shadow-black/10">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-sm font-bold text-white tracking-wide">Feb 2020</h3>
                            <div class="flex gap-2">
                                <button class="h-6 w-6 rounded-full bg-[#f24343] flex items-center justify-center text-white font-bold text-sm shadow-md shadow-[#f24343]/20">‹</button>
                                <button class="h-6 w-6 rounded-full bg-[#f24343] flex items-center justify-center text-white font-bold text-sm shadow-md shadow-[#f24343]/20">›</button>
                            </div>
                        </div>

                        <!-- Calendar Grid Configuration Matrix -->
                        <div class="grid grid-cols-7 gap-y-3.5 text-center text-[10px] font-mono tracking-wider">
                            @foreach(['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'] as $day)
                            <span class="text-slate-600 font-black">{{ $day }}</span>
                            @endforeach

                            <!-- Date items matching visual positioning from image -->
                            @foreach([26,27,28,29,30,31,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29] as $date)
                            <div class="flex items-center justify-center py-0.5">
                                <span class="h-6 w-6 flex items-center justify-center rounded-full font-bold transition-all text-xs
                                    {{ $date == 5 && $loop->index > 5 ? 'bg-[#f24343] text-white shadow-[0_0_10px_rgba(242,67,67,0.4)]' : '' }}
                                    {{ $loop->index < 6 ? 'text-slate-700' : ($date == 5 && $loop->index > 5 ? 'text-white' : 'text-slate-400') }}">
                                    {{ sprintf('%02d', $date) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Messaging Stream Component -->
                    <div class="bg-[#272a30] rounded-[2rem] p-6 border border-slate-800/20 shadow-lg shadow-black/10">
                        <h3 class="text-sm font-bold text-white mb-5 tracking-wide">Messages</h3>
                        <div class="space-y-4.5">
                            @foreach([
                                ['name' => 'John Doe', 'msg' => 'Hi Angelina! How are you?', 'img' => 'assets/guest.svg'],
                                ['name' => 'Charmie', 'msg' => 'Do you need that design?', 'img' => 'assets/guest.svg'],
                                ['name' => 'Jason Mandela', 'msg' => 'What is the price of hourly...', 'img' => 'assets/guest.svg'],
                                ['name' => 'Charlie Chu', 'msg' => 'Awesome!', 'img' => 'assets/guest.svg']
                            ] as $msg)
                            <div class="flex items-center gap-3.5 text-xs pb-3.5 border-b border-slate-800/40 last:border-0 last:pb-0">
                                <div class="relative shrink-0">
                                    <img class="h-9 w-9 rounded-full object-cover border border-slate-700 shadow-sm" src="{{ $msg['img'] }}" alt="{{ $msg['name'] }}">
                                    <!-- Online Active Badge Status Indicator -->
                                    <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-[#272a30]"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-white truncate tracking-wide">{{ $msg['name'] }}</h4>
                                    <p class="text-slate-500 text-[11px] truncate mt-0.5 font-medium tracking-tight">{{ $msg['msg'] }}</p>
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