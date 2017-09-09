<?php

namespace App\GraphQL\Type;

use App\models\Personal;
use Carbon\Carbon;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class PersonalType extends BaseType
{
    protected $attributes = [
        'name' => 'PersonalType',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the personal'
            ],
            'nombre' => [
                'type' => Type::string(),
                'description' => 'The name of personal'
            ],
            'apellido' => [
                'type' => Type::string(),
                'description' => 'The lastname of personal'
            ],
            'DNI' => [
                'type' => Type::string(),
                'description' => 'The DNI of personal'
            ],
            'nacimiento' => [
                'type' => Type::string(),
                'description' => 'The birth date of personal'
            ],
            'edad' => [
                'type' => Type::int(),
                'description' => 'The age of personal'
            ],
            'contrato' => [
                'type' => Type::string(),
                'description' => 'The contract date of personal'
            ],
            'diasContrato' => [
                'type' => Type::int(),
                'description' => 'Days of contract of personal'
            ],
            'tiempoContrato' => [
                'type' => Type::string(),
                'description' => 'Time of contract of personal'
            ],
            'sueldo' => [
                'type' => Type::float(),
                'description' => 'The salary of personal'
            ],
            'sexo' => [
                'type' => Type::string(),
                'description' => 'The gender of personal'
            ],
            'direccion' => [
                'type' => Type::string(),
                'description' => 'The address of personal'
            ],
            'telefono' => [
                'type' => Type::string(),
                'description' => 'The phone number of personal'
            ],
            'correo' => [
                'type' => Type::string(),
                'description' => 'The email of personal'
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
        return strtolower($root->DNI);
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
