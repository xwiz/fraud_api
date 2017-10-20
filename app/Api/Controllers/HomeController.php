<?php

namespace App\Api\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\Models\Bank;
use App\Api\Models\Severity;
use App\Api\Models\ItemType;
use App\Api\Models\FraudCategory;
use App\Api\Transformers\BankTransformer;
use App\Api\Transformers\SeverityTransformer;
use App\Api\Transformers\ItemTypeTransformer;
use App\Api\Transformers\FraudCategoryTransformer;



class HomeController extends Controller
{
    use Helpers;

    /** 
    * Gets the specified resource in storage.
    * GET banks
    *
    * param Api\Models\Bank $bank
    * @return Response
    */
    public function getBanks(Bank $bank )
    {
        return $bank->all();
    }

    /** 
    * Gets the specified resource in storage.
    * GET Severities
    *
    * param Api\Models\Severity $severity
    * @return Response
    */
    public function getSeverities(Severity $severity )
    {
        return $severity->all();
    }

    /** 
    * Gets the specified resource in storage.
    * GET ItemTypes
    *
    * param Api\Models\ItemType $itemtype
    * @return Response
    */
    public function getItemTypes(ItemType $itemtype )
    {
        return $itemtype->all();
    }

    /** 
    * Gets the specified resource in storage.
    * GET FraudCategories
    *
    * param Api\Models\FraudCategory $fraudcategory
    * @return Response
    */
    public function getFraudCategories(FraudCategory $fraudcategory)
    {
        return $fraudcategory->all();
    }
}