<?php

namespace App\Api\Transformers;

use App\Api\Models\FraudCase;

class FraudCaseTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraud_accounts', 'fraud_mobiles', 'fraud_emails', 'fraud_websites', 'user'];
    public $defaultIncludes = ['fraudEmails', 'fraudAccounts', 'fraudWebsites','fraudMobiles'];

    public function includeFraudAccounts(FraudCase $model)
    {
        return $this->collection($model->fraudAccounts, new FraudAccountTransformer);
    }
    public function includeFraudEmails(FraudCase $model)
    {
        return $this->collection($model->fraudEmails, new FraudEmailTransformer);
    }

    public function includeFraudMobiles(FraudCase $model)
    {
        return $this->collection($model->fraudMobiles, new FraudMobileTransformer);
    }

    public function includeFraudWebsites(FraudCase $model)
    {
        return $this->collection($model->fraudWebsites, new FraudWebsiteTransformer);
    }
    public function includeUser(FraudCase $model)
    {
        return $this->item($model->user, new UserTransformer);
    }

}