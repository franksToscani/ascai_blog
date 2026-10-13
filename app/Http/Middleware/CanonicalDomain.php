<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * In produzione il sito risponde anche su *.onrender.com: senza redirect Google
 * vede due copie dello stesso sito. Reindirizza al dominio di APP_URL (es. ascai-bo.it).
 */
class CanonicalDomain
{
    public function handle(Request $request, Closure $next): Response
    {
        $canonicalHost = parse_url((string) config('app.url'), PHP_URL_HOST);

        if (
            app()->environment('production')
            && $canonicalHost
            && $request->getHost() !== $canonicalHost
            && str_ends_with($request->getHost(), '.onrender.com')
            && ! $request->is('up') // health check di Render
        ) {
            return redirect()->away(rtrim((string) config('app.url'), '/') . $request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
