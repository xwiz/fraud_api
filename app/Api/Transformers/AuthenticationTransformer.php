<?php 

namespace App\Api\Transformers;

use League\Fractal\TransformerAbstract;
use App\Api\Models\Authentication;

class AuthenticationTransformer extends BaseTransformer
{

   public function includeAuthentication($model)
    {
        return $this->item($model->Authentication, new AuthenticationTransformer);
    }
}