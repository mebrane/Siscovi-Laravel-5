<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    //
    protected $fillable=[
        'name'
    ];

    function provinces(){
        return $this->hasMany(Province::class);
    }
}
