<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends User
{
    public function products() {
        return $this->hasMany(Product::class);
    }
}
