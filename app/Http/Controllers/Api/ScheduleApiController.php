<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ScheduleApiController extends Controller
{
    /**
     * Return schedule highlights for the dashboard.
     *
     * For now this is a stub that matches the existing dashboard behaviour
     * (highlighting specific date numbers inside the calendar widget).
     */
    public function index(Request $request)
    {
        // Stub matches dashboard.blade.php events: [5, 12, 15, 20, 25, 28]
        // Keeping it auth-aware for future real integration.
        $userId = Auth::id();

        return response()->json([
            'user_id' => $userId,
            'month' => '2026-07',
            'highlights' => [5, 12, 15, 20, 25, 28],
            'legend' => [
                'deadline' => [20],
                'meeting' => [8, 15, 22, 29],
            ],
        ]);
    }
}

