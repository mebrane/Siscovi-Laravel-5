<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 27/09/2017
 * Time: 02:11 AM
 */

namespace App\GraphQL\traits;

use GraphQL\Type\Definition\Type;

trait GraphQLTypeTrait
{
    use GraphQLGlobalTrait;
    protected function _fields($fields)
    {
        return array_merge($fields, $this->_dateFields());
    }

    protected function _dateFields()
    {
        return [
            'creado' => [
                'type' => Type::string(),
                'description' => 'Fecha de creación',
                'resolve' => function ($root, $args) {
                    return strtolower($root->created_at);
                }
            ],
            'actualizado' => [
                'type' => Type::string(),
                'description' => 'Fecha de última actualización',
                'resolve' => function ($root, $args) {
                    return strtolower($root->updated_at);
                }
            ],
            'eliminado' => [
                'type' => Type::string(),
                'description' => 'Fecha de eliminación',
                'resolve' => function ($root, $args) {
                    return $root->deleted_at ? strtolower($root->deleted_at) : $root->deleted_at;
                }
            ],
        ];
    }

}