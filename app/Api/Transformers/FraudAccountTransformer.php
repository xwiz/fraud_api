<?php

namespace App\Api\Transformers;

use App\Api\Models\FraudAccount;

class FraudAccountTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraud_case'];
    public $defaultIncludes = [];

    public function includeFraudCase(FraudAccount $model)
    {
        return $this->item($model->fraudCase, new FraudCaseTransformer);
    }
}