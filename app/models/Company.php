<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    const TYPES=[
        'A','B','C'
    ];
    protected $table='companies';

    protected $fillable=[
        'RUC',
        'legalName',
        'address',
        'type',
        'phone',
        'email',
        'website'
    ];


}
