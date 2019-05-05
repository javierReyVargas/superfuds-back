<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'client_id'
    ];
}
