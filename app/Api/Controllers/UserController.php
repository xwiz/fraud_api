<?php

namespace App\Api\Controllers;


use JWTAUth;
use Validator;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\Models\User;
use Illuminate\Database\Eloquent\Model;
use Dingo\Api\Exception\StoreResourceFailedException;
use App\Api\Transformers\UserTransformer;
use Dingo\Api\Facade\API;


class UserController extends Controller
{
    use Helpers;

    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }



    /*
    * Creates a new user
    * POST /users
    * Request params:
    * first_name: string
    * last_name: string
    * email: string
    *
    * @return Response
    */
    public function storeUser (Request $request)
    {
        $data = $request->except('_token');
        
        if(!$this->model->validate($data['email'],$this->model->rules,'create'))
            {
                throw new StoreResourceFailedException('Could not create user. Errors: '. $this->model->getErrors());
            }

            $data['password'] = bcrypt($data['password']);
            $this->model->fill($data);
            $this->model->save();
            return $this->model;
    }

    /**
    * View current logged in user info
    * GET user
    * @return Response
    */
    public function me()
    {
        return API::user()->user;
    }


    /** 
    * Update the specified resource in storage.
    * PUT users/{user}
    *
    * param Api\Models\User $user
    * @return Response
    */
    public function updateUser(Request $request, $id)
    {
        $this->model = $this->model::find($id);
        $data = $request->except('_token');

        if(!$this->model->validate($data,$this->model->rules,'update'))
        {
            throw new StoreResourceFailedException('Could not edit user. Errors: '. $this->model->getErrors());
        }

        $data['password'] = bcrypt($data['password']);
        $this->model->fill($data);
        $this->model->save();
        return $this->model;
    }


    /**
    * Remove the specified resource from storage.
    * DELETE users/{user}
    *
    * @param  int  $user
    * @return Response
    */
    public function destroyUser(Request $request, $id)
    {
        $this->model = $this->model::find($id)->delete();
        return "User ". $id ." Deleted Successfully";
    }

}