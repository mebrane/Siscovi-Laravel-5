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
    use GraphQLGlobalTrait;
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
}