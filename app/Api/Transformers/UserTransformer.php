<?php 

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;
use App\Api\Models\User;

class UserTransformer extends BaseTransformer
{

   public function includeUser($model)
    {
        return $this->item($model->User, new UserTransformer);
    }
    // public $availableIncludes = [];

    // public $defaultIncludes = [];

  

    //     /**
    //  * Include user data and transform it
    //  * @param BaseModel $model
    //  * @return \League\Fractal\Resource\Item
    //  */
    // public function includeMerchant($model)
    // {
    //     return $this->Item($model->merchant, new MerchantTransformer());
    // }

    // public function includeState($model)
    // {
    //     return $this->Item($model->state, new StateTransformer());
    // }
    // public function includeFavouritestore($model)
    // {
    //     return $this->collection($model->favouritestore, new StoreTransformer());
    // }
       
}