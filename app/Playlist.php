<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Playlist extends Model
{
    protected $fillable = [
        'title',
        'description',
        'url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
