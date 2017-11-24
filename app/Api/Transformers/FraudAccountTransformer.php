<?php

namespace App\Api\Transformers;

use App\Api\Models\FraudAccount;

/**
 * Class FraudAccountTransformer
 * @package Api\Transformers
 */
class FraudAccountTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraud_case'];
    public $defaultIncludes = [];

    /*
    * Include FraudCase data and transform it
    * @param Model $model
    * @return \League\Fractal\Resource\item
    */
    public function includeFraudCase(FraudAccount $model)
    {
        return $this->item($model->fraud_case, new FraudCaseTransformer);
    }
}