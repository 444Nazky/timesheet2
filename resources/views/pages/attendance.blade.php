@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Attendance</h2>
    <p>Clock-in/out UI placeholder.</p>

    <form method="POST" action="{{ route('attendance.clockIn') }}">
        @csrf
        <button class="btn btn-success" type="submit">Clock In (stub)</button>
    </form>

    <form method="POST" action="{{ route('attendance.clockOut') }}" class="mt-2">
        @csrf
        <button class="btn btn-warning" type="submit">Clock Out (stub)</button>
    </form>
</div>
@endsection

