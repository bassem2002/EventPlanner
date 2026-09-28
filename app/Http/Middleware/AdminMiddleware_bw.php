<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware pour vérifier que l'utilisateur connecté a un rôle admin
 * Utilisation: Route::middleware('admin')->group(...)
 */
class AdminMiddleware_bw
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
                ->with('error', 'Vous devez être connecté pour accéder à l\'espace administrateur.');
        }

        // Vérifier si l'utilisateur a le rôle 'admin'
        if (Auth::user()->role !== 'admin') {
            return redirect('/accueil')
                ->with('error', 'Accès refusé. L\'espace administrateur est réservé aux administrateurs uniquement.');
        }

        return $next($request);
    }
}

