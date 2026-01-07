<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // 🔐 JIKA GUEST → KE LOGIN
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 🔐 JIKA SUDAH LOGIN TAPI ROLE SALAH
        if (auth()->user()->role !== $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
