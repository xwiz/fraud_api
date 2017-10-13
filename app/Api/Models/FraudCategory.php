<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudCategory extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    */
    protected $fillable = ['name', 'description'];
    
    public function fraudCases()
    {
        return $this->hasMany('\App\Api\Models\FraudCase');
    }
}
 