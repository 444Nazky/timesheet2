<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\Web\Admin\AdminDashboardController;
use App\Http\Controllers\Web\User\AttendanceController;

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// --------------------
// Guest routes
// --------------------
Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::middleware('guest')->group(function () {
    Route::post('/login', function (Request $request) {
        // Temporary login stub for development.
        // Any email/password will authenticate the first user in DB.
        // Replace with real auth validation later.
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = \App\Models\User::query()->orderBy('id')->first();

        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'No users found in database.']);
    });

    Route::get('/forgot-password', function () {
        // TODO: implement forgot password view/controller.
        return response()->json(['message' => 'Forgot password page (stub)'], 501);
    })->name('password.forgot');
});

// --------------------
// User panel routes
// --------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/projects', function () {
    return view('pages.projects');
})->name('projects');


Route::middleware('auth')->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

    // For now, keep the existing implementation.
    Route::post('/clock-in', [TimesheetController::class, 'clockIn'])->name('attendance.clockIn');
    Route::post('/clock-out', [TimesheetController::class, 'clockOut'])->name('attendance.clockOut');

    Route::get('/history', function () {
        // TODO: render attendance history for the authenticated user.
        return view('pages.history');
    })->name('attendance.history');

    Route::get('/leave-request', function () {
        // TODO: implement leave request.
        return response()->json(['message' => 'Leave request page (stub)'], 501);
    })->name('leave.request');

    Route::get('/profile', function () {
        // TODO: implement user profile.
        return response()->json(['message' => 'Profile page (stub)'], 501);
    })->name('profile');

    Route::get('/reports', function () {
        return view('pages.reports');
    })->name('reports');

    // --------------------
    // Admin panel routes
    // --------------------
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/employees', function () {
            // TODO: admin employees listing.
            return response()->json(['message' => 'Admin employees (stub)'], 501);
        })->name('admin.employees');

        Route::get('/timesheets', function () {
            // TODO: admin timesheets management.
            return response()->json(['message' => 'Admin timesheets (stub)'], 501);
        })->name('admin.timesheets');

        Route::get('/approvals', function () {
            // TODO: admin approvals.
            return response()->json(['message' => 'Admin approvals (stub)'], 501);
        })->name('admin.approvals');

        Route::get('/reports', function () {
            // TODO: admin reports.
            return response()->json(['message' => 'Admin reports (stub)'], 501);
        })->name('admin.reports');
    });
});

