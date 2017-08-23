<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    //
    protected $fillable=[
        'name',
        //FK
        'tract_id'
    ];
    function tract(){
        return $this->belongsTo(Tract::class);
    }
}
