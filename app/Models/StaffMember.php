<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StaffMember extends Model
{
    public const GROUPS = [
        'direttivo' => 'Consiglio direttivo',
        'collaboratori' => 'Collaboratori e comitati',
    ];

    protected $fillable = [
        'group',
        'role',
        'name',
        'description',
        'photo_path',
        'position',
    ];

    public function scopeInGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group)->orderBy('position')->orderBy('id');
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo_path ? asset('storage/' . $this->photo_path) : null;
    }
}
