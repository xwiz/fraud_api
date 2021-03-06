<?php

namespace App\Api\Controllers;

use Log;
use API;
use File;
use Image;
use JWTAUth;
use Storage;
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
                    throw new StoreResourceFailedException('Could not store fraud phone. '.  $this->fraudEmailModel->getErrorsInLine());
                }
                $fraud_mobile = FraudMobile::create($phone_num + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraud_mobiles()->attach($fraud_mobile->id);
            }
        }

        if (isset($data['fraud_file']))
        {
            // generate and concatenate 5 random characters to save as filename
            $sufix = array ('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U');
            $text =  $sufix[rand(0, 20)] . $sufix[rand(5, 17)] . $sufix[rand(0, 6)] . $sufix[rand(9, 19)] .  $sufix[rand(15, 20)];

            $img = Image::make($data['fraud_file'])->orientate();

            // concatenate random character with time and file extension
            $filename = $text . time().'.jpg';

            $filepath = 'files/fraud_file/'.$filename;
            // get the public folder directory
            $directorypath = public_path('files/fraud_file/');

            // if subdirectory ($directorypath) doesnt exist, create one 
            if(!File::exists($directorypath)){
                File::makeDirectory($directorypath, 0777, true);
            }

            //store file in created directory
            $filePath_store = $directorypath.$filename;
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
        return FraudCase::orderBy('id', 'desc')->get();
    }

    /**
    * Update the specified resource in storage
    * PUT /frauds/{id}
    *
    * @return Response
    */
    public function updateFraud(Request $request, FraudCaseFile $fraudCaseFile, FraudAccount $fraudAccount, FraudCase $fraudCase, FraudEmail $fraudEmail, FraudWebsite $fraudWebsite, FraudMobile $fraudMobile, $id)
    {
        $data = $request->all();

        $this->fraudCaseModel = $this->fraudCaseModel::find($id);

        if(!$this->fraudCaseModel->validate($data,'update'))
        {
            return Response::make(['error' => $this->fraudCaseModel->getErrors()], '422'); 
        }

        $this->fraudCaseModel->fill($data);
        $this->fraudCaseModel->save();

        if(isset($data['phoneData']))
        {
            $phones = json_decode($data['phoneData'], true);
            foreach($phones as $phone_num)
            {   
                if(!$this->fraudMobileModel->validate($phone_num,'update'))
                {
                    throw new StoreResourceFailedException('Could not store fraud phone. '.  $this->fraudEmailModel->getErrorsInLine());
                }


                if($phone_num['id'] != 0){
                    $updatenumber = FraudMobile::where('id', $phone_num['id'])->first();
                    $updatenumber->update($phone_num);

                }
                else {
                    $fraud_mobile = FraudMobile::create($phone_num + ['fraud_case_id' => $this->fraudCaseModel->id]);
                    $this->fraudCaseModel->fraud_mobiles()->attach($fraud_mobile->id);
                }
            }
        }


        if(isset($data['emailData']))
        {
            $emails = json_decode($data['emailData'], true);
            foreach($emails as $email)
            {
                if(!$this->fraudEmailModel->validate($email,'update'))
                {
                    throw new StoreResourceFailedException('Could not store fraud email. '.  $this->fraudEmailModel->getErrorsInLine());
                } 

                if($email['id'] != 0){
                    $updateemail = FraudEmail::where('id', $email['id'])->first();
                    $updateemail->update($email);

                }
                else {
                    $fraud_email = FraudEmail::create($email + ['fraud_case_id' => $this->fraudCaseModel->id]);
                    $this->fraudCaseModel->fraud_emails()->attach($fraud_email->id);
                }  
            }
        }

        if(isset($data['accountData']))
        {
            //todo: checks if json is passed
            $accounts = json_decode($data['accountData'], true);
            foreach($accounts as $account)
            {
                if(!$this->fraudAccountModel->validate($account, 'update'))
                {
                    throw new StoreResourceFailedException('Could not store fraud account. '.  $this->fraudAccountModel->getErrorsInLine());
                }

                if($account['id'] != 0){
                    $updateaccount = FraudAccount::where('id', $account['id'])->first();
                    $updateaccount->update($account);

                }
                else {
                    $fraud_account = FraudAccount::create($account + ['fraud_case_id' => $this->fraudCaseModel->id]);
                    $this->fraudCaseModel->fraud_accounts()->attach($fraud_account->id);
                }  
            }
        }

        if(isset($data['websiteData']))
        {
            $websites = json_decode($data['websiteData'], true);
            foreach($websites as $website)
            {
                \Log::info($website);
                if(!$this->fraudWebsiteModel->validate($website, 'update'))
                {
                    throw new StoreResourceFailedException('Could not store fraud website. '. $this->fraudWebsiteModel->getErrorsInLine());
                }

                if($website['id'] != 0){
                    $updatewebsite = FraudWebsite::where('id', $website['id'])->first();
                    $updatewebsite->update($website);

                }
                else {
                    $fraud_website = FraudWebsite::create($website + ['fraud_case_id' => $this->fraudCaseModel->id]);
                    $this->fraudCaseModel->fraud_websites()->attach($fraud_website->id);
                } 
            }
        }


        if (isset($data['fraud_file']))
        {

            // generate and concatenate 5 random characters to save as filename
            $sufix = array ('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U');
            $text =  $sufix[rand(0, 20)] . $sufix[rand(5, 17)] . $sufix[rand(0, 6)] . $sufix[rand(9, 19)] .  $sufix[rand(15, 20)];

            $img = Image::make($data['fraud_file'])->orientate();

            // concatenate random character with time and file extension
            $filename = $text . time().'.jpg';

            $filepath = 'files/fraud_file/'.$filename;
            // get the public folder directory
            $directorypath = public_path('files/fraud_file/');

            // if subdirectory ($directorypath) doesnt exist, create one 
            if(!File::exists($directorypath)){
                File::makeDirectory($directorypath, 0777, true);
            }

            //store file in created directory
            $filePath_store = $directorypath.$filename;
            $img->save($filePath_store);
            $data['fraud_file']=$filepath;
            $updatefile = FraudCaseFile::where('fraud_case_id', $this->fraudCaseModel->id)->first();
            $updatefile->update($website);
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
        return FraudCase::search($query)->groupBy('id')->orderBy('id', 'desc')->get();
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


    public function dataValidated(Request $request, FraudCaseFile $fraudCaseFile, FraudAccount $fraudAccount, FraudCase $fraudCase, FraudEmail $fraudEmail, FraudWebsite $fraudWebsite, FraudMobile $fraudMobile, $page_id)
    {
        $data = $request->except('_token');

        if($page_id == 1){
            if(!$this->fraudCaseModel->validate($data,'create1'))
            {
                return Response::json(['error' => $this->fraudCaseModel->getErrors()], '422');           
            }


            if(isset($data['emailData']))
            {
                $emails = json_decode($data['emailData'], true);
                foreach($emails as $email)
                {
                    if(!$this->fraudEmailModel->validate($email,'create'))
                    {
                        return Response::make(['error' => $this->fraudEmailModel->getErrors()], '422');
                    }
                    
                }
            }
            

            if(isset($data['phoneData']))
            {
                $phones = json_decode($data['phoneData'], true);
                foreach($phones as $phone_num)
                {
                    if(!$this->fraudMobileModel->validate($phone_num,'create'))
                    {
                        return Response::make(['error' => $this->fraudMobileModel->getErrors()], '422');
                    }
                    
                }
            }
        }


        else if($page_id == 2){

            if(!$this->fraudCaseModel->validate($data,'create2'))
            {
                return Response::make(['error' => $this->fraudCaseModel->getErrors()], '422');           
            }
            
            if(isset($data['accountData']))
            {
            //todo: checks if json is passed
                $accounts = json_decode($data['accountData'], true);
                foreach($accounts as $account)
                {
                    if(!$this->fraudAccountModel->validate($account, 'create'))
                    {
                        return Response::make(['error' => $this->fraudAccountModel->getErrors()], '422');
                    }
                }
            }
        }
        else if($page_id == 3){

            if(!$this->fraudCaseModel->validate($data,'create3'))
            {
                return Response::make(['error' => $this->fraudCaseModel->getErrors()], '422');           
            }
        }
        else if($page_id == 4){

            if(isset($data['websiteData']))
            {
                $websites = json_decode($data['websiteData'], true);
                foreach($websites as $website)
                {
                    if(!$this->fraudWebsiteModel->validate($website, 'create'))
                    {
                        return Response::make(['error' => $this->fraudWebsiteModel->getErrors()], '422');
                    }
                }
            }
        }
        else if($page_id == 5)

            if(!$this->fraudCaseModel->validate($data,'create4'))
            {
                return Response::make(['error' => $this->fraudCaseModel->getErrors()], '422'); 
            }
        }
    }
