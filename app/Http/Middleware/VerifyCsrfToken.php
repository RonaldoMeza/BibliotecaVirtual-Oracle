<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Session\TokenMismatchException;
class VerifyCsrfToken
{
    public function handle($request, Closure $next)
    {
        if (in_array($request->method(), ['POST','PUT','DELETE']) &&
            $request->input('_token') !== $request->session()->token()) {
            throw new TokenMismatchException;
        }
        return $next($request);
    }
}
