<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
       header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
        header('Access-Control-Allow-Credentials: true');

        if (!$request->isMethod('options')) {
            return $next($request);
        }
    }
}
