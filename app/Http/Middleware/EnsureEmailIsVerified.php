<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\EnsureEmailIsVerified as Middleware;
use Illuminate\Http\Request;

class EnsureEmailIsVerified extends Middleware
{
    public function handle($request, \Closure $next, $redirectToRoute = null)
    {
        // Désactiver la vérification d'email
        return $next($request);
    }
} 