<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && in_array(Auth::user()->role, ['admin', 'finance'])) {
            return $next($request);
        }
        
        return redirect()->route('dashboard')->with('error', 'Akses finance diperlukan!');
    }
}