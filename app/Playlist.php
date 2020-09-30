<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Playlist extends Model
{
    protected $fillable = [
        'title',
        'description',
        'url',
        'category_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Category');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'stocks')->withTimestamps();
    }

    public function stocks_id(): hasMany
    {
        return $this->hasMany('App\Stock');
    }

    public function isStockedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->stocks->where('id', $user->id)->count()
            : false;
    }

    public function getCountStocksAttribute(): int
    {
        return $this->stocks->count();
    }
}
