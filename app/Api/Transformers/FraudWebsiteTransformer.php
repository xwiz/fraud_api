<?php 

namespace App\Api\Transformers;

use App\Api\Models\FraudWebsite;


/**
 * Class FraudWebsiteTransformer
 * @package Api\Transformers
 */
class FraudWebsiteTransformer extends BaseTransformer
{
	public $availableIncludes = ['fraud_case'];
	public $defaultIncludes = [];

	/**
	* Include fraudCase data and transform it
    * @param Model $model
    * @return \League\Fractal\Resource\item
    */
	public function includeFraudCase(FraudWebsite $model)
	{
		//return $this->item($model->fraudCase, new FraudCaseTransformer);
	}
}