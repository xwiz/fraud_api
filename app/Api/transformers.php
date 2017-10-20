<?php

$model = ['Authentication','User', 'Bank', 'FraudAccount', 'FraudCase', 'FraudCaseFile', 'FraudCategory', 'FraudEmail', 'FraudMobile', 'FraudWebsite', 'ItemType', 'Severity'];

foreach($model as $transformer)
{
    app('Dingo\Api\Transformer\Factory')->register('App\Api\Models\\'.$transformer, 'App\Api\Transformers\\'.$transformer.'Transformer');
}