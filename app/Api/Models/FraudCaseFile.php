<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudCaseFile extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    */
    protected $fillable = ['fraud_case_id', 'picture_url', 'is_fraudster_picture'];

    public function fraudCase()
    {
        return $this->belongsTo('\App\Api\Models\FraudCase');
    }
}
