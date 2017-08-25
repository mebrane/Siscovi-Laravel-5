<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use SoftDeletes;
    //
    const TYPES=[
        'A','B','C',
    ];

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
