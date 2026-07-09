<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user) {
            abort(403, 'Unauthorized');
        }

        $isAdmin = false;

        // If you later add a proper relation: User::role(), prefer that.
        if (isset($user->role) && $user->role) {
            $isAdmin = ($user->role->name ?? null) === 'admin';
        }

        // Fallback: use role_id.
        if (! $isAdmin && isset($user->role_id)) {
            $isAdmin = Role::query()->where('id', $user->role_id)->where('name', 'admin')->exists();
        }

        if (! $isAdmin) {
            if ($request->expectsJson()) {
                abort(403, 'Forbidden');
            }

            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

