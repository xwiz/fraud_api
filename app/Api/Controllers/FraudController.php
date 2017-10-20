<?php

namespace App\Api\Controllers;

use API;
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
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Dingo\Api\Exception\StoreResourceFailedException;

class FraudController extends Controller
{
    use Helpers;

    /**
     * Fraud Website model instance
     *
     * @var FraudWebsite
     */
    private $fraudWebsite;

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
     * Fraud Email model instance
     *
     * @var FraudEmail
     */
    private $fraudEmail;

    /**
     * Fraud Case model instance
     *
     * @var FraudCase
     */
    private $fraudCase;

    public function __construct(FraudAccount $fraudAccount, FraudCase $fraudCase, FraudEmail $fraudEmail, FraudWebsite $fraudWebsite, FraudMobile $fraudMobile)
    {
        $this->fraudCaseModel = $fraudCase;
        $this->fraudAccountModel = $fraudAccount;
        $this->fraudEmailModel = $fraudEmail;
        $this->fraudWebsiteModel = $fraudWebsite;
        $this->fraudMobileModel = $fraudMobile;
    }

    /*
    * Creates a new fraud case
    * POST /reportcase
    */
    public function storeFraud(Request $request, FraudAccount $fraudAccount, FraudCase $fraudCase, FraudEmail $fraudEmail, FraudWebsite $fraudWebsite, FraudMobile $fraudMobile)
    {
        $data = $request->except('_token');

        
    if(!$this->fraudCaseModel->validate($data,'create'))
        {
            throw new StoreResourceFailedException('Could not store fraud case. Errors: '. $this->fraudCaseModel->getErrorsInLine());
        }
    
        $this->fraudCaseModel->fill($data);
        $this->fraudCaseModel->save();
        $data['fraud_case_id'] = $this->fraudCaseModel->id;
        
        if(isset($data['email']))
        {
            foreach($data['email'] as $email)
        {
                $email_data = ['email' => $email];
            

                if(!$this->fraudEmailModel->validate($email_data,'create'))
                {
                    throw new StoreResourceFailedException('Could not create fraud case email. Errors: '.  $this->fraudEmailModel->getErrorsInLine());
                }
                $fraud_email = FraudEmail::create($email_data + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraudEmails()->attach($fraud_email->id);
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
                $this->fraudCaseModel->fraudAccounts()->attach($fraud_account->id);
            }
        }
        
        if(!$this->fraudWebsiteModel->validate($data,'create'))
        {
            throw new StoreResourceFailedException('Could not create fraud case. Errors: '.  $this->fraudWebsiteModel->getErrorsInLine());
        }

        if(isset($data['phone_number']))
        {
            foreach($data['phone_number'] as $phone_no)
        {
                $phone_num = ['phone_number' => $phone_no];
            
                if(!$this->fraudMobileModel->validate($phone_num,'create'))
                {
                    throw new StoreResourceFailedException('Could not create fraud case email. Errors: '.  $this->fraudEmailModel->getErrorsInLine());
                }
                $fraud_mobile = FraudMobile::create($phone_num + ['fraud_case_id' => $this->fraudCaseModel->id]);
                $this->fraudCaseModel->fraudMobiles()->attach($fraud_mobile->id);
            }
        }

        return $this->fraudCaseModel;
    }


    public function showFrauds()
    {

    }

    //todo: this method isnt working yet, to fix
    public function updateFraud(Request $request, $id)
    {
        $this->fraudCaseModel = $this->fraudCaseModel::find($id);
        $data = $request->except('_token');

        if(!$this->model->validate($data,$this->fraudcaseModel->rules,'update'))
        {
        throw new StoreResourceFailedException('Could not edit user. Errors: '. $this->model->getErrors());
        }

        $this->model->fill($data);
        $this->model->save();
        return $this->model;
    }


    /**
    * Delete a fraud case
    */
    public function deleteFraud(Request $request, $id)
    {
        $this->fraudCaseModel = $this->fraudCaseModel::find($id)->delete();
        return "Fraud Case ". $id ." Deleted Successfully";
    }



    public function searchCase()
    {

    }


}