<?php

namespace App\models\auth;

use App\GraphQL\traits\EloquenceModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mockery\Exception;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{

    use Notifiable;

    //https://github.com/jarektkaczyk/eloquence/issues/66#issuecomment-214501891
    use EntrustUserTrait {
        restore as private restoreA;
        EntrustUserTrait::save as entrustSave;
        Eloquence::save insteadof EntrustUserTrait;
    }

    use SoftDeletes {
        restore as private restoreB;
    }
    use Eloquence;
//    use Mappable;
    use EloquenceModelTrait;


    public function restore()
    {
        $this->restoreA();
        $this->restoreB();
    }

    protected $table="users";
    protected $maps;
    protected $appends;

    function __construct($attributes = array())
    {


        parent::__construct($attributes);

        $maps = [
            'usuario' => 'username',
            'clave' => 'password',
        ];
        $this->_loadMaps($maps);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
//        'username',
//        //'email',
//        'password',
        'usuario',
        'clave',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    function personal()
    {
        return $this->belongsTo(\App\models\Personal::class, 'id');
    }
}
