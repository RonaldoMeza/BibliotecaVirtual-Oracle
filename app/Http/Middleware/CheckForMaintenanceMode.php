<?php
namespace App\Http\Middleware;
use Closure;
class CheckForMaintenanceMode
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
