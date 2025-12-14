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
        'published_at',
        'is_visible',
        'user_id',
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
}
