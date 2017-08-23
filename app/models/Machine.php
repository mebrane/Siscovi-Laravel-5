<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    //
    protected $fillable=[
        'registry',
        'name',
        'cost_per_hour',
        'brand',
        'type',
        //FK
        'provider_id'
    ];

    function provider(){
        return $this->belongsTo(Provider::class);
    }
}
