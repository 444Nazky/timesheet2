<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function clockIn(Request $request)
    {
        $request->validate([
            'location' => 'required|array',
        ]);

        $timesheet = Timesheet::create([
            'user_id' => auth()->id(),
            'clock_in' => now(),
            'ip_address' => $request->ip(),
            'location' => $request->location,
        ]);

        return response()->json(['message' => 'Clock-in successful', 'data' => $timesheet]);
    }

    public function clockOut(Request $request)
    {
        $timesheet = Timesheet::where('user_id', auth()->id())
            ->whereNull('clock_out')
            ->latest()
            ->firstOrFail();

        $timesheet->update(['clock_out' => now()]);

        return response()->json(['message' => 'Clock-out successful']);
    }
}
