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
        if ($this->app('config')->get('app.env') === 'production' && !$request->secure()) {
            return redirect(
                preg_replace('/^http:\/\//i', 'https://', $request->url()),
                301
            );
        }

        $response = $next($request);

        // Add HSTS header to force HTTPS for future requests
        if ($this->app('config')->get('app.env') === 'production') {
            $response->header(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains'
            );
        }

        return $response;
    }

    private function app($abstract)
    {
        return app($abstract);
    }
}
