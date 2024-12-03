<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Verificar si el usuario tiene el rol especificado
        if (Auth::user()->role !== $role) {
            return redirect()->route('login')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
