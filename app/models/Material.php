<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    function type(){
        return $this->belongsTo(MaterialType::class);
    }
}
