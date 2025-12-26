<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bilancio extends Model
{
    use HasFactory;

    protected $table = 'bilanci';

    protected $fillable = [
        'year',
        'title',
        'file_path',
    ];

    protected $casts = [
        'year' => 'integer',
    ];
}
