<?php

namespace App\Api\Controllers;


use JWTAuth;
use App\Api\Models\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Api\Transformers\UserTransformer;
use Dingo\Api\Exception\StoreResourceFailedException;



class UserController extends Controller
{
    use Helpers;

    private $model;


    /**
     * User model instance
     *
     * @var User
     */
    private $user;

    // *
    //  * Fraud Case model instance
    //  *
    //  * @var FraudCase
     
    // private $fraudCase;




    public function __construct( User $user)
    {
        $this->model = $user;
        //$this->fraudCaseModel = $fraudCase;
    }


    public function index()
    {
       return $users = User::all();
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
    public function storeUser (Request $request, User $user)
    {
        $data = $request->except('_token');
        
        if(!$this->model->validate($data,'create'))
        {
            throw new StoreResourceFailedException('Could not create user. Errors: '. $this->model->getErrorsInline());
        }
        $data['password'] = bcrypt($data['password']);
        $this->model->fill($data);
        $this->model->save();
        return $this->model;
    }


    /** 
    * Update the specified resource in storage.
    * PUT users/{user}
    *
    * @param $id
    * @return Response
    */
    public function updateUser(Request $request, User $user, $id)
    {
        $this->model = $this->model::find($id);
        $data = $request->except('_token');

        if(!$this->model->validate($data,'update'))
        {
            throw new StoreResourceFailedException('Could not edit user. Errors: '. $this->model->getErrorsInline());
        }
        $data['password'] = bcrypt($data['password']);
        $this->model->fill($data);
        $this->model->save();
        return $this->model;
    }


    /**
    * Log user in with generated token
    * @return Response
    */
    public function getAuthenticatedUser(User $user)
    {
        try
        {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        }
        catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        }
        catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
        {
            return response()->json(['token_invalid'], $e->getStatusCode());
        }
        catch (Tymon\JWTAuth\Exceptions\JWTException $e)
        {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        
        // the token is valid and we have found the user via the sub claim
        return $user;
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
        return "User ID ". $id ." Deleted Successfully";
    }


    public function searchUser(Request $request)
    {
        $query = $request->get('keyword');
        return $user = User::search($query)->get();
        
    }
}