<?php 

namespace App\Api\Transformers;

use App\Api\Models\User;


/**
 * Class UserTransformer
 * @package Api\Transformers
 */
class UserTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraud_cases'];
    public $defaultIncludes = [];


    /**
    * Include fraudCase data and transform it
    * @param Model $model
    * @return \League\Fractal\Resource\collection
    */
    public function includeFraudCases(User $model)
    {
        return $this->collection($model->fraud_cases, new FraudCaseTransformer);
    }
}
