<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Tract extends Model
{
    //
    protected $fillable=[
        'name',
        'highway',
        'start_km',
        'end_km',
        //FK
        'district_id',
    ];
    function district(){
        return $this->belongsTo(District::class);
    }

    function sectors(){
        return $this->hasMany(Sector::class);
    }
}
