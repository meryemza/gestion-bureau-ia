<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ViewProtection
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Protection contre le clickjacking
        $response->headers->set('X-Frame-Options', 'DENY');
        
        // Protection contre le MIME-sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Protection XSS
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Politique de référent
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Politique de permissions
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
        
        // HSTS
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        
        // CSP
        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com; " .
            "style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com; " .
            "img-src 'self' data:; " .
            "font-src 'self'; " .
            "connect-src 'self'"
        );
        
        // Protection contre les politiques cross-domain
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');
        
        // Contrôle du cache
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        
        // Protection contre les attaques de type "MIME confusion"
        $response->headers->set('X-Download-Options', 'noopen');
        
        // Protection contre les attaques de type "Content Type Sniffing"
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        return $response;
    }
} 