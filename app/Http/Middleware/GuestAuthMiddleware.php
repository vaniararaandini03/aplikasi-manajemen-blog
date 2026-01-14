<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Belum login → arahkan ke login guest
        if (!Auth::check()) {
            return redirect()->route('guest.login');
        }

        // Sudah login tapi bukan guest → tolak
        if (Auth::user()->role !== 'guest') {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
