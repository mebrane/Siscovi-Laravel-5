<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 27/09/2017
 * Time: 01:54 AM
 */

namespace App\GraphQL\traits;


use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

trait EloquenceModelTrait
{
//    use Eloquence;

//Comment before seed
    use Mappable;

    protected $_dateMaps = [
        'creado' => 'created_at',
        'actualizado' => 'updated_at',
        'eliminado' => 'deleted_at',
    ];

    protected function _loadMaps($maps)
    {
        $maps = array_merge($maps, $this->_dateMaps);
        $tbmaps = [];
        foreach ($maps as $key => $map) {
            $tbmaps["$this->table." . $key] = $map;
        }

        $this->maps = array_merge($maps, $tbmaps);
        $this->appends = array_merge(array_keys($maps));
    }

    public function _fillable(){
        return $this->fillable;
    }
}