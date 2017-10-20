<?php

namespace App\Api\Transformers;

use App\Api\Models\BaseModel;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{
    public $availableIncludes = [];

    public $defaultIncludes = [];

    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
    // If model is null ,it return null
    public  function transform($model)
    {
        if($model === null)
        {
            return null;
        }
        
        //mapping Transformer to their model
        $modelClass= str_replace(array("App\\Api\\Transformers", "Transformer"), array("App\\Api\\Models", ""), get_class($this));
        if($model instanceof $modelClass)
        {
            $result=[];
            foreach ($model->toArray() as $key => $value) 
            {
                if($model->isTransformable($key))
                $result[$key]= $value;
            }
            return $result;
        }
        else
        {
           throw new \Exception(sprintf("Invalid model < %s > for tranformation at %s", get_class($model), get_class($this)));  
        }
    }

    public function item($data, $transformer, $resourceKey = 'data')
    {
        return parent::Item($data, $transformer, $resourceKey);
    }

}