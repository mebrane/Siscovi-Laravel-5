<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    //
    protected $fillable=[
        'name'
    ];
    function materials(){
        return $this->hasMany(Material::class);
    }
}
