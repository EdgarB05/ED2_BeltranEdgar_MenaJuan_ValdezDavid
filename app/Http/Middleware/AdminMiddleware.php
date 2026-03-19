<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('registro')
            ->with('error', 'Se debe registrar e iniciar sesión');
        }

        if(!Auth::user()->is_admin){
            return redirect()->route('hoteles.index')
            ->with('error', 'No cuentas con permisos de administrador');
        }

        if (!in_array(Auth::user()->role, $roles, true)) {
            return redirect()->route('boletos.index')
                ->with('error', 'No cuentas con permisos para acceder a esta sección.');
        }

        return $next($request);
    }
}
