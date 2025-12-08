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
        'status',
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
}
