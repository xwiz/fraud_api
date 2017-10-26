<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Bank extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    * 
    * @var array
    */
    protected $fillable = ['name'];

    /**
     * Relation to fraudAccounts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fraudAccounts()
    {
    	return $this->hasMany(FraudAccount::class);   
    }
    
}
