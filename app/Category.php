<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function playlists(): HasMany
    {
        return $this->hasMany('App\Playlist');
    }
}
