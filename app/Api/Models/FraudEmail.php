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

     /**
     * Default hidden attributes
     * This attribute will be excluded from JSON
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at', 'pivot'];

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
     public function fraudCases()
    {
        return $this->belongsToMany(FraudCase::class);
    }
}
