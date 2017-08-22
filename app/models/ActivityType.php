<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    //
    function activities(){
        return $this->hasMany(Activity::class);
    }
}
