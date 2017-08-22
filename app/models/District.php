<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    function province(){
        return $this->belongsTo(Province::class);
    }
}
