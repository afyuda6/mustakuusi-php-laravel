<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'release_date' => 'datetime',
    ];

    public function screenshots(): HasMany
    {
        return $this->hasMany(Screenshot::class, 'game_id', 'id');
    }

    public function gameCharacters(): HasMany
    {
        return $this->hasMany(GameCharacter::class, 'game_id', 'id');
    }

    public function getCategoriesAttribute($value)
    {
        if ($value === null) return [];

        $array = explode(',', trim($value, '{}'));

        return array_map(fn($item) => trim($item, '"'), $array);
    }
}
