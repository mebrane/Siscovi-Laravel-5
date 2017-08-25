<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
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
