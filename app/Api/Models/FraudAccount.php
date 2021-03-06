<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudAccount extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    *
    * @var array
    */
    protected $fillable = ['account_no', 'bank_id', 'account_name', 'fraud_case_id'];

    public $rules = [
        'create' => [
            'account_no' => 'digits:10',
            'account_name' => 'max:50',
        ],
        'update' => [
            'account_no' => 'digits:10',
            'account_name' => 'max:50',
        ],
    ];

    /**
     * Relation to bank
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    /**
     * Relation to fraudCases
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fraudCases()
    {
        return $this->belongsToMany(FraudCase::class);
    }
    
}
