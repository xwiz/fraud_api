<?php 

namespace App\Api\Transformers;

use App\Api\Models\FraudCaseFile;

class FraudCaseFileTransformer extends BaseTransformer
{

   public function includeFraudCaseFile($model)
    {
        return $this->item($model->FraudCaseFile, new FraudCaseFileTransformer);
    }
}