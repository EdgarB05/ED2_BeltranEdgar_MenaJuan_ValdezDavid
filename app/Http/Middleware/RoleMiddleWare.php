<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('acceso')
                ->with('error', 'Debes iniciar sesión para acceder.');
        }

        if (!in_array(Auth::user()->role, $roles, true)) {
            return redirect()->route('boletos.index')
                ->with('error', 'No cuentas con permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
