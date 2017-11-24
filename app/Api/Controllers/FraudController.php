<?php

namespace App\Api\Controllers;

use API;
use Image;
use JWTAUth;
use Validator;
use App\Api\Models\User;
use Illuminate\Http\Request;
use App\Api\Models\FraudCase;
use App\Api\Models\FraudEmail;
use Dingo\Api\Routing\Helpers;
use App\Api\Models\FraudMobile;
use App\Api\Models\FraudWebsite;
use App\Api\Models\FraudAccount;
use App\Api\Models\FraudCaseFile;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;
use Dingo\Api\Exception\StoreResourceFailedException;

class FraudController extends Controller
{
    use Helpers;

    /**
     * Fraud Case model instance
     *
     * @var FraudCase
     */
    private $fraudCase;
    
    /**
     * Fraud Email model instance
     *
     * @var FraudEmail
     */
    private $fraudEmail;
    
    /**
     * Fraud Mobile model instance
     *
     * @var FraudMobile
     */
    private $fraudMobile;
    
    /**
     * Fraud Account model instance
     *
     * @var FraudAccount
     */
    private $fraudAccount;
    
    /**
     * Fraud Website model instance
     *
     * @var FraudWebsite
     */
    private $fraudWebsite;
    
    /**
     * Class constructor
     *
     * @param User $userModel
     * @param FraudCase $fraudCase
     * @param FraudEmail $fraudEmail
     * @param FraudMobile $fraudMobile
     * @param FraudWebsite $fraudWebsite
     * @param FraudAccount $fraudAccount
     * @param FraudCaseFile $fraudCaseFile
     */
    public function __construct(FraudCaseFile $fraudCaseFile, FraudAccount $fraudAccount, FraudCase $fraudCase, FraudEmail $fraudEmail, FraudWebsite $fraudWebsite, FraudMobile $fraudMobile)
    {
        $this->fraudCaseModel = $fraudCase;
        $this->fraudEmailModel = $fraudEmail;
        $this->fraudMobileModel = $fraudMobile;
        $this->fraudWebsiteModel = $fraudWebsite;
        $this->fraudAccountModel = $fraudAccount;
        $this->fraudCaseFileModel = $fraudCaseFile;
    }

    /**
    * Creates a new fraud case
    * POST /frauds
    *
    * @return Response
    */
    public function storeFraud(Request $request, FraudCaseFile $fraudCaseFile, FraudAccount $fraudAccount, FraudCase $fraudCase, FraudEmail $fraudEmail, FraudWebsite $fraudWebsite, FraudMobile $fraudMobile)
    {
        $data = $request->except('_token');
        if(!$this->fraudCaseModel->validate($data,'create'))
        {
            return Response::make(['error' => $this->fraudCaseModel->getErrors()], '422'); 
        }

        $this->fraudCaseModel->fill($data); 
        $this->fraudCaseModel->save(); 
        $data['fraud_case_id'] = $this->fraudCaseModel->id;
        
        if(isset($data['emailData']))
        {
            $emails = json_decode($data['emailData'], true);
            foreach($emails as $email)
            {
                if(!$this->fraudEmailModel->validate($email,'create'))
                {
                    throw new StoreResourceFailedException('Could not store fraud email. '.  $this->fraudEmailModel->getErrorsInLine());
                }
                $fraud_email = FraudEmail::create($email + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraud_emails()->attach($fraud_email->id);
            }
        }

        if(isset($data['accountData']))
        {
            //todo: checks if json is passed
            $accounts = json_decode($data['accountData'], true);
            foreach($accounts as $account)
            {
                if(!$this->fraudAccountModel->validate($account, 'create'))
                {
                    throw new StoreResourceFailedException('Could not store fraud account. '.  $this->fraudAccountModel->getErrorsInLine());
                }
                $fraud_account = FraudAccount::create($account + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraud_accounts()->attach($fraud_account->id);
            }
        }
        
        if(isset($data['websiteData']))
        {
            $websites = json_decode($data['websiteData'], true);
            foreach($websites as $website)
            {
                if(!$this->fraudWebsiteModel->validate($website, 'create'))
                {
                    throw new StoreResourceFailedException('Could not store fraud website. '. $this->fraudWebsiteModel->getErrorsInLine());
                }
                $fraud_website = FraudWebsite::create($website + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraud_websites()->attach($fraud_website->id);
            }
        }

        if(isset($data['phoneData']))
        {
            $phones = json_decode($data['phoneData'], true);
            foreach($phones as $phone_num)
            {
                if(!$this->fraudMobileModel->validate($phone_num,'create'))
                {
                    throw new StoreResourceFailedException('Could not store fraud email. '.  $this->fraudEmailModel->getErrorsInLine());
                }
                $fraud_mobile = FraudMobile::create($phone_num + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraud_mobiles()->attach($fraud_mobile->id);
            }
        }

        if (isset($data['fraud_file']))
        {
            $img = Image::make($data['fraud_file'])->encode('jpg', 75);
            $filename = time().'.jpg';
            $filepath = 'files/fraud_file/'.$filename;
            $filePath_store = $_SERVER['DOCUMENT_ROOT'].'/files/fraud_file/'.$filename;
            $img->save($filePath_store);
            $data['fraud_file']=$filepath;
            $fraud_file = FraudCaseFile::create(['picture_url' => $filepath ,'is_fraudster_picture' => $data['is_fraudster_picture'], 'fraud_case_id' => $this->fraudCaseModel->id]);
        }

        return $this->fraudCaseModel;


    }


    /**
    * Retrieve all FraudCases from the storage.
    * GET /frauds
    *
    * @return Response
    */
    public function showFrauds()
    {
        return FraudCase::all();
    }

    /**
    * Update the specified resource in storage
    * PUT /frauds/{id}
    *
    * @return Response
    */
    public function updateFraud(Request $request, $id, FraudAccount $fraudAccount, FraudCase $fraudCase, FraudEmail $fraudEmail, FraudWebsite $fraudWebsite, FraudMobile $fraudMobile)
    {
        $this->fraudCaseModel = $this->fraudCaseModel::find($id);
        $data = $request->all();

        if(!$this->fraudCaseModel->validate($data,'create'))
        {
            throw new StoreResourceFailedException('Could not store fraud case. Errors: '. $this->fraudCaseModel->getErrorsInLine());
        }

        $this->fraudCaseModel->fill($data); 
        $this->fraudCaseModel->save();

        if(isset($data['email']))
        {
            $emails = json_decode($data['email'], true);
            foreach($emails as $email)
            {
                if(!$this->fraudEmailModel->validate($email,'create'))
                {
                    throw new StoreResourceFailedException('Could not create fraud case email. Errors: '.  $this->fraudEmailModel->getErrorsInLine());
                }
                $fraud_email = FraudEmail::create($email + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraud_emails()->attach($fraud_email->id);
            }
        }

        if(isset($data['account']))
        {
            //todo: checks if json is passed
            $accounts = json_decode($data['account'], true);
            foreach($accounts as $account)
            {
                if(!$this->fraudAccountModel->validate($account, 'create'))
                {
                    throw new StoreResourceFailedException('Could not create fraud case account. Errors: '.  $this->fraudAccountModel->getErrorsInLine());
                }
                $fraud_account = FraudAccount::create($account + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraud_accounts()->attach($fraud_account->id);
            }
        }
        
        if(isset($data['website_url']))
        {
            $websites = json_decode($data['website_url'], true);
            foreach($websites as $website)
            {
                if(!$this->fraudWebsiteModel->validate($website, 'create'))
                {
                    throw new StoreResourceFailedException('Could not create fraud case website. Erros: '. $this->fraudWebsiteModel->getErrorsInLine());
                }
                $fraud_website = FraudWebsite::create($website + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraud_websites()->attach($fraud_website->id);
            }
        }

        if(isset($data['phone_number']))
        {
            $phones = json_decode($data['phone_number'], true);
            foreach($phones as $phone_num)
            {
                if(!$this->fraudMobileModel->validate($phone_num,'create'))
                {
                    throw new StoreResourceFailedException('Could not create fraud case email. Errors: '.  $this->fraudEmailModel->getErrorsInLine());
                }
                $fraud_mobile = FraudMobile::create($phone_num + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraud_mobiles()->attach($fraud_mobile->id);
            }
        }

        if (isset($data['fraud_file']))
        {
            $img = Image::make($data['fraud_file'])->encode('jpg', 75);
            $filename = time().'.jpg';
            $filepath = 'files/fraud_file/'.$filename;
            $filePath_store = $_SERVER['DOCUMENT_ROOT'].'/files/fraud_file/'.$filename;
            $img->save($filePath_store);
            $data['fraud_file']=$filepath;
            $fraud_file = FraudCaseFile::create(['picture_url' => $filepath ,'fraud_case_id' => $this->fraudCaseModel->id]);
        }
        
        return $this->fraudCaseModel;
    }
    
    /**
    * Remove the specified resource from storage.
    * DELETE frauds/{id}
    *
    * @param  $id
    * @return Response
    */
    public function deleteFraud(Request $request, $id)
    {
        $this->fraudCaseModel = $this->fraudCaseModel::find($id)->delete();
        return "Fraud Case ". $id ." Deleted Successfully";
    }

    
    /**
    * Search the resource.
    * GET frauds/search?keyword=
    *
    * @param $request
    * @return Response
    */
    public function searchFraud(Request $request)
    {
        $query = $request->get('keyword');
        return FraudCase::search($query)->get();
    }

    /**
    * Reterive a fraudcase
    *GET frauds/{fraud}
    * @param $request
    * @return Response
    */
    public function fraud(Request $request,FraudCase $fraudCase, $id)
    {
        $this->fraudCaseModel = $this->fraudCaseModel::find($id);
        return FraudCase::where('id', $id)->first();
    }
}