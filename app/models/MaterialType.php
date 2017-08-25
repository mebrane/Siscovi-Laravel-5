<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialType extends Model
{
    use SoftDeletes;
    //
    protected $fillable=[
        'name'
    ];
    function materials(){
        return $this->hasMany(Material::class,'type_id');
    }
}
