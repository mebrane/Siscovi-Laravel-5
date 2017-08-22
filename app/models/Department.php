<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    function provinces(){
        return $this->hasMany(Province::class);
    }
}
