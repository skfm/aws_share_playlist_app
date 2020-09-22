<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    protected $fillable = [
        'stock_folder_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function playlist()
    {
        return $this->belongsTo('App\Playlist');
    }

    public function stock_folder()
    {
        return $this->belongsTo('App\StockFolder');
    }
}
