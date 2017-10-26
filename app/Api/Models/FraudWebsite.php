<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudWebsite extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    *
    * @var array
    */
    protected $fillable = ['fraud_case_id', 'website_url','bank_id'];

    public $rules = [
        'create' => [],
        'update' => [],
    ];


    /**
     * Relation to fraudCases
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fraudCases()
    {
        return $this->belongsToMany(FraudCase::class);
    }
    
}
