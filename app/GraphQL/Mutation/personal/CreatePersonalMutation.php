<?php

namespace App\GraphQL\Mutation\personal;

use App\GraphQL\GraphQLTrait;
use App\GraphQL\traits\GraphQLMutationTrait;
use App\GraphQL\Type\PersonalType;
use App\models\Personal;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;


class CreatePersonalMutation extends Mutation
{
//    use GraphQL\Validator;
    use GraphQLTrait;
    use GraphQLMutationTrait;
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
            'direccion' => ['type' => Type::string()],
            'telefono' => ['type' => Type::string()],
        ];
    }

    private function _rules()
    {
        return [
            'direccion'=>'required',
            'nombre'=>'required',
            'correo'=>'required|email|unique:personals,email',
            'DNI'=>'required|digits:8|unique:personals,DNI'
        ];
    }

    private function _messages()
    {
        return [
            'correo.unique'=>'El correo ya está en uso',
            'DNI.unique'=>'El DNI ya está en uso',
//            'DNI.numeric'=>'El DNI debe contener solo números',
            'DNI.digits'=>'El DNI debe ser numérico y tener :digits dígitos'
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $this->_validate($args);

        $m= new Personal();
        $personal=$m->create($this->_argsToColumns($args,new PersonalType()));
        return $personal;
    }
}