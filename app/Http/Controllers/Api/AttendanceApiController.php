<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AttendanceApiController extends Controller
{
    public function storeClockIn(Request $request): JsonResponse
    {
        // TODO: validate and store attendance clock-in.
        // Expected fields (based on migration):
        // - location/latitude/longitude (depending on your frontend)
        // - ip_address (optional; can use $request->ip())

        return response()->json([
            'message' => 'Clock-in API endpoint (stub)',
        ]);
    }

    public function storeClockOut(Request $request): JsonResponse
    {
        // TODO: validate and store attendance clock-out for latest open attendance record.

        return response()->json([
            'message' => 'Clock-out API endpoint (stub)',
        ]);
    }
}

