<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $fillable=[
        'name',
        'department_id',
    ];

    function department(){
        return $this->belongsTo(Department::class);
    }

    function districts(){
        return $this->hasMany(District::class);
    }
}
