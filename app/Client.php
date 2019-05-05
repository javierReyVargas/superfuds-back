<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends User
{
    public function bills() {
        return $this->hasMany( Bill::class);
    }
}
