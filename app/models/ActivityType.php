<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    //
    protected $fillable=[
        'name'
    ];
    function activities(){
        return $this->hasMany(Activity::class,'type_id');
    }
}
