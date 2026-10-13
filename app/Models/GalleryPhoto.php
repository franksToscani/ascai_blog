<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryPhoto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'caption',
        'image_path',
        'thumb_path',
        'published_at',
        'is_visible',
        'user_id',
        'album_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_visible'   => 'boolean',
    ];

    /**
     * Get the user that owns the photo.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    /** URL della foto a piena risoluzione (max 2000px) */
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }

    /** URL della miniatura leggera per le griglie; ripiega sulla foto intera se manca */
    public function getThumbUrlAttribute(): string
    {
        return asset('storage/' . ($this->thumb_path ?: $this->image_path));
    }
}
