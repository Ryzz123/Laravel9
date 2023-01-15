<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContohMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $key, $status)
    {
        $apikey = $request->header("X-API-KEY");
        if ($apikey == $key) {
            return $next($request);
        } else {
            return response("Access Danied", $status);
        }
    }
}
