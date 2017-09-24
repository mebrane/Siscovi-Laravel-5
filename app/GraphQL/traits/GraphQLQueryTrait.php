<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 21/09/2017
 * Time: 03:15 PM
 */

namespace App\GraphQL\traits;

use Illuminate\Database\Eloquent\Builder;
use Rebing\GraphQL\Support\Type as GraphQLType;

trait GraphQLQueryTrait
{
    use GraphQLGlobalTrait;

    /**
     * @return Builder Returns the Builder with selects.
     */
    protected function _selectData(Builder $q, array $selects)
    {
        foreach ($selects as $key => $select) {
            list($table, $field) = explode('.', $select);
            $selects[$key] = $field;
//            $q=$q->select($field);
        }
        return $q->select($selects);
    }

    /**
     * @return Builder Returns the Builder with sort and sortDesc.
     */
    protected function _sortData(Builder $q, $arg,array $allowed)
    {
        $sorts = explode(',', $arg);

        foreach ($sorts as $key => $sort) {

            if (strlen($sort) > 1 && in_array($sort,$allowed)) {

                if (substr($sort, 0, 1) == '-') {

                    $sort = substr($sort, 1, strlen($sort) - 1);
                    $q->orderByDesc($sort);

                } else {

                    $q->orderBy($sort);
                }
            }
        }

        return $q;
    }

    /**
     * @return Builder Returns the builder with filtered where queries.
     */
    protected function _where(Builder $q, array $args, array $allowed)
    {
        foreach ($args as $key => $arg){
            if(in_array($key,$allowed)){
               $q->where($key,$arg);
            }
        }
        return $q;
    }

    /**
     * @return Builder Returns the Builder with whereLike queries.
     */
    protected function _whereLike(Builder $q, array $args, array $allowed)
    {
        foreach ($args as $query => $arg){
            if(in_array($query,$allowed)){
                $q->where($query,'like', "%$arg%");
            }
        }
        return $q;
    }

}