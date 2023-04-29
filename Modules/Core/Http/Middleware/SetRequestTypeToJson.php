<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetRequestTypeToJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept',
            'application/json');

        return $next($request);
    }
}
