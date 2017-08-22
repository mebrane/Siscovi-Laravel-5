<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Tract extends Model
{
    //
    function district(){
        return $this->belongsTo(District::class);
    }

    function sectors(){
        return $this->hasMany(Sector::class);
    }
}
