<?php 

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;
use App\Api\Models\Severity;

class SeverityTransformer extends BaseTransformer
{

   public function includeSeverity($model)
    {
        return $this->item($model->Severity, new SeverityTransformer);
    }
}