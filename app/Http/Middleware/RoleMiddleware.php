<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();
        if (! $user || ! $user->roles->contains('name', $role)) {
            abort(403, 'Acceso denegado. Se requiere rol: ' . $role);
        }
        return $next($request);
    }
}
