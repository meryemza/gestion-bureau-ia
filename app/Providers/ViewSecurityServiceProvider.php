<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class ViewSecurityServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Protection contre les attaques XSS dans les vues Blade
        Blade::directive('secure', function ($expression) {
            return "<?php echo e($expression); ?>";
        });

        // Protection contre les attaques CSRF
        View::share('csrf_token', csrf_token());

        // Protection contre les attaques de type "Clickjacking"
        View::share('frame_options', 'DENY');

        // Protection contre les attaques de type "MIME Sniffing"
        View::share('content_type_options', 'nosniff');

        // Protection contre les attaques XSS
        View::share('xss_protection', '1; mode=block');

        // Protection contre les attaques de type "Referrer Policy"
        View::share('referrer_policy', 'strict-origin-when-cross-origin');

        // Protection contre les attaques de type "Permissions Policy"
        View::share('permissions_policy', 'geolocation=(), microphone=(), camera=()');

        // Protection contre les attaques de type "HSTS"
        View::share('hsts', 'max-age=31536000; includeSubDomains');

        // Protection contre les attaques de type "Content Security Policy"
        View::share('csp', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com; style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com; img-src 'self' data:; font-src 'self'; connect-src 'self'");

        // Protection contre les attaques de type "Cross Domain Policy"
        View::share('cross_domain_policy', 'none');

        // Protection contre les attaques de type "Cache Control"
        View::share('cache_control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}