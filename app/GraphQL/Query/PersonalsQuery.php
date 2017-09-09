<?php

namespace App\GraphQL\Query;

use App\models\Personal;
use Carbon\Carbon;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Illuminate\Support\Facades\DB;

class PersonalsQuery extends Query
{
    protected $attributes = [
        'name' => 'PersonalsQuery',
        'description' => 'A query'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Personal'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
            'nombre' => ['name' => 'nombre', 'type' => Type::string()],
            'edad' => ['name' => 'edad', 'type' => Type::int()],
            'edadEntre' => ['name' => 'edadEntre', 'type' => Type::listOf(Type::int())],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $q = new Personal();
        if (isset($args['id'])) {
            $q = $q->where('id', $args['id']);
        }
        if (isset($args['nombre'])) {
            $nombre = $args['nombre'];
            $q = $q->where('name', 'like', "%$nombre%");
        }
        if (isset($args['edad'])) {
            $ageAgo = Carbon::today()->subYears($args['edad']);
            $q = $q->where('birthDate', '<', $ageAgo);

        }
        if (isset($args['edadEntre'])) {
            $min = $args['edadEntre'][0];
            $max = $args['edadEntre'][1];

            $start = Carbon::today()->subYears($max)->subYear()->addDay();
            $end = Carbon::today()->subYears($min)->addYear()->subDay();

            $q = $q->whereBetween('birthDate', [$start, $end]);

        }
        return $q->get();
    }
}
