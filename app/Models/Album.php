<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'date',
        'event_id',
        'is_visible',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
        'is_visible' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function photos()
    {
        return $this->hasMany(GalleryPhoto::class);
    }

    public function visiblePhotos()
    {
        return $this->photos()
            ->where('is_visible', true)
            ->orderBy('published_at')
            ->orderBy('id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Album visibili che hanno almeno una foto visibile */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_visible', true)
            ->whereHas('photos', fn ($photos) => $photos->where('is_visible', true));
    }
}
