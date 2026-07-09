<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(): View
    {
        // TODO: render the attendance page for the authenticated employee.
        return view('attendance');
    }

    public function clockIn(Request $request): Response|RedirectResponse|View
    {
        // TODO: implement UI action to store clock-in for the authenticated user.
        return redirect()->route('dashboard');
    }

    public function clockOut(Request $request): Response|RedirectResponse|View
    {
        // TODO: implement UI action to store clock-out for the authenticated user.
        return redirect()->route('dashboard');
    }
}

