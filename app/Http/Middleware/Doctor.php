<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Doctor
{
    public function handle(Request $request, Closure $next): RedirectResponse
    {
        if (Auth::guard('doctors')->check()) {
            return $next($request);
        }

        return redirect(route('dashboard'));
    }
}
