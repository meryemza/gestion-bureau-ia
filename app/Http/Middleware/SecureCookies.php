<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureCookies
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Configuration des cookies de session
        config([
            'session.secure' => true,
            'session.http_only' => true,
            'session.same_site' => 'strict',
            'session.path' => '/',
            'session.domain' => config('app.domain'),
            'session.lifetime' => 120, // 2 heures
            'session.expire_on_close' => false,
        ]);

        // Configuration des cookies de l'application
        $cookies = $response->headers->getCookies();
        foreach ($cookies as $cookie) {
            $cookie->setSecure(true);
            $cookie->setHttpOnly(true);
            $cookie->setSameSite('strict');
            $cookie->setPath('/');
            $cookie->setDomain(config('app.domain'));
        }

        return $response;
    }
} 