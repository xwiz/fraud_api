<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudMobile extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    */
    protected $fillable = ['fraud_case_id', 'phone_number'];

    public function fraudCases()
    {
        return $this->belongsToMany('\App\Api\Models\FraudCase');
    }
}
