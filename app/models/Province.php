<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;
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
