<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class FraudCase extends BaseModel
{

    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
    'columns' => [
        'users.first_name' =>8,
        'users.last_name' => 8,
        'fraud_emails.email' => 8,
        'fraud_cases.scammer_name' => 8,
        'fraud_accounts.account_no' => 8,
        'fraud_mobiles.phone_number' => 8,
        'fraud_websites.website_url' => 8,
        'fraud_accounts.account_name' => 8,
        'fraud_cases.scammer_real_name' => 8,
    ],
    'joins' => [
        'users' => ['fraud_cases.user_id', 'users.id'],
        'fraud_emails' => ['fraud_cases.id','fraud_emails.fraud_case_id'],
        'fraud_mobiles' => ['fraud_cases.id','fraud_mobiles.fraud_case_id'],
        'fraud_accounts' => ['fraud_cases.id','fraud_accounts.fraud_case_id'],
        'fraud_websites' => ['fraud_cases.id','fraud_websites.fraud_case_id'],
    ],  

    ];


    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'fraud_cases';

    /**
    * The attributes of this model that can be auto-filled from input data
    *
    * @var array
    */
    protected $fillable = [
    'user_id', 'scam_start_date', 'scam_realization_date','severity_id', 'amount_scammed_off', 'fraud_category_id', 'scammer_name', 'scammer_real_name', 'item_type_id', 'item_name'
    ];

    public $rules = [
    
        'create' => [],

        'create1' => [
            'scammer_name' => 'required',
        ],

        'create2' => [
            'amount_scammed_off' => 'required|numeric',
        ],
        'create3' => [],

        'create4' => [
            'item_name' => 'max:150',
        ],


        'update' => [],

    ];


    /**
     * Relation to User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to severity
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function severity()
    {
        return $this->belongsTo(Severity::class);
    }

    /**
     * Relation to itemtype
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item_type()
    {
        return $this->belongsTo(ItemType::class);
    }

    /**
     * Relation to fraudCasesFiles
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fraud_casefiles()
    {
        return $this->hasMany(FraudCaseFile::class);
    }

    /**
     * Relation to fraudCategory
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fraud_category()
    {
        return $this->belongsTo(FraudCategory::class);
    }

    /**
     * Relation to fraudEmails
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fraud_emails()
    {
        return $this->belongsToMany(FraudEmail::class, 'fraudcase_fraudemail', 'fraud_case_id', 'fraud_email_id');
    }
    

    /**
     * Relation to fraudMobiles
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fraud_mobiles()
    {
        return $this->belongsToMany(FraudMobile::class, 'fraudcase_fraudmobile', 'fraud_case_id', 'fraud_mobile_id');
    }

    /**
     * Relation to fraudAccounts
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fraud_accounts()
    {
        return $this->belongsToMany(FraudAccount::class, 'fraudaccount_fraudcase', 'fraud_case_id', 'fraud_account_id');
    }

    /**
     * Relation to fraudWebsites
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fraud_websites()
    {
        return $this->belongsToMany(FraudWebsite::class, 'fraudcase_fraudwebsite', 'fraud_case_id', 'fraud_website_id');
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