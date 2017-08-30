<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Auth;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassFormRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Models\Practitioner;
use App\Models\Subscribers;
use App\Models\User;
use App\Models\PracticeProfile;
use App\Models\Hours;
use Illuminate\Support\Str;
use File;
use Response;

class RegistrationController extends Controller
{
    public function showPricingPage()
    {
        return view('registration.pricing'); 
    }

    public function showAccountPage()
    {
        $selected_plan_type = Session::has('plan_type') ? Session::get('plan_type') : Input::get('pricing_plan_type');
        Session::put('plan_type', $selected_plan_type);
        $plan_type = $this->getPlanType($selected_plan_type);

        return view('registration.account')->with('plan_type', $plan_type);
    }

    public function savePractitioner(Requests\PraRegFormRequest $request)
    {
        if(!Session::has('plan_type')) {
            return Redirect::Back();
        }

        $plan_type = Session::get('plan_type');
        $password = Str::quickRandom(8);
        $user = User::create([
            'role'  => 3,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password'  => bcrypt($password)
        ]);
    $directory = uniqid(strtolower($request->get('first_name')),false);
        $practitioner = Practitioner::create([
            'user_id'  => $user->user_id,
            'plan_type' => $plan_type,
            'directory' => $directory,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
			'url' => $directory,
        ]);
//create directory
        $path = public_path().'/images/practitioners/'.$directory;
        File::makeDirectory($path,0777, true, true);
        //File::makeDirectory(public_path().'/practitioners/'.$directory, 0777, true);

        $practice_profile = PracticeProfile::create([
            'pra_id'  => $practitioner->pra_id,
        ]);

        $hours = Hours::create([
            'pra_id'  => $practitioner->pra_id,
        ]);

        $this->sendEmail(array(
            'name' => ucwords($request->get('first_name')) .' '. ucwords($request->get('last_name')),
            'email' => $request->get('email'),
            'password'  => $password,
            'plan_type' => $this->getPlanType($plan_type),
            'package_payment'   => '$0'
        ));

        Session::forget('plan_type'); // remove by key

        Session::put('success', 'Thank you for registration. We have sent you an email with login details.');
        return Redirect::to('/users/practitioner/login');
    }

    public function newPractitioner(Request $request)
    {
        $inputs = $request->all();
    }

    private function sendEmail($data)
    {
        \Mail::send('registration.practitioner-email-template', $data, function ($message) use ($data) {

            $message->from('noreply@practicetabs.com', 'practicetabs.com');
            $message->to(trim($data['email']));
            $message->subject('Practitioner Registration');
        });
    }

    private function getPlanType($val)
    {
        if($val==1){
            return 'Free';
        } else if($val==2){
            return 'Premium';
        } else if($val==3){
            return 'Lite';
        } else {
            return NULL;
        }
    }

    public function showPaymentPage()
    {
        if(!Session::has('plan_type')) {
            return Redirect::to('/pricing');
        }
			$reg_info = Session::get('reg_info');
            $fname = $reg_info['first_name'];
            $lname = $reg_info['last_name'];
            $user_email = $reg_info['email'];
			
        $plan_type = $this->getPlanType(Session::get('plan_type'));
        return view('registration.payment')->with('plan_type', $plan_type)->with('fname',$fname )->with('lname', $lname)->with('user_email' , $user_email);
    }

	
    public function showAccountPaymentPage(Requests\PraRegFormRequest $request)
    {
        if(!Session::has('plan_type')) {
            return Redirect::to('/pricing');
        }
        Session::put('reg_info', $request->all());
        return Redirect::to('/registration/account/payment');
    }

	
	
	
	public function ChargePlanPraNew(Request $request) {
		
		require 'vendor/autoload.php';
		
			define("AUTHORIZENET_LOG_FILE", "phplog");	
			
		$test = array($request->cc_number,
						$request->cc_cvv, 
						$request->cc_type,
						$request->cc_month,
						$request->cc_year );
		
		
		$amount = 199.95;
		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName("948d8mpUTx");
		$merchantAuthentication->setTransactionKey("945C4b6MeFEFp3kx"); 
		$refId = 'ref' . time();

		// Create the payment data for a credit card
		$creditCard = new AnetAPI\CreditCardType();
		$creditCard->setCardNumber($test[0]);
		$creditCard->setExpirationDate($test[4]."-".$test[3]);
		$creditCard->setCardCode($test[1]);
		$paymentOne = new AnetAPI\PaymentType();
		$paymentOne->setCreditCard($creditCard);
		//$cart = Cart::select('*')->where('pa_id',Auth::user()->user_id)->get();
		
		
		$order = new AnetAPI\OrderType("Practitioner");
		$order->setDescription("New Item");
		
		/* Set the customer's Bill To address
		$customerAddress = new AnetAPI\CustomerAddressType();
		$customerAddress->setFirstName($this->patient_info->first_name);
		$customerAddress->setLastName($this->patient_info->last_name);
		$customerAddress->setCompany("Practice Tab");
		$customerAddress->setAddress($this->patient_info->billing_street_address);
		$customerAddress->setCity($this->patient_info->billing_city);
		$customerAddress->setState($this->patient_info->billing_state);
		$customerAddress->setZip($this->patient_info->billing_zip);
		//	$customerAddress->setCountry();
		*/
	
		// Set the customer's identifying information
		$customerData = new AnetAPI\CustomerDataType();
		$customerData->setType("individual");
		$customerData->setId("20");
		$customerData->setEmail($request->email);

		// Create a transaction
		$transactionRequestType = new AnetAPI\TransactionRequestType();
		//$transactionRequestType->setBillTo($customerAddress);
		$transactionRequestType->setCustomer($customerData);
		$transactionRequestType->setTransactionType( "authCaptureTransaction"); 
		$transactionRequestType->setAmount(floatval($amount));
		$transactionRequestType->setPayment($paymentOne);
		
		$requestCT = new AnetAPI\CreateTransactionRequest();
		$requestCT->setMerchantAuthentication($merchantAuthentication);
		$requestCT->setTransactionRequest( $transactionRequestType);
		$controller = new AnetController\CreateTransactionController($requestCT);
		$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

		if ($response != null)
		{
			$tresponse = $response->getTransactionResponse();
	

			if ($response != null) 
			{
				$tresponse = $response->getTransactionResponse();
							
							
				if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
				{
						$this->saveAccountPayment($request);
					echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
					echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
					//return Redirect::to('/patient/ecommerce/thank_you');
					Session::put('success', 'Thank you for registration. We have sent you an email with login details.');
					return Redirect::to('/users/practitioner/login');
					
				}
				else
				{
					Session::put('error','Your card information is incorrect , kindly try again!');
					 return Redirect::Back();
				}
			}
			else
			{
				Session::put('error','Your card information is incorrect , kindly try again!');
				//return Redirect::to('/patient/ecommerce/checkout_payment');
				
			}
		}
	}
	
	
	
	
    public function saveAccountPayment($request)
    {
		
		if(!Session::has('plan_type')) { 
        return Redirect::Back();
        } 
        $plan_type = Session::get('plan_type');
        $password = Str::quickRandom(8);
        $reg_info = Session::get('reg_info');
        $user = User::create([
            'role'  => 3,
            'first_name' => $reg_info['first_name'],
            'last_name' => $reg_info['last_name'],
            'email' => $reg_info['email'],
            'password'  => bcrypt($password)
        ]);

        $directory = uniqid(strtolower($reg_info['first_name']),false);
        $practitioner = Practitioner::create([
            'user_id'  => $user->user_id,
            'plan_type' => $plan_type,
			'first_name'=>$reg_info['first_name'],
			'last_name' =>	$reg_info['last_name'] ,
			'email'=>	$reg_info['email'],
            'directory' => $directory,
			'url' => $directory,
            'cc_type'   => $request['cc_type'],
            'cc_number' => $request['cc_number'],
            'cc_cvv'    => $request['cc_cvv'],
            'cc_month'  => $request['cc_month'],
            'cc_year'   => $request['cc_year']
        ]);
		
						
		//dd($verify_email);
        //create directory
        $path = public_path().'/images/practitioners/'.$directory;
        File::makeDirectory($path,0777, true, true);

        $practice_profile = PracticeProfile::create([
            'pra_id'  => $practitioner->pra_id,
        ]);

        $hours = Hours::create([
            'pra_id'  => $practitioner->pra_id,
        ]);

        $package_payment = 0;
        if($plan_type == 2) {
            $package_payment = 89.95;
        } else if($plan_type == 3){
            $package_payment = 19.95;
        }

        $this->sendEmail(array(	
            'name' => ucwords($reg_info['first_name']) .' '. ucwords($reg_info['last_name']),
            'email' => $reg_info['email'],
            'password'  => $password,
            'plan_type' => $this->getPlanType($plan_type),
            'package_payment'   => '$'.$package_payment
        ));

        Session::forget('plan_type'); // remove by key
        Session::forget('reg_info'); // remove by key

        Session::put('success', 'Thank you for registration. We have sent you an email with login details.');
        //return Redirect::to('/users/practitioner/login');
		return;
	}
	
	public function downloadPDF(Request $request){
		$subscribers = new Subscribers;
		$subscribers->sub_name = $request->full_name;
		$subscribers->sub_email = $request->email;
		$subscribers->save();
		$file="public/homepage/Testing.pdf";
        return Response::download($file);
	}
}
