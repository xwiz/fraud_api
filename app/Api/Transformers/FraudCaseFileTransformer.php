<?php 

namespace App\Api\Transformers;

use App\Api\Models\FraudCaseFile;

/**
 * Class FraudCaseFileTransformer
 * @package Api\Transformers
 */
class FraudCaseFileTransformer extends BaseTransformer
{
	public $availableIncludes = ['fraud_case'];
	public $defaultIncludes = [];

	/**
    * Include FraudCaseFile data and transform it
    * @param BaseModel $model
    * @return \League\Fractal\Resource\item
    */
	public function includeFraudCaseFile($model)
	{
		return $this->item($model->fraud_casefile, new FraudCaseFileTransformer);
	}
}