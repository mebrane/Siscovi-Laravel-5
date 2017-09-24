<?php

namespace App\models;

use function foo\func;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class Personal extends Model
{
    use SoftDeletes, Eloquence, Mappable;
    //
//    protected $maps = [];

//    function __construct($attributes = array())
//    {
//        parent::__construct($attributes);
//
//        $attr = [
//            'nombre' => 'name',
//            'apellido' => 'lastName',
////            'DNI' => 'DNI',
//            'correo' => 'email',
//            'nacimiento' => 'birthDate',
//            'contrato' => 'contractDate',
//            'sueldo' => 'salary',
//            'sexo' => 'gender',
//            'direccion' => 'address',
//            'telefono' => 'phone',
//        ];
//        $this->maps = array_merge($attr, [
//            'creado' => 'created_at',
//            'actualizado' => 'updated_at',
//            'eliminado' => 'deleted_at',
//        ]);
//        $this->fillable = array_keys($attr);
//        $this->appends = array_keys($this->maps);
//        $this->hidden = array_keys(array_flip($this->maps));
//    }



//
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
    protected $maps = [
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

        'creado' => 'created_at',
        'actualizado' => 'updated_at',
        'eliminado' => 'deleted_at',
    ];
//
//    protected $hidden = [
//    ];
    protected $appends =[
        'nombre',
        'apellido',
        'DNI',
        'correo',
        'nacimiento',
        'contrato',
        'sueldo',
        'sexo',
        'direccion',
        'telefono',
        'creado',
        'actualizado',
        'eliminado'
    ];


    function user()
    {
        return $this->hasOne(auth\User::class, 'id');
    }

//    function getNombreAttribute(){
//        return $this->name;
//    }
}
