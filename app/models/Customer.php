<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Company
{
    //
    function contracts(){
        return $this->hasMany(Contract::class);
    }
}
