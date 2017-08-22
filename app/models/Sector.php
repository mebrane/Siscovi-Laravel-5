<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    //
    function tract(){
        return $this->belongsTo(Tract::class);
    }
}
