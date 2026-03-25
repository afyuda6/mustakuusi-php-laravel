<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Screenshot extends Model
{
    protected $casts = [
        'id' => 'string',
        'game_id' => 'string',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
