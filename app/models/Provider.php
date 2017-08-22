<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Company
{
    //
    function machines(){
        return $this->hasMany(Machine::class);
    }
}
