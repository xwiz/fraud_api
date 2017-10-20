<?php

namespace App\Api\Transformers;

use App\Api\Models\FraudCase;

class FraudCaseTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraud_accounts', 'fraud_mobiles', 'fraud_emails', 'fraud_websites'];
    public $defaultIncludes = ['fraud_emails', 'fraud_accounts', 'fraud_mobiles'];

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

    public function includeFraudWebsite(FraudCase $model)
    {
        return $this->collection($model->fraudWebsite, new FraudWebsiteTransformer);
    }
}