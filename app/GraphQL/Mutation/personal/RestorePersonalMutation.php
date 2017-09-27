<?php

namespace App\GraphQL\Mutation\personal;

use App\GraphQL\traits\GraphQLGlobalTrait;
use App\GraphQL\traits\GraphQLQueryTrait;
use App\models\Personal;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class RestorePersonalMutation extends Mutation
{
    use GraphQLGlobalTrait;
    use GraphQLQueryTrait;
    protected $attributes = [
        'name' => 'RestorePersonalMutation',
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
            'correo' => ['type' => Type::string()],
            'DNI' => ['type' => Type::string()],
        ];
    }

    public function resolve($root, array $args, SelectFields $fields, ResolveInfo $info)
    {
        $q = new Personal();
        $orWhere = [
            'id', 'correo', 'DNI'
        ];
        $notFoundMsg="Personal no existente o ya restaurado";

        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $q = $q->onlyTrashed()
            ->with($with)
            ->select($select);

        $q = $this->_orWhere($q, $args, $orWhere);
        $q = $q->first();

        if (!$q) {
            $this->_showError($notFoundMsg);
        }
        $q->restore();

        return $q;
    }
}