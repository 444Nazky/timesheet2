<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AttendanceApiController;
use App\Http\Controllers\Api\ScheduleApiController;


Route::prefix('auth')->group(function () {
    // Auth endpoints (stubs for future API auth integration, e.g. Sanctum/JWT)
    Route::post('/login', function (Request $request) {
        return response()->json([
            'message' => 'API login endpoint (stub)'
        ], 501);
    });
});

Route::prefix('attendance')->group(function () {
    Route::post('/clock-in', [AttendanceApiController::class, 'storeClockIn'])
        ->middleware('auth:sanctum');

    Route::post('/clock-out', [AttendanceApiController::class, 'storeClockOut'])
        ->middleware('auth:sanctum');

    // History tracking route (stub response handled by controller if/when implemented)
    Route::get('/history', function () {
        return response()->json([
            'message' => 'Attendance history endpoint (not implemented in this skeleton)'
        ], 501);
    })->middleware('auth:sanctum');
});

Route::prefix('app')->group(function () {
    Route::get('/schedule', [ScheduleApiController::class, 'index']);
});




