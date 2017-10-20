<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Bank extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    */
    protected $fillable = ['name'];

    //Banks has many Accounts
    public function fraudAccounts()
    {
        return $this->hasMany('\App\Api\Models\FraudAccount');   
    }
    
}
