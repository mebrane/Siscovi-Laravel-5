<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;
    //

    protected $fillable=[
        'name',
        'project',
        'starts_at',
        'ends_at',
        'amount',
        'signature',
        'customer_id',
    ];

    function customer(){
        return $this->belongsTo(Customer::class);
    }
}
