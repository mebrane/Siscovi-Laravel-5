<?php

namespace App\models;

use App\GraphQL\traits\EloquenceModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class Personal extends Model
{
    use SoftDeletes, Eloquence, Mappable;
    use EloquenceModelTrait;

    protected $table = "personals";
    protected $maps;
    protected $appends;

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


    function usuario()
    {
        return $this->hasOne(auth\User::class, 'id');
    }

//    function getNombreAttribute(){
//        return $this->name;
//    }
}
