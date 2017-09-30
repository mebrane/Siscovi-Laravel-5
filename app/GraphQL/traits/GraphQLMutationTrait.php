<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 21/09/2017
 * Time: 03:14 PM
 */

namespace App\GraphQL\traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rebing\GraphQL\Support\Type as GraphQLType;

trait GraphQLMutationTrait
{
    /**
     * @return Model Returns the Builder with data filled.
     */
    protected function _fillOnUpd(Model $model,array $args){
        foreach ($args as $key=>$arg) {
            if ($model->$key != $args[$key]) {
                $model->$key = $args[$key];
            }
        }
        return $model;
    }

    /**
     * @return Model Returns the Builder with data filled.
     */
    protected function _fillOnIns(Model $model,array $args){
        $keys = array_flip($model->_fillable());
        $_args = array_intersect_key($args,$keys);
        return $model->fill($_args );
    }
}