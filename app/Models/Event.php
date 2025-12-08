<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

     protected $fillable = [
        'title',
        'description',
        'starts_at',
        'ends_at',
        'location',
        'is_public',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
        'is_public' => 'boolean',
        'status'    => 'string',
    ];
}
