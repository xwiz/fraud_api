<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Severity extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    * @var array
    */
    protected $fillable = ['rating'];

    /**
     * Relation to fraudCases
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fraudCases()
    {
        return $this->hasMany(FraudCase::class);
    }
    
}
