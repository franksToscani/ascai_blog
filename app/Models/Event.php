<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasSlug;

class Event extends Model
{
    use SoftDeletes, HasSlug;

     protected $fillable = [
        'title',
        'slug',
        'description',
        'starts_at',
        'ends_at',
        'location',
        'is_public',
        'status',
        'user_id',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
        'is_public' => 'boolean',
        'status'    => 'string',
    ];

    /**
     * Usa lo slug come chiave di routing
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the user that owns the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
