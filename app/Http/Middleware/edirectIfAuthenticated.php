<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->roles->contains('name','BIBLIOTECARIO')) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('home');
        }
        return $next($request);
    }
}
