<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = auth()->user();
        // Admin selalu lolos
        if ($user && $user->role === 'admin') {
            return $next($request);
        }
        // Role lain
        if ($user && in_array($user->role, $roles)) {
            return $next($request);
        }
        
        abort(403, 'Akses ditolak.');
    }
}
