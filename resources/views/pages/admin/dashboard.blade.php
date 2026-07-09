@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-slate-900">Dashboard</h1>
                <p class="mt-1 text-sm text-slate-600">Welcome back, {{ Auth::user()->full_name }}! Here's your timesheet overview.</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center rounded-full bg-green-50 px-3 py-1 text-sm font-medium text-green-700">
                    <span class="mr-1.5 h-2 w-2 rounded-full bg-green-500"></span>
                    {{ now()->format('l, F j, Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Hours Card -->
        <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Total Hours</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">42.5</p>
                    <p class="mt-1 text-xs text-slate-500">This month</p>
                </div>
                <div class="rounded-full bg-blue-50 p-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">
                    ↑ 12%
                </span>
                <span class="text-xs text-slate-500">vs last month</span>
            </div>
        </div>

        <!-- Pending Entries Card -->
        <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Pending Review</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">3</p>
                    <p class="mt-1 text-xs text-slate-500">Awaiting approval</p>
                </div>
                <div class="rounded-full bg-yellow-50 p-3">
                    <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="inline-flex items-center rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-700">
                    ⚠️ Action needed
                </span>
            </div>
        </div>

        <!-- Approved Entries Card -->
        <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Approved</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">18</p>
                    <p class="mt-1 text-xs text-slate-500">Total entries</p>
                </div>
                <div class="rounded-full bg-green-50 p-3">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">
                    ✓ All approved
                </span>
            </div>
        </div>

        <!-- Projects Card -->
        <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Active Projects</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">4</p>
                    <p class="mt-1 text-xs text-slate-500">Ongoing work</p>
                </div>
                <div class="rounded-full bg-purple-50 p-3">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="inline-flex items-center rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-700">
                    📊 On track
                </span>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity Grid -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Weekly Hours Chart -->
        <div class="lg:col-span-2 rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Weekly Hours</h3>
                <select class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm text-slate-600 focus:border-blue-500 focus:outline-none">
                    <option>This Week</option>
                    <option>Last Week</option>
                    <option>This Month</option>
                </select>
            </div>
            <div class="mt-6 h-64">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900">Recent Activity</h3>
            <div class="mt-4 space-y-4">
                <!-- Activity Item 1 -->
                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="mt-1 rounded-full bg-blue-50 p-2">
                        <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-900">Logged 4 hours</p>
                        <p class="text-xs text-slate-500">Project Alpha • 2 hours ago</p>
                    </div>
                    <span class="text-xs text-slate-400">Pending</span>
                </div>

                <!-- Activity Item 2 -->
                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="mt-1 rounded-full bg-green-50 p-2">
                        <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-900">Timesheet approved</p>
                        <p class="text-xs text-slate-500">Week 27 • 5 hours ago</p>
                    </div>
                    <span class="text-xs text-green-600">Approved</span>
                </div>

                <!-- Activity Item 3 -->
                <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                    <div class="mt-1 rounded-full bg-red-50 p-2">
                        <svg class="h-4 w-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-900">Timesheet rejected</p>
                        <p class="text-xs text-slate-500">Project Beta • Yesterday</p>
                    </div>
                    <span class="text-xs text-red-600">Rejected</span>
                </div>

                <!-- Activity Item 4 -->
                <div class="flex items-start gap-3">
                    <div class="mt-1 rounded-full bg-purple-50 p-2">
                        <svg class="h-4 w-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-900">New task assigned</p>
                        <p class="text-xs text-slate-500">Project Gamma • 2 days ago</p>
                    </div>
                    <span class="text-xs text-slate-400">New</span>
                </div>
            </div>
            <button class="mt-4 w-full rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-50">
                View All Activity
            </button>
        </div>
    </div>

    <!-- Upcoming Tasks / Quick Actions -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Quick Actions -->
        <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900">Quick Actions</h3>
            <div class="mt-4 grid grid-cols-2 gap-3">
                <button class="rounded-xl border border-slate-200 p-4 text-left transition-colors hover:bg-slate-50">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <p class="mt-2 text-sm font-medium text-slate-900">Log Hours</p>
                    <p class="text-xs text-slate-500">Add timesheet entry</p>
                </button>
                <button class="rounded-xl border border-slate-200 p-4 text-left transition-colors hover:bg-slate-50">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                    </svg>
                    <p class="mt-2 text-sm font-medium text-slate-900">View Reports</p>
                    <p class="text-xs text-slate-500">Generate summary</p>
                </button>
                <button class="rounded-xl border border-slate-200 p-4 text-left transition-colors hover:bg-slate-50">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="mt-2 text-sm font-medium text-slate-900">Notifications</p>
                    <p class="text-xs text-slate-500">View updates</p>
                </button>
                <button class="rounded-xl border border-slate-200 p-4 text-left transition-colors hover:bg-slate-50">
                    <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <p class="mt-2 text-sm font-medium text-slate-900">Settings</p>
                    <p class="text-xs text-slate-500">Manage preferences</p>
                </button>
            </div>
        </div>

        <!-- Upcoming Tasks / Deadlines -->
        <div class="rounded-[24px] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Upcoming Deadlines</h3>
                <span class="rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-red-600">
                    2 tasks due soon
                </span>
            </div>
            <div class="mt-4 space-y-3">
                <div class="flex items-center justify-between rounded-lg border border-slate-100 p-3">
                    <div>
                        <p class="text-sm font-medium text-slate-900">Project Alpha Report</p>
                        <p class="text-xs text-slate-500">Due in 2 days</p>
                    </div>
                    <span class="rounded-full bg-yellow-50 px-2.5 py-0.5 text-xs font-medium text-yellow-600">In Progress</span>
                </div>
                <div class="flex items-center justify-between rounded-lg border border-slate-100 p-3">
                    <div>
                        <p class="text-sm font-medium text-slate-900">Weekly Timesheet</p>
                        <p class="text-xs text-slate-500">Due in 5 days</p>
                    </div>
                    <span class="rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-600">Pending</span>
                </div>
                <div class="flex items-center justify-between rounded-lg border border-slate-100 p-3">
                    <div>
                        <p class="text-sm font-medium text-slate-900">Project Beta Review</p>
                        <p class="text-xs text-slate-500">Due in 7 days</p>
                    </div>
                    <span class="rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-600">Upcoming</span>
                </div>
            </div>
            <button class="mt-4 w-full rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition-colors hover:bg-slate-50">
                View All Tasks
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Chart.js for the weekly hours chart
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Hours Worked',
                    data: [7.5, 6, 8, 7.5, 8, 0, 0],
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    barPercentage: 0.6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10,
                        ticks: {
                            stepSize: 2
                        },
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection