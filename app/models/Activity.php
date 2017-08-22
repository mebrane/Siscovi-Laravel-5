<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    function type(){
        return $this->belongsTo(ActivityType::class);
    }

}
