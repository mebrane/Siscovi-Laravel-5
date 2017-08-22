<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    //
    function provider(){
        return $this->belongsTo(Provider::class);
    }
}
