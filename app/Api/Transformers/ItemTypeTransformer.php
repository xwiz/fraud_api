<?php 

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;
use App\Api\Models\ItemType;

class ItemTypeTransformer extends BaseTransformer
{

   public function includeItemType($model)
    {
        return $this->item($model->ItemType, new ItemTypeTransformer);
    }
}