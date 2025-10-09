<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware 
{
    public function handle($request, Closure $next)
    {
         if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'keuangan')) {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Hanya admin atau keuangan yang dapat mengakses halaman ini.');
    }
}
