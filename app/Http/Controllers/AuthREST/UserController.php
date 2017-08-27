<?php

namespace App\Http\Controllers\AuthREST;

use App\models\auth\User;
use App\transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        //$users=User::with('personal')->get()->paginate(5);
        //$users=User::with('personal')->paginate();
        $users=User::paginate();

//        return $users;

        if($users->total()>0){
            return $this->response->paginator($users, new UserTransformer);
        }

        throw new NotFoundHttpException('No se encontraron resultados');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\auth\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
//        return response()->json([
//            'user'=>$user
//        ]);
        //$user=User::findOrFail(1);
        return $this->response->item($user, new UserTransformer);
        //return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\auth\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\auth\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\auth\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
