<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudAccount extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    */
    protected $fillable = ['account_no', 'bank_id', 'account_name', 'fraud_case_id'];

    public function bank()
        {
            return $this->belongsTo('\App\Api\Models\Bank');
        }

    public function fraudCases()
    {
        return $this->belongsToMany('\App\Api\Models\FraudCase');
    }
    
}
