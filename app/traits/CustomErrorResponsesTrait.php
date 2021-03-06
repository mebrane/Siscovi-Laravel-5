<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 27/08/2017
 * Time: 02:54 PM
 */
namespace App\traits;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait CustomErrorResponsesTrait
{
    private function response($message = "Error del servidor.", $code = 500)
    {
        return \Illuminate\Support\Facades\Response::make(['error' => $message,'status'=>$code], $code);
    }

    public function customErrorResponses()
    {
        $this->modelNotFound();
        $this->notFound();
        $this->validation();
    }

    private function modelNotFound()
    {
        app('Dingo\Api\Exception\Handler')
            ->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                //return Response::make(['error' => 'Hey, what do you think you are doing!?'], 401);

                $expModel = explode('\\', $exception->getModel());
                $model = $expModel[sizeof($expModel) - 1];
                $rmodel = [
                    "User" => "usuario",
                    "Personal" => "personal",
                    "Activity" => "activity",
                    "ActivityType" => "tipo de actividad",
                ];
//                return \Illuminate\Support\Facades\Response::make(['error' => "No se encontró $rmodel[$model]."], 404);
                return $this->response("No se encontró $rmodel[$model].", 404);
            });
    }

    private function notFound()
    {
        app('Dingo\Api\Exception\Handler')
            ->register(function (NotFoundHttpException $exception) {
                return $this->response("La ruta especificada no ha sido encontrada.", 404);
            });
    }

    private function validation(){

          app('Dingo\Api\Exception\Handler')
              ->register(function (ValidationException $e) {


                  $errors = $e->validator->errors()->getMessages();
//                  if ($this->isFrontend($request)) {
//                      return $request->ajax() ? response()->json($error, 422) : redirect()
//                          ->back()
//                          ->withInput($request->input())
//                          ->withErrors($errors);
//                  }

//                  return $this->errorResponse($errors, 422);



                  return $this->response($errors, 500);
              });
    }


}