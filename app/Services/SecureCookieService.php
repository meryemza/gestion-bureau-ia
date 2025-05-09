<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class SecureCookieService
{
    /**
     * Crée un cookie sécurisé
     */
    public function createSecureCookie(string $name, string $value, int $minutes = 120): \Symfony\Component\HttpFoundation\Cookie
    {
        return Cookie::make(
            $name,
            $value,
            $minutes,
            '/',
            config('app.domain'),
            true, // secure
            true, // httpOnly
            false, // raw
            'strict' // sameSite
        );
    }

    /**
     * Crée un cookie de session sécurisé
     */
    public function createSessionCookie(string $name, string $value): \Symfony\Component\HttpFoundation\Cookie
    {
        return Cookie::make(
            $name,
            $value,
            0, // expire à la fermeture du navigateur
            '/',
            config('app.domain'),
            true,
            true,
            false,
            'strict'
        );
    }

    /**
     * Supprime un cookie de manière sécurisée
     */
    public function deleteCookie(string $name): \Symfony\Component\HttpFoundation\Cookie
    {
        return Cookie::forget(
            $name,
            '/',
            config('app.domain')
        );
    }

    /**
     * Génère un token CSRF sécurisé
     */
    public function generateCsrfToken(): string
    {
        return Str::random(40);
    }

    /**
     * Vérifie la validité d'un token CSRF
     */
    public function validateCsrfToken(string $token): bool
    {
        return hash_equals(session()->token(), $token);
    }

    /**
     * Crée un cookie de session avec un identifiant unique
     */
    public function createSessionIdCookie(): \Symfony\Component\HttpFoundation\Cookie
    {
        $sessionId = Str::random(40);
        
        return $this->createSessionCookie(
            'session_id',
            $sessionId
        );
    }
} 