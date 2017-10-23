<?php 

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;
use App\Api\Models\Bank;

class FraudCategoryTransformer extends BaseTransformer
{

   public function includeFraudCategory($model)
    {
        return $this->item($model->FraudCategory, new FraudCategoryTransformer);
    }
}