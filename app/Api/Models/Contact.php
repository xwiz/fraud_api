<?php

namespace App\Api\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contact extends BaseModel
{
	/**
    * The database table used by the model.
    *
    * @var string
    */
	protected $table = 'contacts';

    /**
    * The attributes of this model that can be auto-filled from input data
    *
    * @var array
    */
    protected $fillable = ['name', 'email','subject', 'message'];

    public $rules = [
    'create' => [
    	'email' => 'required|email', 
    	],
    ];
}
