<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Boot the trait - aggiunge listener all'evento 'saving'
     */
    public static function bootHasSlug(): void
    {
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateSlug($model->title);
            }
        });
    }

    /**
     * Genera uno slug unico basato sul titolo
     */
    protected static function generateSlug(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Verifica unicità dello slug
        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
