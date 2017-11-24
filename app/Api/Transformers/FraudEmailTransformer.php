<?php

namespace App\Api\Transformers;

use App\Api\Models\FraudEmail;

/**
 * Class FraudEmailTransformer
 * @package Api\Transformers
 */
class FraudEmailTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraud_case'];
    public $defaultIncludes = [];


    /**
    * Include FraudEmail data and transform it
    * @param Model $model
    * @return \League\Fractal\Resource\item
    */
    public function includeFraudCase(FraudEmail $model)
    {
        return $this->item($model->fraud_case, new FraudCaseTransformer);
    }
}