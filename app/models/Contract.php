<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    function customer(){
        return $this->belongsTo(Customer::class);
    }
}
