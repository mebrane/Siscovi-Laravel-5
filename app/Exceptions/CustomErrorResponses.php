<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 26/08/2017
 * Time: 11:22 PM
 */

namespace App\Exceptions;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;

class CustomErrorResponses
{

    public function responses()
    {
        $this->modelNotFound();
    }

    private function modelNotFound()
    {
        app('Dingo\Api\Exception\Handler')
            ->register(function (ModelNotFoundException $exception) {
                //return Response::make(['error' => 'Hey, what do you think you are doing!?'], 401);
                //dd($exception);
                $smodel = $exception->getModel();
                $amodel = explode('\\', $smodel);
                $model = $amodel[sizeof($amodel) - 1];
                $rmodel = [
                    "User" => "usuario",
                    "Personal" => "personal",
                    "Activity" => "activity",
                ];
                return Response::make(['error' => "No se encontró $rmodel[$model]."], 404);
            });
    }
}