@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-md">
    <div class="rounded-[32px] border border-slate-200 bg-white p-8 shadow-sm">
        <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Login</h1>
        <p class="mt-2 text-sm text-slate-600">Sign in to your account and manage your timesheets.</p>

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                <input id="email" type="email" name="email" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                <input id="password" type="password" name="password" required class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200" />
            </div>

            <button type="submit" class="w-full rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">Login</button>
        </form>
    </div>
</div>
@endsection

