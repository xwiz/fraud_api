<?php

namespace App\Api\Transformers;

use App\Api\Models\FraudMobile;

class FraudMobileTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraud_case'];
    public $defaultIncludes = [];

    public function includeFraudCase(FraudMobile $model)
    {
        return $this->item($model->fraudCase, new FraudCaseTransformer);
    }
}