<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockFolder extends Model
{
    protected $fillable = [
        'name',
    ];
    public function stock()
    {
        return $this->hasMany('App\Stock');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
