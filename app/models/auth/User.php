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
//    use EloquenceModelTrait;
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
    use Mappable;



    public function restore()
    {
        $this->restoreA();
        $this->restoreB();
    }

    protected $table="users";
    protected $maps=[
        'usuario' => 'username',
        'clave' => 'password',
    ];
//    protected $appends;

    function __construct($attributes = array())
    {


        parent::__construct($attributes);

        $this->_loadMaps();
    }

    protected $_dateMaps = [
        'creado' => 'created_at',
        'actualizado' => 'updated_at',
        'eliminado' => 'deleted_at',
    ];

    protected function _loadMaps()
    {
        $maps = array_merge($this->maps, $this->_dateMaps);
        $tbmaps = [];
        foreach ($maps as $key => $map) {
            $tbmaps["$this->table." . $key] = $map;
        }

        $this->maps = array_merge($maps, $tbmaps);
//        $this->appends = array_keys($maps);
//        $this->fillable = array_merge($this->fillable,array_keys($maps));
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
