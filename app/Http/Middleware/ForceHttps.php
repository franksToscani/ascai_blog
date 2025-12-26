<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    public function handle(Request $request, Closure $next): Response
    {
        // Force HTTPS in production
        if (app()->environment('production') && !$request->isSecure()) {
            return redirect(
                preg_replace('/^http:\/\//i', 'https://', $request->url()),
                301
            );
        }

        $response = $next($request);

        // Add HSTS header to force HTTPS for future requests
        if (app()->environment('production')) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains'
            );
        }

        return $response;
    }
}
