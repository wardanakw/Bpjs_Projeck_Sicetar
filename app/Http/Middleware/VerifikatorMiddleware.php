<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikatorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'verifikator'])) {
            return $next($request);
        }
        
        return redirect()->route('dashboard')->with('error', 'Akses verifikator diperlukan!');
    }
}