<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    function department(){
        return $this->belongsTo(Department::class);
    }

    function districts(){
        return $this->hasMany(District::class);
    }
}
