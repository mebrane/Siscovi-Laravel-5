<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;
    //
    protected $fillable=[
        'name',
        'ubigeo',
        'province_id',
    ];

    function province(){
        return $this->belongsTo(Province::class);
    }
}
