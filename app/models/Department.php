<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable=[
        'name'
    ];

    function provinces(){
        return $this->hasMany(Province::class);
    }
}
