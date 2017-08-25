<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;
    //

    protected $fillable=[
        'name',
       // 'type',
        'description',
        'price',
        'stock',
        'brand',
        //Ext
        'unit_id',
        'type_id',
    ];

    function type(){
        return $this->belongsTo(MaterialType::class);
    }

    function unit(){
        return $this->belongsTo(Unit::class);
    }
}
