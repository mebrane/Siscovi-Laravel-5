<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityType extends Model
{
    use SoftDeletes;
    //
    protected $fillable=[
        'name'
    ];
    function activities(){
        return $this->hasMany(Activity::class,'type_id');
    }
}
