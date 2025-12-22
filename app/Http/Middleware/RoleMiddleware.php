<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika role user tidak sesuai
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'ANDA TIDAK PUNYA AKSES');
        }

        return $next($request);
    }
}
