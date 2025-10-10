<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $nombreRol = $user->rol->nombre ?? null;

        if (!$nombreRol) {
            abort(403, 'El usuario no tiene un rol asignado.');
        }

        $roles = array_map('strtolower', $roles);
        $nombreRol = strtolower($nombreRol);

        if (!in_array($nombreRol, $roles)) {
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
