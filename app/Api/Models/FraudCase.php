<?php

namespace App\Api\Models;

use App\Api\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class FraudCase extends BaseModel
{
    /**
    * The attributes of this model that can be auto-filled from input data
    */
    protected $fillable = ['user_id', 'scam_start_date', 'scam_realization_date','severity_id', 'amount_scammed_off', 'fraud_cateogry_id', 'scammer_name', 'scammer_real_name', 'item_type_id', 'item_name'];

    public function user()
    {
        return $this->belongsTo('\App\Api\Models\User');
    }

    public function itemType()
    {
        return $this->belongsTo('\App\Api\Models\ItemType');
    }

    public function fraudCategory()
    {
        return $this->belongsTo('\App\Api\Models\FraudCategory');
    }

    public function severity()
    {
        return $this->belongsTo('\App\Api\Models\Severity');
    }

    public function fraudWebsite()
    {
        return $this->belongsTo('\App\Api\Models\FraudWebsite');
    }

    public function fraudAccounts()
    {
        return $this->belongsToMany('\App\Api\Models\FraudAccount');
    }

    public function fraudMobiles()
    {
        return $this->belongsToMany('\App\Api\Models\FraudMobile');
    }

    public function fraudEmail()
    {
        return $this->belongsTo('\App\Api\Models\FraudEmail');
    }

    public function fraudCaseFiles()
    {
        return $this->hasMany('\App\Api\Models\FraudCaseFile');
    }

    
}