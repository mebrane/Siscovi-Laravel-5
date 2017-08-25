<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
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
