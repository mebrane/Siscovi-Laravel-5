<?php

namespace App\models\auth;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //
    protected $fillable = [
        'name', 'display_name', 'description',
    ];
}
