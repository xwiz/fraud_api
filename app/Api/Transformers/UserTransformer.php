<?php 

namespace App\Api\Transformers;

use App\Api\Models\User;

class UserTransformer extends BaseTransformer
{
    public $availableIncludes = ['fraudCases'];
    public $defaultIncludes = ['fraudCases'];


    /**
    * Include user data and transform it
    * @param BaseModel $model
    * @return \League\Fractal\Resource\Item
    */
    public function includeFraudCases(User $model)
    {
        return $this->collection($model->fraudCases, new FraudCaseTransformer);
    }
}