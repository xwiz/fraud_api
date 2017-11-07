<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudCaseFile extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    * @var array
    */
    protected $fillable = ['fraud_case_id', 'picture_url', 'is_fraudster_picture'];

     /**
     * Default hidden attributes
     * This attribute will be excluded from JSON
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at', 'pivot'];

    /**
     * Relation to fraudCase
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fraudCase()
    {
        return $this->belongsTo(FraudCase::class);
    }
}
