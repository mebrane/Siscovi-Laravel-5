<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //

    protected $fillable=[
        'name',
        'project',
        'begin_date',
        'end_date',
        'amount',
        'signature',
        'customer_id',
    ];

    function customer(){
        return $this->belongsTo(Customer::class);
    }
}
