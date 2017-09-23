<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal extends Model
{
    use SoftDeletes;
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

//    function getNombreAttribute(){
//        return $this->name;
//    }
}
