<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tract extends Model
{
    use SoftDeletes;
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
