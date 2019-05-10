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

    protected $hidden = [
        'created_at',
        'updated_at',
        'image',
    ];

    public function provider() {
        return $this->belongsTo(User::class);
    }

    public function bills() {
        return $this->belongsToMany( Bill::class);
    }
}
