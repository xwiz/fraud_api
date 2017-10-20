<?php

namespace App\Api\Transformers;

use App\Api\Models\FraudEmail;

class FraudEmailTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraud_case'];
    public $defaultIncludes = [];

    public function includeFraudCase(FraudEmail $model)
    {
        return $this->item($model->fraudCase, new FraudCaseTransformer);
    }
}