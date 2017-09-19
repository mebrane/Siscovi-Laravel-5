<?php

namespace App\GraphQL\Mutation\Personal;

use App\GraphQL\GraphQLTrait;
use App\GraphQL\Type\PersonalType;
use App\models\Personal;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreatePersonalMutation extends Mutation
{
    use GraphQLTrait;
    protected $attributes = [
        'name' => 'CreatePersonalMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
//        return Type::listOf(Type::string());
        return GraphQL::type('personal');
    }

    public function args()
    {
        return [
            'nombre' => ['type' => Type::nonNull(Type::string())],
            'apellido' => ['type' => Type::nonNull(Type::string())],
            'correo' => ['type' => Type::nonNull(Type::string())],
            'DNI' => ['type' => Type::nonNull(Type::string())],
            'nacimiento' => ['type' => Type::nonNull(Type::string())],
            'contrato' => ['type' => Type::nonNull(Type::string())],
            'sueldo' => ['type' => Type::nonNull(Type::float())],
            'sexo' => ['type' => Type::nonNull(Type::string())],
            'direccion' => ['type' => Type::nonNull(Type::string())],
            'telefono' => ['type' => Type::nonNull(Type::string())],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $m= new Personal();
        $personal=$m->create($this->_getArgs($args,new PersonalType()));
        return $personal;
    }
}