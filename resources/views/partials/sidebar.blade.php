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
                ['label' => 'Dashboard', 'icon' => 'fa-th-large', 'route' => 'dashboard', 'active' => request()->routeIs('dashboard'), 'href' => route('dashboard'), 'badge' => null],
                ['label' => 'Projects', 'icon' => 'fa-briefcase', 'route' => 'projects', 'active' => request()->routeIs('projects'), 'href' => route('projects'), 'badge' => '12'],
                ['label' => 'My Task', 'icon' => 'fa-tasks', 'route' => 'tasks', 'active' => request()->routeIs('tasks'), 'href' => route('tasks'), 'badge' => '5'],
                ['label' => 'Calendar', 'icon' => 'fa-calendar-alt', 'route' => 'calendar', 'active' => request()->routeIs('calendar'), 'href' => route('calendar'), 'badge' => null],
                ['label' => 'Time Manage', 'icon' => 'fa-clock', 'route' => 'time-manage', 'active' => request()->routeIs('time-manage'), 'href' => route('time-manage'), 'badge' => '3'],
                ['label' => 'Reports', 'icon' => 'fa-chart-bar', 'route' => 'reports', 'active' => request()->routeIs('reports'), 'href' => route('reports'), 'badge' => null],
                ['label' => 'Settings', 'icon' => 'fa-cog', 'route' => 'settings', 'active' => request()->routeIs('settings'), 'href' => route('settings'), 'badge' => null],
            ];
        @endphp

        @foreach ($navItems as $item)
            <a href="{{ $item['href'] }}" class="nav-item flex items-center justify-between rounded-xl px-4 py-2.5 text-xs font-medium tracking-wide transition-all duration-200 {{ $item['active'] ? 'active bg-[#eceef0] text-[#1a1a1a]' : 'text-[#6a6a6a] hover:bg-[#eceef0] hover:text-[#1a1a1a]' }}">
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

