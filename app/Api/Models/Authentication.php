<?php

namespace App\Api\Models;

use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    protected $fillable = ['user_id', 'token'];
}
