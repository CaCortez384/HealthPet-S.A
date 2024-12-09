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
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        // Verificar si el usuario tiene alguno de los roles permitidos
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect()->route('login')->with('error', 'No tienes permiso para acceder a esta sección.');
        }
    
        return $next($request);
    }
}
