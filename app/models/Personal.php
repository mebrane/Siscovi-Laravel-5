<?php

namespace App\models;

use App\GraphQL\traits\EloquenceModelTrait;
use App\GraphQL\traits\ModelGlobalTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class Personal extends Model
{
//    use SoftDeletes;
    use Eloquence;
//    use Mappable;
    use ModelGlobalTrait;

    protected $table = "personals";
//    protected $maps;
//    protected $appends;

    function __construct($attributes = array())
    {
        parent::__construct($attributes);

        $maps = [
            'nombre' => 'name',
            'apellido' => 'lastName',
//        'DNI' => 'DNI',
            'correo' => 'email',
            'nacimiento' => 'birthDate',
            'contrato' => 'contractDate',
            'sueldo' => 'salary',
            'sexo' => 'gender',
            'direccion' => 'address',
            'telefono' => 'phone',

//            'usuario_usuario'=>'usuario.usuario',
//            'usuario_id'=>'usuario.id',
        ];
        $this->_loadMaps($maps);
    }

    protected $fillable = [
        'nombre',
        'apellido',
        'DNI',
        'correo',
        'nacimiento',
        'contrato',
        'sueldo',
        'sexo',
        'direccion',
        'telefono'
    ];


    public function usuario()
    {
        return $this->hasOne(auth\User::class, 'id');
    }

//    function getNombreAttribute(){
//        return $this->name;
//    }

    protected $dates = ['deleted_at'];

    protected static function boot() {
        parent::boot();

        static::deleting(function(Personal $m) {
            $m->usuario()->delete();
        });

//        static::restoring(function(Personal $m) {
//            $m->usuario()->restore();
//        });
    }
}
