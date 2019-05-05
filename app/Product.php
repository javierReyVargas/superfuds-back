<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
      'name',
      'provider_id',
      'name',
      'quantity',
      'price',
      'numLot',
      'expirationDate',
      'description',
      'image',
    ];
}
