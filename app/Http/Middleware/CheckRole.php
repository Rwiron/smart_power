<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check() && in_array(Auth::user()->role->name, $roles)) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
    }
}