<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class SessionCookieRotation
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Rotation des cookies de session si nécessaire
        if ($this->shouldRotateSessionCookie()) {
            $this->rotateSessionCookie($response);
        }

        return $response;
    }

    protected function shouldRotateSessionCookie(): bool
    {
        // Rotation toutes les 30 minutes
        return session()->get('last_rotation', 0) < (time() - 1800);
    }

    protected function rotateSessionCookie(Response $response): void
    {
        // Générer un nouvel identifiant de session
        $newSessionId = Str::random(40);
        
        // Mettre à jour la session
        session()->put('last_rotation', time());
        
        // Créer un nouveau cookie de session
        $cookie = cookie(
            config('session.cookie'),
            $newSessionId,
            config('session.lifetime'),
            config('session.path'),
            config('session.domain'),
            config('session.secure'),
            config('session.http_only'),
            false,
            config('session.same_site')
        );

        $response->headers->setCookie($cookie);
    }
} 