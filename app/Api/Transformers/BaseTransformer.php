<?php

namespace App\Api\Transformers;

use App\Api\Models\BaseModel;
use League\Fractal\TransformerAbstract;


/**
 * Class BaseTransformer
 * @package Api\Transformers
 */
class BaseTransformer extends TransformerAbstract
{
    public $availableIncludes = [];
    public $defaultIncludes = [];
    public $useTraits = true;

    public function __construct(){
        if (!count($this->defaultIncludes) && $this->useTraits)
        {
            // if not defined default includes, try to auto load traits and set up it as default includes
            $traitsList = class_uses($this);
            foreach ($traitsList as $traitName) {
                $includeName = strtolower(str_replace(["TransformTrait", "Api\\Transformers\\Traits\\"], "", $traitName));
                $this->defaultIncludes[] = $includeName;
            }
        }
    }

    /**
    * Base Transform method
    * @param $model
    * @throws \Exception
    * @return array
    */
    public  function transform($model)
    {
        // If model is null ,it return null
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


    /**
     * Create a new item resource object
     *
     * @api
     * @param $data
     * @param $transformer
     * @param $resourceKey
     * @return \League\Fractal\Resource\Item
     **/
    public function item($data, $transformer, $resourceKey = 'data')
    {
        return parent::Item($data, $transformer, $resourceKey);
    }

}