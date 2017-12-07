<?php

namespace App\Api\Controllers;

use API;
use App\Api\Models\Contact;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;
use Dingo\Api\Exception\StoreResourceFailedException;

// use JWTAuth;
// use App\Api\Models\User;
// use Illuminate\Http\Request;
// use App\Api\Models\FraudCase;
// use Dingo\Api\Routing\Helpers;
// use App\Http\Controllers\Controller;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Response;
// use Dingo\Api\Exception\StoreResourceFailedException;




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

     /** 
    * POST /contact-us
    */
    function contact(Request $request, Contact $contact)
    {
        $data = $request->all();  
        $contact = new Contact();
        if(!$contact->validate($data,'create'))
        {
            throw new StoreResourceFailedException('Could not edit user. Errors: '. $contact->getErrorsInline());
        }
        $contact->fill($data);
        $contact->save();
        return $contact;
    }
 }