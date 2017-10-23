<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Api\Models\Authentication;
use Illuminate\Support\Facades\Config;

class Authentication extends BaseModel
{
    protected $fillable = ['user_id', 'token','expiry'];

    public function user()
    {
        return $this->belongsTo('\App\Api\Models\User');
    }


    public function store($user_id, $token)
    {
        $authentication = $this->where(array('user_id' => $user_id));

        $authenticationData = array(
            'token' => $token,
            //expire in minutes, after 1 hour
            'expiry' => Carbon::now()->addMinutes(61)
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
