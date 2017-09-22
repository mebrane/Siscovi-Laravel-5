<?php

namespace App\GraphQL\Mutation\personal;

use App\GraphQL\traits\GraphQLMutationTrait;
use App\GraphQL\Type\PersonalType;
use App\models\Personal;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL;
class UpdatePersonalMutation extends Mutation
{
    use GraphQLMutationTrait;
    protected $attributes = [
        'name' => 'UpdatePersonalMutation',
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
            'id' => ['type' => Type::nonNull(Type::int())],
            'nombre' => ['type' =>Type::string()],
            'apellido' => ['type' =>Type::string()],
            'correo' => ['type' =>Type::string()],
            'DNI' => ['type' =>Type::string()],
            'sueldo' => ['type' =>Type::float()],
            'contrato' => ['type' =>Type::string()],
            'nacimiento' => ['type' =>Type::string()],
            'sexo' => ['type' =>Type::string()],
            'direccion' => ['type' =>Type::string()],
            'telefono' => ['type' =>Type::string()],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $personal = Personal::find($args['id']);
        if(!$personal) {
            throw new \Exception("Personal no existe");
        }
//        $args=$this->_argsToColumns($args,new PersonalType());

//        $keys=[
//            'nombre',
//            'apellido',
//            'correo',
//            'DNI',
//            'sueldo',
//            'contrato',
//            'nacimiento',
//            'sexo',
//            'direccion',
//            'telefono',
//        ];
        $keys=array_keys($this->args());
        $personal=$this->_fillOnUpdate($personal,$keys,$args,new PersonalType());


        if (!$personal->isDirty()) {
            $this->_showError('Se debe especificar al menos un valor diferente para actualizar',422);
        }
        $personal->save();

        return $personal;
    }
}