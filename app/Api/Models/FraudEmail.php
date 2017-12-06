<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudEmail extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    * @var array
    */
    protected $fillable = ['fraud_case_id', 'email'];

    public $rules = [
    
        'create' => [
            'email' => 'email|max:50',
        ],
        'update' => [],
    ];

    /**
     * Relation to fraudCases
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function fraud_cases()
    {
        return $this->belongsToMany(FraudCase::class);
    }
}
