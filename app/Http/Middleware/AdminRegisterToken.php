<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRegisterToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $routeToken  = $request->route('token');
        $configToken = config('app.admin_register_token', env('ADMIN_REGISTER_TOKEN', ''));

        if (empty($configToken) || $routeToken !== $configToken) {
            abort(404);
        }

        return $next($request);
    }
}
