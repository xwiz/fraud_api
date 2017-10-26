<?php

namespace App\Api\Transformers;

use App\Api\Models\FraudMobile;

/**
 * Class FraudMobileTransformer
 * @package Api\Transformers
 */
class FraudMobileTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraud_case'];
    public $defaultIncludes = [];

    /*
    * Include fraudCase data and transform it
    * @param Model $model
    * @return \League\Fractal\Resource\item
    */
    public function includeFraudCase(FraudMobile $model)
    {
        return $this->item($model->fraudCase, new FraudCaseTransformer);
    }
}