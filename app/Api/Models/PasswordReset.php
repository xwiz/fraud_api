<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    * @var array
    */
    protected $fillable = ['email', 'token'];

    public function setUpdatedAtAttribute($value)
    {
        // to disable updated_at
    }

}
