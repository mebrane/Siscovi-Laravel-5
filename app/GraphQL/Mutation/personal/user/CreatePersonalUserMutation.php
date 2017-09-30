<?php

namespace App\GraphQL\Mutation\personal\user;

use App\models\auth\User;
use GraphQL;
use App\GraphQL\traits\GraphQLGlobalTrait;
use App\GraphQL\traits\GraphQLQueryTrait;
use App\models\Personal;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreatePersonalUserMutation extends Mutation
{
    use GraphQLGlobalTrait,
        GraphQLQueryTrait;
    protected $attributes = [
        'name' => 'CreatePersonalUserMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return Type::listOf(Type::string());
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::int()],
            'usuario' => ['type' => Type::string()],
            'clave' => ['type' => Type::string()],
        ];
    }

    protected function _rules(){
        return [];
    }

    protected function _messages(){
        return [];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $q = new Personal();

        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $q = $q->select($select)
            ->with($with);

        $p = $q->find($args['id']);

        if (!$p) {
            $this->_showError("Personal no encontrado.", 404);
        }

        $u = $p->usuario()->onlyTrashed()->first();
        if ($u) {
            $this->_showError("Usuario eliminado. ¿Desea recuperar sus datos?", 404);
        }

        $u = $p->usuario()->first();
        if ($u) {
            $this->_showError("Usuario ya existente.", 404);
        }

        $p->usuario()->create($args);



    }
}