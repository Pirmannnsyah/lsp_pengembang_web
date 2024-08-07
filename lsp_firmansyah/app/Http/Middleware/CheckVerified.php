<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckVerified
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_verified) {
            return redirect('not-verified');
        }

        return $next($request);
    }
}
