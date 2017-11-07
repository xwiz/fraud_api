<?php

namespace App\Api\Controllers;

use API;
use JWTAuth;
use App\Api\Models\User;
use Illuminate\Http\Request;
use App\Api\Models\FraudCase;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;
use App\Api\Transformers\UserTransformer;



class UserController extends Controller
{
    use Helpers;

    /**
    * @var Api\Models\User $model
    */
    private $model;


    /**
     * User model instance
     *
     * @var User
     */
    private $user;

    /**
     * Fraud Case model instance
     *
     * @var FraudCase
     */
    private $fraudCase;


     /**
     * Class constructor
     *
     * @param User $user
     * @param FraudCase $fraudCase
     */
    public function __construct(User $user, FraudCase $fraudCase)
    {
        $this->model = $user;
        $this->fraudCaseModel = $fraudCase;
    }

    /**
    * View current logged in user info
    * GET /users/me
    * @return Response
    */
    public function index(User $user)
    {
        return API::user();
    }


    /**
    * Reterive Users all fraudcases
    *GET frauds/me
    * @param $request
    * @return Response
    */
    public function userFraud(Request $request,User $user, FraudCase $fraudCase, $id)
    {
        $this->model = $this->model::find($id);
        return FraudCase::where('user_id', $id)->paginate(5);
    }


    /**
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
            return Response::make(['error' => $this->model->getErrors()], '422');        
        }
        $data['password'] = bcrypt($data['password']);
        $this->model->fill($data);
        $this->model->save();
        return response()->json([
            'message' => 'Congratulations, New User created Successfully!!!',
            'user' => $this->model
            ]);
    }


    /** 
    * Update the specified resource in storage.
    * PUT users/{id}
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
        return response()->json([
            'message' => 'Congratulations, Update was Successful!!!',
            'user' => $this->model
            ]);
    }

   
    /**
    * Log user in with generated token
    * POST /users/me
    * Request params: 
    * token: string
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
    * DELETE users/{id}
    *
    * @param  $id
    * @return Response
    */
    public function destroyUser(Request $request, $id)
    {
        $this->model = $this->model::find($id)->delete();
        return "User ID ". $id ." Deleted Successfully";
    }
}