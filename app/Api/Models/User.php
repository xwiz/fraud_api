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
        'first_name', 'last_name', 'email', 'phone_number','password',
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
            'first_name' => 'min:3|required',
            'last_name' => 'min:3|required',
            'email' => 'email|unique:users,email|required',
            'password'=>'min:3',
            'phone_number' => 'min:11|max:15|unique:users',
        ],
        'update' => [
            'first_name' => 'min:3',
            'last_name' => 'min:3',
            'password'=>'min:3',
            'phone_number' => 'min:11|max:15|unique:users',
            'email' => 'email|unique:users,email|required',
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
}
