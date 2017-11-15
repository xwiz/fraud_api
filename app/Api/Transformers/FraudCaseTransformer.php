<?php

namespace App\Api\Transformers;

use App\Api\Models\FraudCase;

/**
 * Class FraudCaseTransformer
 * @package Api\Transformers
 */
class FraudCaseTransformer extends BaseTransformer
{
    public $availableIncludes = [];
    public $defaultIncludes = ['fraud_emails', 'fraud_accounts', 'fraud_websites','fraud_mobiles', 'fraud_casefiles'];
    
    /**
    * Include fraudAccounts data and transform it
    * @param BaseModel $model
    * @return \League\Fractal\Resource\collection
    */
    public function includeFraudAccounts($model)
    {
        return $this->collection($model->fraud_accounts, new FraudAccountTransformer);
    }

    /**
    * Include fraudEmails data and transform it
    * @param BaseModel $model
    * @return \League\Fractal\Resource\collection
    */
    public function includeFraudEmails(FraudCase $model)
    {
        return $this->collection($model->fraud_emails, new FraudEmailTransformer);
    }

    /**
    * Include fraudMobiles data and transform it
    * @param BaseModel $model
    * @return \League\Fractal\Resource\collection
    */
    public function includeFraudMobiles(FraudCase $model)
    {
        return $this->collection($model->fraud_mobiles, new FraudMobileTransformer);
    }

    /**
    * Include fraudWebsites data and transform it
    * @param BaseModel $model
    * @return \League\Fractal\Resource\collection
    */
    public function includeFraudWebsites(FraudCase $model)
    {
        return $this->collection($model->fraud_websites, new FraudWebsiteTransformer);
    }

    /**
    * Include User data and transform it
    * @param BaseModel $model
    * @return \League\Fractal\Resource\item
    */
    public function includeUser(FraudCase $model)
    {
        return $this->item($model->user, new UserTransformer);
    }

    /**
    * Include fraudCaseFiles data and transform it
    * @param Model $model
    * @return \League\Fractal\Resource\collection
    */
    public function includeFraudCaseFiles(FraudCase $model)
    {
        return $this->collection($model->fraud_casefiles, new FraudCaseFileTransformer);
    }

}