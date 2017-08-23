<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    //
    protected $fillable=[
        'name',
        'lastName',
        'DNI',
        'birthDate',
        'contractDate',
        'salary',
        'gender',
        'address',
        'phone',
        'email',
    ];
    function user(){
        return $this->hasOne(auth\User::class,'id');
    }
}
