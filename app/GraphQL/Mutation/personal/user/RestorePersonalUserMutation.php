<?php

namespace App\GraphQL\Mutation\personal\user;

use GraphQL;
use App\GraphQL\traits\GraphQLGlobalTrait;
use App\GraphQL\traits\GraphQLQueryTrait;
use App\models\auth\User;
use App\models\Personal;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class RestorePersonalUserMutation extends Mutation
{
    use GraphQLGlobalTrait;
    use GraphQLQueryTrait;
    protected $attributes = [
        'name' => 'RestorePersonalUserMutation',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('personal');
    }

    public function args()
    {
        return [
            'id' => ['type' => Type::int()],
        ];
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
        if (!$u) {
            $this->_showError("Usuario no existente o ya restaurado", 404);
        }
        $p->usuario()->restore();

        return $p->with('usuario')->first();
    }
}