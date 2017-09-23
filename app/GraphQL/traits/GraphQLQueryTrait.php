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
     * @return Builder Returns the Builder with selection queries.
     */
    protected function _select(Builder $q, array $selects, GraphQLType $type){
        list($table, $col) = explode('.', $selects[0]);
        $attributes = [];
        foreach ($selects as $select) {
            $_select = str_replace($table . '.', '', $select);
            $attr = $this->_getOriginalAttr($_select, $type);
            if ($attr) {
                array_push($attributes, $table . '.' . $attr);
            }
        }
        return $q->select($attributes);
    }

    /**
     * @return Builder Returns the Builder with sort and sortDesc queries.
     */
    protected function _sortBy(Builder $q, $arg, GraphQLType $type)
    {
        $sorts = explode(',', $arg);
        foreach ($sorts as $sort) {

            if (strlen($sort) > 1) {
                if (substr($sort, 0, 1) == '-') {
                    $sort = substr($sort, 1, strlen($sort) - 1);
//                    $this->_showError("Response: ".$sort);
                    $sort = $this->_getOriginalAttr($sort, $type);

                    if ($sort) {

                        $q=$q->orderByDesc($sort);
                    }
                } else {
                    $sort = $this->_getOriginalAttr($sort, $type);
                    if ($sort) {
                        $q=$q->orderBy($sort);
                    }
                }
            }
        }

        return $q;
    }

    /**
     * @return Builder Returns the Builder with where queries.
     */
    protected function _where(Builder $q, array $args, array $where, GraphQLType $type){
        foreach ($where as $w) {
            $key = $w;
            if (isset($args[$key])) {
                $attr = $this->_getOriginalAttr($key,$type);
                if($attr){
                    $q=$q->where($attr, $args[$key]);
                }
            }
        }
        return $q;
    }

    /**
     * @return Builder Returns the Builder with whereLike queries.
     */
    protected function _whereLike(Builder $q, array $args, array $whereLike, GraphQLType $type){
        foreach ($whereLike as $wl) {
            $key = $wl;
            if (isset($args[$key])) {
                $attr = $this->_getOriginalAttr($key,$type);
                $like = $args[$key];
                if($attr){
                    $q=$q->where($attr, 'like', "%$like%");
                }
            }
        }
        return $q;
    }

}