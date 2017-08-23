<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //

    protected $fillable=[
        'name',
       // 'type',
        'description',
        'price',
        'stock',
        'unit_id',
        'brand',
        //Ext
        'material_type_id',
    ];

    function type(){
        return $this->belongsTo(MaterialType::class);
    }

    function unit(){
        return $this->belongsTo(Unit::class);
    }
}
