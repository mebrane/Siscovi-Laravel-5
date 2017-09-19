<?php

namespace App\GraphQL\Type;

use App\models\Personal;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PersonalType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PersonalType',
        'description' => 'A type',
        'model'=>Personal::class,
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'col'=>'id',
                'description' => 'The id of the personal'
            ],
            'nombre' => [
                'type' => Type::string(),
                'description' => 'The name of personal',
                'col'=>'name',
            ],
            'apellido' => [
                'type' => Type::string(),
                'col'=>'lastName',
                'description' => 'The lastname of personal'
            ],
            'DNI' => [
                'type' => Type::string(),
                'col'=>'dni',
                'description' => 'The DNI of personal'
            ],
            'nacimiento' => [
                'type' => Type::string(),
                'col'=>'birthDate',
                'description' => 'The birth date of personal'
            ],
            'edad' => [
                'type' => Type::int(),
                'description' => 'The age of personal',
                'selectable'=>false
            ],
            'contrato' => [
                'type' => Type::string(),
                'description' => 'The contract date of personal',
                'col'=>'contractDate',
            ],
            'diasContrato' => [
                'type' => Type::int(),
                'description' => 'Days of contract of personal',
                'selectable'=>false
            ],
            'tiempoContrato' => [
                'type' => Type::string(),
                'description' => 'Time of contract of personal',
                'selectable'=>false,
            ],
            'sueldo' => [
                'type' => Type::float(),
                'description' => 'The salary of personal',
                'col'=>'salary',
            ],
            'sexo' => [
                'type' => Type::string(),
                'description' => 'The gender of personal',
                'col'=>'gender',
            ],
            'direccion' => [
                'type' => Type::string(),
                'description' => 'The address of personal',
                'col'=>'address',
            ],
            'telefono' => [
                'type' => Type::string(),
                'description' => 'The phone number of personal',
                'col'=>'phone',
            ],
            'correo' => [
                'type' => Type::string(),
                'description' => 'The email of personal',
                'col'=>'email',
            ],
        ];
    }

    protected function resolveNombreField($root, $args)
    {
        return strtolower($root->name);
    }

    protected function resolveApellidoField($root, $args)
    {
        return strtolower($root->lastName);
    }

    protected function resolveDNIField($root, $args)
    {
        return $root->dni;
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
    protected function resolveCorreoField($root, $args)
    {
        return strtolower($root->email);
    }
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