<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
class EncryptCookies extends Middleware
{
    protected $except = [];
    public function handle($request, Closure $next)
    {
        return parent::handle($request, $next);
    }
}
