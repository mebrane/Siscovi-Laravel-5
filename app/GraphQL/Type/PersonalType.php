<?php

namespace App\GraphQL\Type;

use App\GraphQL\traits\GraphQLTypeTrait;
use App\models\Personal;
use Carbon\Carbon;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PersonalType extends GraphQLType
{
    use GraphQLTypeTrait;
    protected $attributes = [
        'name' => 'PersonalType',
        'description' => 'A type',
        'model' => Personal::class,
    ];

    public function fields()
    {
        $cols=[
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the personal'
            ],
            'nombre' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of personal',
//                'resolve' => function ($root, $args) {
//                    return strtolower($root->name);
//                },
            ],
            'apellido' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The lastname of personal'
            ],
            'DNI' => [
                'type' => Type::string(),
                'description' => 'The DNI of personal'
            ],
            'nacimiento' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The birth date of personal'
            ],
            'edad' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The age of personal',
                'selectable' => false
            ],
            'contrato' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The contract date of personal',
            ],
            'diasContrato' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Days of contract of personal',
                'selectable' => false
            ],
            'tiempoContrato' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Time of contract of personal',
                'selectable' => false,
            ],
            'sueldo' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'The salary of personal',
            ],
            'sexo' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The gender of personal',
            ],
            'direccion' => [
                'type' => Type::string(),
                'description' => 'The address of personal',
            ],
            'telefono' => [
                'type' => Type::string(),
                'description' => 'The phone number of personal',
            ],
            'correo' => [
                'type' => Type::string(),
                'description' => 'The email of personal',
            ],
        ];
        $relations=[
            'usuario' => [

                'type' => GraphQL::type('user'),
                'description' => 'The user of personal',
//                'always'=>['username','id','usuario','created_at'],
            ],
        ];
        return $this->_fields(array_merge($cols,$relations));
    }


    protected function resolveApellidoField($root, $args)
    {
        return strtolower($root->lastName);
    }

    protected function resolveDNIField($root, $args)
    {
        return $root->DNI;
    }

    protected function resolveNacimientoField($root, $args)
    {
        return strtolower($root->birthDate);
    }

    protected function resolveContratoField($root, $args)
    {
        return strtolower($root->contractDate);
    }

    protected function resolveSueldoField($root, $args)
    {
        return $root->salary;
    }

    protected function resolveSexoField($root, $args)
    {
        return strtoupper($root->gender);
    }

    protected function resolveDireccionField($root, $args)
    {
        return strtolower($root->address);
    }

    protected function resolveTelefonoField($root, $args)
    {
        return strtolower($root->phone);
    }

//    protected function resolveCorreoField($root, $args)
//    {
//        return strtolower($root->email);
//    }

    protected function resolveEdadField($root, $args)
    {
        return Carbon::parse($root->birthDate)->age;
    }

    protected function resolveDiasContratoField($root, $args)
    {
        return Carbon::parse($root->contractDate)->diffInDays();
    }

    protected function resolveTiempoContratoField($root, $args)
    {
        return
            Carbon::parse($root->contractDate)
                ->diff(Carbon::now())
                ->format('{"y":%y,"m":%m,"d":%d}');
    }
}