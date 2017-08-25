<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use SoftDeletes;
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
