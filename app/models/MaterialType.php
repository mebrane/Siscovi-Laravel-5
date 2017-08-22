<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    //
    function materials(){
        return $this->hasMany(Material::class);
    }
}
