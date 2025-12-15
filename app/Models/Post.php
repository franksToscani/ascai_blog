<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasSlug;

class Post extends Model
{
    use SoftDeletes, HasSlug;

    protected $fillable = [
        'title', 
        'slug',
        'content',
        'cover_image',
        'youtube_url',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Usa lo slug come chiave di routing
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
