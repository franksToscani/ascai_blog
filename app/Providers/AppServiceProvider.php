<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\GalleryPhoto;
use App\Models\Post;
use App\Observers\AuditObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registra AuditObserver per tracciare i cambiamenti
        Post::observe(AuditObserver::class);
        Event::observe(AuditObserver::class);
        GalleryPhoto::observe(AuditObserver::class);
    }
}
