<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    const TYPES=[
        'A','B','C'
    ];
    protected $fillable=[
        'name',
        'description',
        'type',
    ];

    function materials(){
        return $this->hasMany(Material::class);
    }

    function activities(){
        return $this->hasMany(Activity::class);
    }
}
