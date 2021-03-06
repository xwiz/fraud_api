<?php

namespace App\Api\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends BaseModel
{
    use Notifiable;
    

    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone_number','password', 'confirmation_code','confirmed'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $rules = [
        'create' => [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:3',
            'phone_number' => 'digits:11|unique:users',
        ],
        'update' => [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
        ],
    ];


    /**
     * Relation to fraudCases
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fraudCases()
    {
        return $this->hasMany(FraudCase::class);
    }

    /**
     * Relation to comments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
