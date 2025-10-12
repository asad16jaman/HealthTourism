<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginOrRedirect
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        }

        // Set session data
        session()->flash('neetlogin', true);

        return redirect()->route('home');
    }
}
