<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudMobile extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    * @var array
    */
    protected $fillable = ['fraud_case_id', 'phone_number'];

    public $rules = [
        'create' => [
            'phone_number' => 'min:11|max:15',
        ],
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
