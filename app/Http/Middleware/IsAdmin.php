<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est connecté et s'il a le rôle 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // Si c'est un admin, on continue la requête
        }

        // Sinon, rediriger vers la page d'accueil ou autre page
        return redirect('/');
    }
}

