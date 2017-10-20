<?php 

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;
use App\Api\Models\Bank;

class BankTransformer extends BaseTransformer
{

   public function includeBank($model)
    {
        return $this->item($model->Bank, new BankTransformer);
    }
}