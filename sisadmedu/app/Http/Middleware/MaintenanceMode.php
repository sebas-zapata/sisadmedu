<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_MAINTENANCE_MODE') === 'true') {
            abort(503, 'Estamos en mantenimiento. Vuelve más tarde.');
        }

        return $next($request);
    }
}
