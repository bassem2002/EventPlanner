<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware pour vérifier que l'utilisateur connecté a un rôle 'user'
 * Empêche les admins d'accéder aux routes utilisateur
 * 
 * Utilisation: Route::middleware('user')->group(...)
 */
class UserMiddleware_bw
{
    /**
     * Traiter la requête entrante
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Vérifier si l'utilisateur a le rôle 'user'
        if (Auth::user()->role !== 'user') {
            return redirect('/admin/categories')
                ->with('error', 'Accès refusé. Cette section est réservée aux utilisateurs.');
        }

        return $next($request);
    }
}
