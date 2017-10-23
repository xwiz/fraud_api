<?php 

namespace App\Api\Transformers;

use App\Api\Models\FraudWebsite;

class FraudWebsiteTransformer extends BaseTransformer
{
	public $availableIncludes = ['fraud_case'];
	public $defaultIncludes = [];

	public function includeFraudCase(FraudWebsite $model)
	{
		return $this->item($model->fraudCase, new FraudCaseTransformer);
	}
}