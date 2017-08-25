<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Company
{
    use SoftDeletes;
    //
    function machines(){
        return $this->hasMany(Machine::class);
    }
}
