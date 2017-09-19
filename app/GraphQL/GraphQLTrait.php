<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 19/09/2017
 * Time: 04:28 AM
 */

namespace App\GraphQL;
use Illuminate\Database\Eloquent\Model;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Type as GraphQLType;
trait GraphQLTrait
{
    public function _getSelects(Array $selectArgs,GraphQLType $type){
        if(sizeof($selectArgs)==0){return [];}
        $selects=[];
        list($table,$column)=explode('.',$selectArgs[0]);
        $typeFields=$type->fields();

        foreach($typeFields as $key => $value){
            if(in_array("$table.$key",$selectArgs)){
                $col=$value['col'];
                array_push($selects,"$table.$col");
            }
        }

        return $selects;
    }

    public function _getCols(Array $args,GraphQLType $type){
        $cols=[];
        $typeFields=$type->fields();
        foreach($args as $arg=>$value){
            if(isset($typeFields[$arg])){
                $cols[$arg]=$typeFields[$arg]['col'];
            }
        }
//        throw new \Exception(implode(', ',$cols));
        return $cols;
    }

}