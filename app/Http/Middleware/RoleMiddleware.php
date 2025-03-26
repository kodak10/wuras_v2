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
    public function handle(Request $request, Closure $next, $roles)
    {
        // Convertir la liste des rôles en tableau
        $roles = is_array($roles) ? $roles : explode('|', $roles);

        if (!Auth::check()) {
            abort(403, 'Non authentifié');
        }

        // Utiliser la méthode hasAnyRole de Spatie
        if (!Auth::user()->hasAnyRole($roles)) {
            abort(403, 'Accès non autorisé');
        }

        return $next($request);
    }

}
