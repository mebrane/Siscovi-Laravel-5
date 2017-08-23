<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $fillable=[
        'name',
        'ubigeo',
    ];

    function province(){
        return $this->belongsTo(Province::class);
    }
}
