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
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_visible'   => 'boolean',
    ];
}
