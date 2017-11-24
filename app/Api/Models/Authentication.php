<?php

namespace App\Api\Models;

use Carbon\Carbon;
use App\Api\Models\BaseModel;
use App\Api\Models\Authentication;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class Authentication extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'authentications';

    /**
     * Allowed fields
     *
     * @var array
     */
    protected $fillable = ['user_id', 'token','expiry'];


    /**
     * Relation to user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Stores user authentication data
     *
     * @param $userId
     * @param $token
     *
     * @return bool
     */
    public function store($user_id, $token)
    {
        $authentication = $this->where(array('user_id' => $user_id));

        $authenticationData = array(
            'token' => $token,
            
            //expire in minutes, after 1 week
            'expiry' => Carbon::now()->addMinutes(10080)
        );

        if ($authentication->count() > 0){
            $authentication->update($authenticationData);
        }else{
            $authenticationData['user_id'] = $user_id;
            Authentication::create($authenticationData);
        }

        return true;
    }
}
