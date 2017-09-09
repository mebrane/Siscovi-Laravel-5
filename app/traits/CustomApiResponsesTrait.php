<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 27/08/2017
 * Time: 05:22 PM
 */

namespace App\traits;


use App\transformers\BaseTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait CustomApiResponsesTrait
{
    use Helpers;

    function showAll(Model $interface, $transformer)
    {


        $interface = $this->filterData($interface, $transformer);
        $interface = $this->orderData($interface, $transformer);

        $per_page = 10;

        $rules = [
            'per_page' => 'integer|min:2|max:50',
        ];
        $messages = [
            'per_page.integer' => 'El número de elementos por página debe ser un entero.',
            'per_page.min' => 'El número de elementos por página no debe ser menor a 2.',
            'per_page.max' => 'El número de elementos por página no debe ser mayor que 50.',
        ];
        Validator::validate(request()->all(), $rules,$messages);

        if (request()->has('per_page')) {
            $per_page = (int) request()->per_page;
        }

        $interface = $interface->paginate($per_page);

        return $this->response->paginator($interface, new  $transformer);
    }

    private function filterData($collection, BaseTransformer $transformer)
    {
        foreach (request()->query() as $query => $value) {
            $attribute = $transformer->getOriginalAttr($query);

            if (isset($attribute, $value)) {
                $collection = $collection->where($attribute, $value);
            }
        }
        return $collection;
    }

    private function orderData($collection, BaseTransformer $transformer)
    {
        $reverse = false;
        if (request()->has('order_by')) {

            $attribute = request()->order_by;

            if (strlen($attribute) > 1 && substr($attribute, 0, 1) == '-') {
                $reverse = true;
                $attribute = substr($attribute, 1, strlen($attribute) - 1);
            }

            $attribute = $transformer->getOriginalAttr($attribute);

            if (isset($attribute)) {
                if ($reverse) {
                    $collection = $collection->orderByDesc($attribute);
                } else {
                    $collection = $collection->orderBy($attribute);
                }
            }
        }
        return $collection;
    }
}