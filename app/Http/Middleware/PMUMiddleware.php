<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PMUMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'PMU'])) {
            return $next($request);
        }
        
        return redirect()->route('dashboard')->with('error', 'Akses PMU diperlukan!');
    }
}