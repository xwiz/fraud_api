<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudCase extends BaseModel
{

    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'fraud_cases';

    /**
    * The attributes of this model that can be auto-filled from input data
    */

    protected $fillable = [
        'user_id', 'scam_start_date', 'scam_realization_date','severity_id', 'amount_scammed_off', 'fraud_category_id', 'scammer_name', 'scammer_real_name', 'item_type_id', 'item_name'
    ];

    public $rules = [
        'create' => [
            'amount_scammed_off' => 'numeric',
            'scammer_real_name' => 'min:3',
            'item_name' => 'max:150',
        ],
        'update' => [
            'amount_scammed_off' => 'numeric',
            'scammer_real_name' => 'min:3',
            'item_name' => 'max:150',
        ],
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function itemType()
    {
        return $this->belongsTo(ItemType::class);
    }


    public function fraudCategory()
    {
        return $this->belongsTo(FraudCategory::class);
    }


    public function severity()
    {
        return $this->belongsTo(Severity::class);
    }


    public function fraudWebsites()
    {
        return $this->belongsToMany(FraudWebsite::class, 'fraudcase_fraudwebsite', 'fraud_case_id', 'fraud_website_id');
    }


    public function fraudCaseFiles()
    {
        return $this->hasMany(FraudCaseFile::class);
    }


    public function fraudEmails()
    {
        return $this->belongsToMany(FraudEmail::class, 'fraudcase_fraudemail', 'fraud_case_id', 'fraud_email_id');
    }
    

    public function fraudAccounts()
    {
        return $this->belongsToMany(FraudAccount::class, 'fraudaccount_fraudcase', 'fraud_case_id', 'fraud_account_id');
    }


    public function fraudMobiles()
    {
        return $this->belongsToMany(FraudMobile::class, 'fraudcase_fraudmobile', 'fraud_case_id', 'fraud_mobile_id');
    }
}