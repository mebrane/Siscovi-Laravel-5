<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 27/08/2017
 * Time: 05:22 PM
 */

namespace App\traits;


use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait CustomApiResponsesTrait
{
    use Helpers;

    function showAll(Model $interface, $transformer)
    {


        $interface = $this->filterData($interface);
        $interface = $this->orderData($interface);
        $interface = $interface->paginate(5);

//        $interface = $interface->paginate(5);

//        if ($interface->total() == 0) {
//            throw new NotFoundHttpException('No se encontraron resultados');
//        }

        return $this->response->paginator($interface, new $transformer);
    }

    private function filterData($collection)
    {
        foreach (request()->query() as $query => $value) {

//            if (isset($attribute, $value)) {
            $collection = $collection->where($query, $value);
//            }
        }
        return $collection;
    }

    private function orderData($collection)
    {
        if (request()->has('order_by')) {

            $attribute = request()->order_by;

            if (strlen($attribute) > 1) {

                if (substr($attribute, 0, 1) == '-') {
                    $attribute=substr($attribute, 1, strlen($attribute)-1);
                    $collection = $collection->orderByDesc($attribute);

                } else {

                    $collection = $collection->orderBy($attribute);

                }

            }
        }
        return $collection;
    }
}