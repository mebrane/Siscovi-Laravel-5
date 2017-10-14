<?php

namespace App\models;

use App\GraphQL\traits\ModelGlobalTrait;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use ModelGlobalTrait;

    protected $table = "personals";
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
    ];

//    protected $appends;

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
        'telefono',
    ];

    protected $dates = ['deleted_at'];

    //Fixed seeder/create error
    //https://github.com/jarektkaczyk/eloquence/issues/201#issuecomment-336621519
    public function __construct($attributes=[]){
        parent::__construct($attributes);

        $this->_loadMaps();
    }
    public function usuario()
    {
        return $this->hasOne(auth\User::class, 'id');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Personal $m) {
            $m->usuario()->delete();
        });

    }
}
