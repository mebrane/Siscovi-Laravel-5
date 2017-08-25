<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;
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
