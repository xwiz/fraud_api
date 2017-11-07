<?php
namespace Api\Transformers\Traits;

use Api\Transformers\UserTransformer;

trait UserTransformTrait
{

    /**
     * Include user data and transform it
     * @param BaseModel $model
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser($model)
    {
    	if($model->user != null)
    	{
    		return $this->Item($model->user, new UserTransformer;
    	}
    }
}