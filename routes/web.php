<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TimesheetController;

Route::post('/clock-in', [TimesheetController::class, 'clockIn'])->middleware('auth');
Route::post('/clock-out', [TimesheetController::class, 'clockOut'])->middleware('auth');

Route::get('/', function () {
    return view('dashboard');
});
