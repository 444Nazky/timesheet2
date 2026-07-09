@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-950 p-6 text-slate-100 space-y-6">
    
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between border-b border-slate-900 pb-6">
        <div>
            <h1 class="text-xl font-semibold tracking-tight text-white flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Console // Overview
            </h1>
            <p class="text-xs text-slate-500 mt-1">System clock sync: OK // Shift session initialized.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs font-mono bg-slate-900 border border-slate-800 px-3 py-1.5 rounded-md text-slate-400">
                IP: 127.0.0.1
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
        
        <div class="bg-slate-900 border border-slate-800/80 rounded-2xl p-5 flex flex-col justify-between relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-500/5 rounded-full blur-xl pointer-events-none"></div>
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono uppercase tracking-wider text-cyan-400 font-semibold bg-cyan-500/10 px-2 py-0.5 rounded">Active Core</span>
                    <span class="text-xs text-slate-500 font-mono">ID: #4092</span>
                </div>
                <h3 class="text-base font-medium text-slate-200 mt-4">Database Migration & Config</h3>
                <p class="text-xs text-slate-500 font-mono mt-1">> project_alpha / backend</p>
            </div>
            <div class="mt-8">
                <div class="text-3xl font-mono font-bold tracking-tight text-white mb-2">03:41:12</div>
                <div class="text-[11px] font-mono text-slate-400 flex items-center gap-1.5 bg-slate-950 border border-slate-800 px-2.5 py-1.5 rounded-lg">
                    <span class="h-1.5 w-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                    Recording telemetry stream...
                </div>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800/80 rounded-2xl p-5 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-mono text-slate-400 uppercase tracking-wider">Productivity Yield</span>
                <span class="text-emerald-400 text-xs font-mono bg-emerald-500/10 px-1.5 py-0.5 rounded">↑ 4.1%</span>
            </div>
            <div class="my-auto pt-4">
                <div class="text-4xl font-mono font-bold text-white tracking-tight">94.2%</div>
                <p class="text-xs text-slate-500 mt-1">Focus block alignment vs baseline capacity.</p>
            </div>
            <div class="w-full bg-slate-800 h-1 rounded-full overflow-hidden mt-4">
                <div class="bg-gradient-to-r from-indigo-500 to-cyan-400 h-full rounded-full" style="width: 94.2%"></div>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800/80 rounded-2xl p-5 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-mono text-slate-400 uppercase tracking-wider">Billable Vol</span>
                <span class="text-slate-500 text-xs font-mono">Target: 40h</span>
            </div>
            <div class="my-auto pt-4">
                <div class="text-4xl font-mono font-bold text-white tracking-tight">34.5<span class="text-lg text-slate-500 font-sans">h</span></div>
                <p class="text-xs text-slate-500 mt-1">8.5h allocated to core R&D accounts.</p>
            </div>
            <div class="flex gap-1.5 mt-4">
                <span class="h-1.5 flex-1 bg-indigo-500 rounded-full"></span>
                <span class="h-1.5 flex-1 bg-indigo-500 rounded-full"></span>
                <span class="h-1.5 flex-1 bg-indigo-500 rounded-full"></span>
                <span class="h-1.5 flex-1 bg-indigo-500 rounded-full"></span>
                <span class="h-1.5 flex-1 bg-slate-800 rounded-full"></span>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800/80 rounded-2xl p-5 flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-mono text-slate-400 uppercase tracking-wider">Active Scopes</span>
                <span class="text-indigo-400 text-xs font-mono bg-indigo-500/10 px-1.5 py-0.5 rounded">5 Total</span>
            </div>
            <div class="mt-4 space-y-2 text-sm font-mono">
                <div>
                    / code_alpha <span class="text-xs text-slate-500 float-right">18.2h</span>
                    <div class="w-full bg-slate-800 h-1 rounded-full mt-1">
                        <div class="bg-indigo-500 h-1 rounded-full" style="width: 65%"></div>
                    </div>
                </div>
                <div>
                    / system_ops <span class="text-xs text-slate-500 float-right">12.0h</span>
                    <div class="w-full bg-slate-800 h-1 rounded-full mt-1">
                        <div class="bg-cyan-500 h-1 rounded-full" style="width: 40%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800/80 rounded-2xl p-6 md:col-span-2 lg:col-span-3">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">
                <div>
                    <h3 class="text-base font-semibold text-white">Velocity Spectrum</h3>
                    <p class="text-xs text-slate-500">Telemetry tracking peak productivity curves across schedules.</p>
                </div>
                <div class="flex bg-slate-950 p-1 rounded-lg border border-slate-800 text-xs font-mono">
                    <span class="bg-slate-900 text-white px-3 py-1 rounded-md border border-slate-800">Telemetry</span>
                </div>
            </div>
            <div class="h-64 w-full">
                <canvas id="velocityChart"></canvas>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800/80 rounded-2xl p-6 flex flex-col justify-between">
            <div>
                <h3 class="text-base font-semibold text-white">Distribution</h3>
                <p class="text-xs text-slate-500 mb-4">Time vector categorization.</p>
                <div class="h-44 w-full relative flex items-center justify-center">
                    <canvas id="distributionChart"></canvas>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2 text-xs font-mono mt-4 pt-4 border-t border-slate-800">
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                    <span class="text-slate-400">Dev Core</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-cyan-400"></span>
                    <span class="text-slate-400">SysOps</span>
                </div>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800/80 rounded-2xl p-6 md:col-span-3 lg:col-span-4">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-semibold text-white">Commit Matrix</h3>
                    <p class="text-xs text-slate-500">Density visual of time logs captured over past sprint interval blocks.</p>
                </div>
                <span class="text-xs font-mono text-slate-500">Total: 142.5 hrs logged</span>
            </div>
            
            <div class="overflow-x-auto">
                <div class="min-w-[640px] flex gap-1 flex-wrap">
                    @for ($i = 0; $i < 70; $i++)
                        @php
                            $intensities = ['bg-slate-950 border border-slate-900', 'bg-indigo-950/40 border border-indigo-900/40', 'bg-indigo-900/60', 'bg-indigo-700/80', 'bg-cyan-500'];
                            $randomIntensity = $intensities[array_rand($intensities)];
                        @endphp
                        <div class="h-4 w-4 rounded-sm transition-all {{ $randomIntensity }}" title="Day {{ $i }}"></div>
                    @endfor
                </div>
            </div>
            <div class="flex justify-end gap-2 items-center text-[10px] font-mono text-slate-500 mt-3">
                <span>Less</span>
                <div class="h-2 w-2 rounded-sm bg-slate-950 border border-slate-900"></div>
                <div class="h-2 w-2 rounded-sm bg-indigo-950/40"></div>
                <div class="h-2 w-2 rounded-sm bg-indigo-700/80"></div>
                <div class="h-2 w-2 rounded-sm bg-cyan-500"></div>
                <span>More</span>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Line Chart Configuration
        const vCtx = document.getElementById('velocityChart').getContext('2d');
        const vGradient = vCtx.createLinearGradient(0, 0, 0, 240);
        vGradient.addColorStop(0, 'rgba(99, 102, 241, 0.25)');
        vGradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

        new Chart(vCtx, {
            type: 'line',
            data: {
                labels: ['02/10', '02/11', '02/12', '02/13', '02/14', '02/15', '02/16'],
                datasets: [{
                    label: 'Burst Metric',
                    data: [6.2, 7.8, 4.5, 9.0, 8.2, 2.0, 4.0],
                    borderColor: '#818cf8',
                    backgroundColor: vGradient,
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#22d3ee',
                    pointHoverBorderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: '#64748b', font: { family: 'monospace', size: 10 } } },
                    y: { 
                        grid: { color: '#1e293b' }, 
                        ticks: { color: '#64748b', font: { family: 'monospace', size: 10 } }
                    }
                }
            }
        });

        // Doughnut Chart Configuration
        const dCtx = document.getElementById('distributionChart').getContext('2d');
        new Chart(dCtx, {
            type: 'doughnut',
            data: {
                labels: ['Dev', 'SysOps'],
                datasets: [{
                    data: [70, 30],
                    backgroundColor: ['#6366f1', '#22d3ee'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '80%',
                plugins: { legend: { display: false } }
            }
        });
    });
</script>
@endpush
@endsection