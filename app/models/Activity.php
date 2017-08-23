<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    //
    protected $fillable=[
        'item',
        'name',
        'unit_id',
        'type_id',
    ];

    function type(){
        return $this->belongsTo(ActivityType::class);
    }

    function unit(){
        return $this->belongsTo(Unit::class);
    }

}
