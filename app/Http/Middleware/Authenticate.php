<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : $this->returnUnauthenticated();
    }

    /**
     * Returns "Unauthenticated" message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function returnUnauthenticated()
    {
        // TODO: Throw error or output a JSON with 'message'
        dd('Unauthenticated');
    }
}
