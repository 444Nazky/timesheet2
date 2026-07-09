@extends('layouts.app')

@section('content')
<div class="w-full min-h-screen bg-[#2B2E33] p-3 sm:p-6 md:p-10 flex items-center justify-center font-sans antialiased text-[#A0A5B1]">
    
    <div class="w-full max-w-7xl bg-[#131417] rounded-[2.25rem] overflow-hidden shadow-[0_30px_70px_-20px_rgba(0,0,0,0.85)] border border-[#232529]/60 flex flex-col md:flex-row min-h-[800px]">
        
        <aside class="w-full md:w-64 bg-[#1B1C1F] p-6 flex flex-col shrink-0 border-r border-[#131417]/80 justify-between">
            <div class="space-y-10">
                <div class="flex items-center gap-3 px-3">
                    <div class="h-9 w-9 bg-transparent border-2 border-white rounded-xl flex items-center justify-center shadow-md">
                        <span class="text-white font-black text-xs tracking-tighter">03</span>
                    </div>
                </div>

                <nav class="space-y-1">
                    <a href="#" class="flex items-center justify-between group px-4 py-3 rounded-xl bg-[#23252A] text-[#F24343] font-bold text-[11px] tracking-widest uppercase transition-all duration-200">
                        <div class="flex items-center gap-3.5">
                            <svg class="h-4 w-4 text-[#F24343]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                            </svg>
                            <span>Dashboard</span>
                        </div>
                        <div class="h-3.5 w-1 bg-[#F24343] rounded-full shadow-[0_0_8px_rgba(242,67,67,0.6)]"></div>
                    </a>

                    @foreach([
                        'Projects' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                        'My Task' => 'M4 6h16M4 12h16M4 18h7',
                        'Calendar' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'Time Manage' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'Reports' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'Settings' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'
                    ] as $item => $vectorPath)
                    <a href="#" class="flex items-center gap-3.5 px-4 py-3 text-[#5A5E6B] hover:text-[#C5C9D3] font-bold text-[11px] tracking-widest uppercase transition-all duration-200 group">
                        <svg class="h-4 w-4 text-[#4A4E58] group-hover:text-[#C5C9D3] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $vectorPath }}"/>
                        </svg>
                        <span>{{ $item }}</span>
                    </a>
                    @endforeach
                </nav>
            </div>
        </aside>

        <main class="flex-1 bg-[#131417] p-6 lg:p-8 space-y-8 flex flex-col justify-start">
            
            <div class="flex items-center justify-between w-full pb-2">
                <div class="relative w-80">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <svg class="h-4 w-4 text-[#43464F]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" placeholder="Search" class="w-full bg-transparent text-sm text-[#E2E5EC] pl-10 pr-4 py-2 focus:outline-none placeholder-[#43464F] font-semibold tracking-wide">
                </div>

                <div class="flex items-center gap-6">
                    <button class="text-[#5A5E6B] hover:text-[#C5C9D3] relative transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-0 right-0 block h-1.5 w-1.5 rounded-full bg-[#F24343]"></span>
                    </button>
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Active Account Avatar" class="h-8 w-8 rounded-full border border-[#2E3138] object-cover shadow-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start w-full">
                
                <div class="space-y-6">
                    <div class="bg-[#1F2125] rounded-[2rem] p-6 border border-[#2B2E33]/30 space-y-5 shadow-xl">
                        <div class="flex items-start justify-between">
                            <div class="flex gap-4">
                                <div class="h-12 w-12 rounded-2xl bg-[#131417] flex items-center justify-center shadow-inner border border-slate-900/40">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24">
                                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-extrabold text-white tracking-wide">Google</h4>
                                    <p class="text-[11px] text-[#5A5E6B] font-mono mt-0.5">Google inc.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 text-[#5A5E6B]">
                                <svg class="h-4 w-4 text-amber-500 fill-amber-500" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="h-4 w-4 text-[#3E424B] cursor-pointer" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/></svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-black text-[#8E94A0] bg-[#131417] px-3 py-1.5 rounded-lg tracking-wider">SELECT PROGRESS</span>
                            <span class="text-[9px] font-bold text-[#F24343] border border-[#F24343]/30 px-2 py-0.5 rounded tracking-widest bg-[#F24343]/5">HIGH</span>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-bold text-[#D2D6E0]">
                                <span>Task Done: 25 / 50</span>
                            </div>
                            <div class="w-full bg-[#131417] h-2 rounded-full overflow-hidden p-[1px]">
                                <div class="bg-[#F24343] h-full rounded-full shadow-[0_0_10px_rgba(242,67,67,0.4)]" style="width: 50%"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div class="flex gap-2">
                                <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-md tracking-wider">IOS APP</span>
                                <span class="text-[10px] font-bold text-blue-400 bg-blue-500/10 px-2.5 py-1 rounded-md tracking-wider">UI/UX</span>
                            </div>
                            <div class="flex -space-x-2 overflow-hidden">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#1F2125] object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=60&q=80" alt="">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#1F2125] object-cover" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=60&q=80" alt="">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#1F2125] object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=60&q=80" alt="">
                                <div class="flex h-6 w-6 items-center justify-center rounded-full bg-[#131417] text-[9px] font-bold text-[#8E94A0] ring-2 ring-[#1F2125]">+5</div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <span class="text-[10px] font-extrabold text-[#F24343] tracking-widest bg-[#F24343]/5 py-1.5 px-3 rounded-lg border border-[#F24343]/10">DUE DATE: 20 JUNE</span>
                        </div>
                    </div>

                    <div class="bg-[#1F2125] rounded-[2rem] p-6 border border-[#2B2E33]/30 space-y-5 shadow-xl">
                        <div class="flex items-start justify-between">
                            <div class="flex gap-4">
                                <div class="h-12 w-12 rounded-2xl bg-[#131417] flex items-center justify-center shadow-inner border border-slate-900/40 text-white">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M5.042 15.165a2.528 2.528 0 0 1-2.52 2.523 2.528 2.528 0 0 1-2.522-2.523 2.528 2.528 0 0 1 2.522-2.52h2.52v2.52zm1.261 0a2.528 2.528 0 0 1 2.52-2.52h5.043a2.528 2.528 0 0 1 2.522 2.52v5.042a2.528 2.528 0 0 1-2.522 2.52H8.823a2.528 2.528 0 0 1-2.52-2.52v-5.042zM8.823 5.043a2.528 2.528 0 0 1-2.52-2.522A2.528 2.528 0 0 1 8.823 0a2.528 2.528 0 0 1 2.52 2.521v2.522h-2.52zm0 1.261a2.528 2.528 0 0 1 2.52 2.52v5.043a2.528 2.528 0 0 1-2.52 2.522H3.78a2.528 2.528 0 0 1-2.522-2.522V8.824a2.528 2.528 0 0 1 2.522-2.52h5.043zm10.135 2.52a2.528 2.528 0 0 1 2.522-2.522 2.528 2.528 0 0 1 2.52 2.522v2.52h-2.52a2.528 2.528 0 0 1-2.522-2.52zm-1.262 0a2.528 2.528 0 0 1-2.52 2.52h-5.043a2.528 2.528 0 0 1-2.522-2.52V3.782a2.528 2.528 0 0 1 2.522-2.52h5.043a2.528 2.528 0 0 1 2.52 2.52v5.043zm-3.781 10.135a2.528 2.528 0 0 1 2.52 2.522a2.528 2.528 0 0 1-2.52 2.522a2.528 2.528 0 0 1-2.522-2.522v-2.52h2.522zm0-1.262a2.528 2.528 0 0 1-2.52-2.52v-5.043a2.528 2.528 0 0 1 2.52-2.522h5.043a2.528 2.528 0 0 1 2.522 2.522v5.043a2.528 2.528 0 0 1-2.522 2.52h-5.043z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-extrabold text-white tracking-wide">Slack</h4>
                                    <p class="text-[11px] text-[#5A5E6B] font-mono mt-0.5">Slack corporation</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 text-[#5A5E6B]">
                                <svg class="h-4 w-4 text-amber-500 fill-amber-500" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="h-4 w-4 text-[#3E424B] cursor-pointer" fill="currentColor" viewBox="0 0 20 20"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/></svg>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-black text-emerald-400 bg-emerald-500/10 px-3 py-1.5 rounded-lg tracking-wider">COMPLETED</span>
                            <span class="text-[9px] font-bold text-emerald-500 border border-emerald-500/20 px-2 py-0.5 rounded tracking-widest bg-emerald-500/5">MEDIUM</span>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-bold text-[#D2D6E0]">
                                <span>Task Done: 30 / 30</span>
                            </div>
                            <div class="w-full bg-[#131417] h-2 rounded-full overflow-hidden p-[1px]">
                                <div class="bg-amber-500 h-full rounded-full shadow-[0_0_10px_rgba(245,158,11,0.4)]" style="width: 100%"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div class="flex gap-2">
                                <span class="text-[10px] font-bold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-md tracking-wider">IOS APP</span>
                                <span class="text-[10px] font-bold text-amber-400 bg-amber-500/10 px-2.5 py-1 rounded-md tracking-wider">ANDROID</span>
                            </div>
                            <div class="flex -space-x-2 overflow-hidden">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#1F2125] object-cover" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=60&q=80" alt="">
                                <img class="inline-block h-6 w-6 rounded-full ring-2 ring-[#1F2125] object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=60&q=80" alt="">
                                <div class="flex h-6 w-6 items-center justify-center rounded-full bg-[#131417] text-[9px] font-bold text-[#8E94A0] ring-2 ring-[#1F2125]">+2</div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <span class="text-[10px] font-extrabold text-[#F24343] tracking-widest bg-[#F24343]/5 py-1.5 px-3 rounded-lg border border-[#F24343]/10">DUE DATE: 20 JUNE</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-[#1F2125] rounded-[2rem] p-6 border border-[#2B2E33]/30 shadow-xl">
                        <h3 class="text-sm font-extrabold text-white mb-5 tracking-wide">
                            My Tasks <span class="text-[#5A5E6B] font-mono text-xs ml-1.5">(05)</span>
                        </h3>
                        <div class="space-y-3.5">
                            @foreach([
                                ['id' => '01', 'title' => 'Create wireframe', 'done' => false, 'chats' => null, 'clips' => null],
                                ['id' => '02', 'title' => 'Slack Logo Design', 'done' => false, 'chats' => 3, 'clips' => 5],
                                ['id' => '03', 'title' => 'Dashboard Design', 'done' => false, 'chats' => 5, 'clips' => null],
                                ['id' => '04', 'title' => 'Create wireframe', 'done' => true, 'chats' => null, 'clips' => null],
                                ['id' => '05', 'title' => 'Google Logo Design', 'done' => true, 'chats' => null, 'clips' => null],
                                ['id' => '06', 'title' => 'Slack Logo Design', 'done' => false, 'chats' => null, 'clips' => null],
                                ['id' => '07', 'title' => 'Dashboard Design', 'done' => false, 'chats' => 5, 'clips' => null],
                            ] as $task)
                            <div class="flex items-center justify-between text-xs py-2 border-b border-[#2B2E33]/20 last:border-0">
                                <div class="flex items-center gap-4 min-w-0">
                                    <span class="font-mono text-[#3E424B] text-[11px] font-bold">{{ $task['id'] }}</span>
                                    <div class="flex items-center gap-2 min-w-0">
                                        <span class="{{ $task['done'] ? 'line-through text-[#4A4E58]' : 'text-[#D2D6E0]' }} font-semibold truncate">{{ $task['title'] }}</span>
                                        
                                        @if($task['chats'] || $task['clips'])
                                        <div class="flex items-center gap-2 text-[10px] text-[#5A5E6B] font-mono shrink-0 ml-1">
                                            @if($task['chats'])
                                            <span class="flex items-center gap-0.5"><svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>{{ $task['chats'] }}</span>
                                            @endif
                                            @if($task['clips'])
                                            <span class="flex items-center gap-0.5"><svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>{{ $task['clips'] }}</span>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="h-[18px] w-[18px] rounded-full border flex items-center justify-center shrink-0 transition-all {{ $task['done'] ? 'bg-amber-500 border-amber-500 text-[#131417]' : 'border-[#3E424B]' }}">
                                    @if($task['done'])
                                        <span class="text-[10px] font-black leading-none">✓</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-[#1F2125] rounded-[2rem] p-5 border border-[#2B2E33]/30 space-y-4 shadow-xl">
                        <div>
                            <h4 class="text-[10px] font-black text-[#5A5E6B] tracking-widest uppercase mb-2">Google</h4>
                            <div class="relative bg-[#291F22] border border-[#F24343]/10 rounded-2xl p-3 flex items-center justify-between text-xs overflow-hidden">
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-[#F24343]"></div>
                                <div class="flex items-center gap-2.5 pl-1">
                                    <span class="h-2 w-2 rounded-full bg-[#F24343] animate-pulse"></span>
                                    <span class="text-white font-bold">Create Wireframe</span>
                                </div>
                                <div class="flex items-center gap-3 font-mono text-white font-bold">
                                    <span>25m 20s</span>
                                    <button class="bg-[#F24343] p-1.5 rounded-lg text-white shadow-sm">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[10px] font-black text-[#5A5E6B] tracking-widest uppercase mb-2">Slack</h4>
                            <div class="space-y-2">
                                @foreach([['Slack logo design', '30m 10s'], ['Dashboard design', '30m 10s'], ['Create Wireframe', '30m 10s']] as $subLog)
                                <div class="bg-[#131417]/50 rounded-2xl p-3 flex items-center justify-between text-xs border border-transparent hover:border-[#2B2E33]/20 transition-all">
                                    <span class="text-[#8E94A0] font-semibold pl-1">{{ $subLog[0] }}</span>
                                    <div class="flex items-center gap-3 font-mono text-[#5A5E6B]">
                                        <span class="font-bold text-[#7A7E8B]">{{ $subLog[1] }}</span>
                                        <button class="text-[#5A5E6B] hover:text-[#C5C9D3] bg-[#131417] p-1.5 rounded-lg border border-[#2B2E33]/30 transition-colors">
                                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-[#1F2125] rounded-[2rem] p-6 border border-[#2B2E33]/30 shadow-xl">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-sm font-extrabold text-white tracking-wide">Feb 2020</h3>
                            <div class="flex gap-2">
                                <button class="h-6 w-6 rounded-full bg-[#F24343] flex items-center justify-center text-white font-black text-xs shadow-md shadow-[#F24343]/20">‹</button>
                                <button class="h-6 w-6 rounded-full bg-[#F24343] flex items-center justify-center text-white font-black text-xs shadow-md shadow-[#F24343]/20">›</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-7 gap-y-3.5 text-center text-[10px] font-mono tracking-wider">
                            @foreach(['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'] as $dayName)
                            <span class="text-[#3E424B] font-black">{{ $dayName }}</span>
                            @endforeach

                            @foreach([26,27,28,29,30,31,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29] as $dateValue)
                            <div class="flex items-center justify-center py-0.5">
                                <span class="h-6 w-6 flex items-center justify-center rounded-full font-bold text-xs transition-all
                                    {{ $dateValue == 5 && $loop->index > 5 ? 'bg-[#F24343] text-white font-extrabold shadow-[0_0_12px_rgba(242,67,67,0.4)]' : '' }}
                                    {{ $loop->index < 6 ? 'text-[#2D3139]' : ($dateValue == 5 && $loop->index > 5 ? 'text-white' : 'text-[#8E94A0]') }}">
                                    {{ sprintf('%02d', $dateValue) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-[#1F2125] rounded-[2rem] p-6 border border-[#2B2E33]/30 shadow-xl">
                        <h3 class="text-sm font-extrabold text-white mb-5 tracking-wide">Messages</h3>
                        <div class="space-y-4">
                            @foreach([
                                ['user' => 'John Doe', 'text' => 'Hi Angelina! How are you?', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=80&q=80'],
                                ['user' => 'Charmie', 'text' => 'Do you need that design?', 'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=80&q=80'],
                                ['user' => 'Jason Mandela', 'text' => 'What is the price of hourly...', 'avatar' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=80&q=80'],
                                ['user' => 'Charlie Chu', 'text' => 'Awesome!', 'avatar' => 'https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?auto=format&fit=crop&w=80&q=80']
                            ] as $messagePayload)
                            <div class="flex items-center gap-3.5 text-xs pb-3.5 border-b border-[#2B2E33]/20 last:border-0 last:pb-0">
                                <div class="relative shrink-0">
                                    <img class="h-9 w-9 rounded-full object-cover border border-[#2E3138] shadow-sm" src="{{ $messagePayload['avatar'] }}" alt="">
                                    <span class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-[#1F2125]"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-white truncate tracking-wide">{{ $messagePayload['user'] }}</h4>
                                    <p class="text-[#5A5E6B] text-[11px] truncate mt-0.5 font-medium tracking-tight">{{ $messagePayload['text'] }}</p>
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