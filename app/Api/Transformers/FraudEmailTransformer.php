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
    * Include fraudCase data and transform it
    * Include user email data and transform it
    * @param BaseModel $model
    * @return \League\Fractal\Resource\item
    */
    public function includeFraudCase(FraudEmail $model)
    {
        return $this->item($model->fraudCase, new FraudCaseTransformer);
    }
}