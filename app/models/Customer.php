<?php

namespace App\models;

class Customer extends Company
{
    //
    function contracts(){
        return $this->hasMany(Contract::class);
    }
}
