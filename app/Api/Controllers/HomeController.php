<?php

namespace App\Api\Controllers;

use App\Api\Models\Bank;
use App\Api\Models\Severity;
use App\Api\Models\ItemType;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Api\Models\FraudCategory;
use App\Http\Controllers\Controller;
use App\Api\Transformers\BankTransformer;
use App\Api\Transformers\SeverityTransformer;
use App\Api\Transformers\ItemTypeTransformer;
use App\Api\Transformers\FraudCaseTransformer;
use App\Api\Transformers\FraudCategoryTransformer;



class HomeController extends Controller
{
    use Helpers;


    /**
     * Fraud Case model instance
     *
     * @var FraudCase
     */
    private $fraudCase;

    /**
     * Item Type model instance
     *
     * @var ItemType
     */
    private $itemType;

    /** 
    * Gets the specified resource in storage.
    * GET /banks
    *
    * param Api\Models\Bank $bank
    * @return Response
    */
    public function getBanks(Bank $bank )
    {
        return ['banks' => $bank->all()];
    }

    /** 
    * Gets the specified resource in storage.
    * GET /severities
    *
    * param Api\Models\Severity $severity
    * @return Response
    */
    public function getSeverities(Severity $severity )
    {
        return ['severities' => $severity->all()];
    }

    /** 
    * Gets the specified resource in storage.
    * GET /itemtypes
    *
    * param Api\Models\ItemType $itemtype
    * @return Response
    */
    public function getItemTypes(ItemType $itemtype )
    {
        return ['itemtypes' => $itemtype->all()];
    }

    /** 
    * Gets the specified resource in storage.
    * GET /frauds/categories
    *
    * param Api\Models\FraudCategory $fraudcategory
    * @return Response
    */
    public function getFraudCategories(FraudCategory $fraudcategory)
    {
        return ['fraudcategories' => $fraudcategory->all()];
    }
}