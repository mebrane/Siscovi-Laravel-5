<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 21/09/2017
 * Time: 03:14 PM
 */

namespace App\GraphQL\traits;

use Illuminate\Database\Eloquent\Model;
use Rebing\GraphQL\Support\Type as GraphQLType;

trait GraphQLMutationTrait
{
    use GraphQLGlobalTrait;

//  Cambia los valores de los keys de los alias a las columnas
//  manteniendo los valores de los argumentos
//  input:
//  [
//      nombre="Pedro",
//      correo="pedro@gmail.com"
//  ]
//  output:
//  [
//      name="Pedro",
//      email="pedro@gmail.com"
//  ]
    public function _argsToColumns(Array $args, GraphQLType $type)
    {
        $fields = [];
        $typeFields = $type->fields();
        foreach ($args as $arg => $value) {
            if (isset($typeFields[$arg])) {
                $col = $typeFields[$arg]['col'];
                $fields[$col] = $value;
            }
        }
        return $fields;
    }

    public function _aliasesToSelects(Array $args, GraphQLType $type)
    {

        list($table, $column) = explode('.', $args[0]);

        $columns = $this->_argsToColumns($args, $type);
        $selects = array_keys($columns);
        foreach ($selects as $key => $value) {
            $selects[$key] = $table . '.' . $value;
        }
    }

    /**
     * @return Model Returns the model filled with values for Update.
     */
    public function _fillOnUpdate(Model $model,array $keys, array $args, GraphQLType $type)
    {

        $args=$this->_argsToColumns($args,$type);
//        throw new \Exception(json_encode($args));
        foreach ($keys as $key) {
            $key = $this->_getOriginalAttr($key, $type);
            if ($key && isset($args[$key]) && $model->$key != $args[$key]) {
                $model->$key = $args[$key];
            }
        }
        return $model;
    }
}