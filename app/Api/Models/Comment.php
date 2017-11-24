<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Comment extends BaseModel
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fraud_case_id', 'comment', 'user_id'];


    /**
     * Relation to fraudCases
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fraudCases()
    {
        return $this->belongsTo(FraudCase::class);
    }

    /**
     * Relation to User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
