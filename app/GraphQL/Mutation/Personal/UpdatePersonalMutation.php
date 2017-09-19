<?php

namespace App\GraphQL\Mutation\Personal;

use App\models\Personal;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL;
class UpdatePersonalMutation extends Mutation
{
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
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $personal = Personal::find($args['id']);
        if(!$personal) {
            return null;
        }

        $key='nombre';
        if(isset($args[$key])){
            $personal->name=$args[$key];
        }
        $key='apellido';
        if(isset($args[$key])){
            $personal->lastName=$args[$key];
        }

        $personal->save();

        return $personal;
    }
}