<?php
namespace App\Api\Transformers\Traits;

use App\Api\Transformers\UserTransformer;

 trait UserTransformTrait
{

    /**
     * Include user data and transform it
     * @param BaseModel $model
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser($model)
    {
        return $this->Item($model->user, new UserTransformer());
    }
}