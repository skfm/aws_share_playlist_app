<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    public function stock_folders()
    {
        return $this->belongsTo('App\StockFolder');
    }
}
