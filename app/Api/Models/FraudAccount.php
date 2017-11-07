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

     /**
     * Default hidden attributes
     * This attribute will be excluded from JSON
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at', 'pivot'];

    public $rules = [
        'create' => [
            'account_no' => 'min:10|max:10',
            'account_name' => 'max:50',
        ],
        'update' => [],
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
