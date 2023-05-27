<?php

namespace Core\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $request->isMethod('OPTIONS')
            ? response('', 200)
            : $next($request);

        $response->withHeaders([
            'Access-Control-Allow-Methods'  => 'HEAD, GET, POST, PUT, PATCH, DELETE',
            'Access-Control-Allow-Headers'  => $request->header('Access-Control-Request-Headers'),
            'Access-Control-Allow-Origin'   => '*',
            'Access-Control-Expose-Headers' => 'Location'
        ]);

        return $response;
    }
}