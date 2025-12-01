<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Con type hint para el editor
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        
        // 1. Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Verificar si tiene rol de admin
        if ($user->rol !== 'admin') {
            abort(403, 'No tienes permisos de administrador.');
        }

        return $next($request);
    }
}
