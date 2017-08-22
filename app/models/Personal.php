<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    //
    function users(){
        return $this->hasMany(auth\User::class);
    }
}
