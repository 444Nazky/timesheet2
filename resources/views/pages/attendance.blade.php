@extends('layouts.app')

@section('content')
<div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-semibold text-slate-900">Attendance</h1>
            <p class="mt-1 text-sm text-slate-600">Clock in and out with a single click.</p>
        </div>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-2">
        <form method="POST" action="{{ route('attendance.clockIn') }}" class="rounded-3xl border border-slate-200 bg-slate-950 p-6 text-white shadow-sm">
            @csrf
            <input type="hidden" name="location[office]" value="headquarters">
            <button class="w-full rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-100" type="submit">Clock In</button>
        </form>

        <form method="POST" action="{{ route('attendance.clockOut') }}" class="rounded-3xl border border-slate-200 bg-slate-950 p-6 text-white shadow-sm">
            @csrf
            <button class="w-full rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-950 transition hover:bg-slate-100" type="submit">Clock Out</button>
        </form>
    </div>
</div>
@endsection

