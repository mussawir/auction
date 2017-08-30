<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use DB;
use Auth;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

use App\Http\Controllers\Controller;
use App\Models\PraSubscribe;
use App\Models\Practitioner_product;
use App\Models\Patient;
use App\Models\MasterOrders;
use App\Models\Shipping;
use App\Models\Products;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\Orders;
use App\Models\Practitioner;
use App\Models\imageTable;
use App\Models\Notification;
use App\Models\ProductCategory;
use App\Models\scheduler;
use App\Models\accounts_transaction;
use App\Models\accounts_total_transactions;
use App\Http\Requests\ChangePassFormRequest;




class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	var $patient_info = null;
	
	
	public function SalesGraph(){
		return view('sales-graph')->with('role',Auth::user()->role);
	}
	public function queryData(){
		$role = '';
		if(Auth::user()->role=='1' || Auth::user()->role=='2'){
			$role = '2';
		}
		if(Auth::user()->role=='3'){
			$role = '2';
		}
		if(Auth::user()->role=='6'){
			$role = '3';
		}
		$start = $_POST['start_date'];
		$end = $_POST['end_date'];
		$data = DB::select("SELECT orders.order_id,DATE_FORMAT(accounts_total_transactions.created_at,'%m/%d/%Y') AS test,
CAST(accounts_total_transactions.amount AS DECIMAL(12,2)) AS amount,
/*orders.m_id,*/accounts_total_transactions.created_at
FROM accounts_total_transactions
LEFT JOIN orders ON  orders.order_id = accounts_total_transactions.order_id
WHERE 
DATE_FORMAT(accounts_total_transactions.created_at,'%m/%d/%Y')
BETWEEN '".$start."' AND '".$end."'
AND accounts_total_transactions.type = '".$role."'
GROUP BY test
"
);
$arr = array();
$arrM = array();
foreach($data as $items){
	$arr['data'] = $items->test;
	$arr['amount'] = $items->amount;
	array_push($arrM,$arr);
}
echo json_encode($arrM);
}
	
	public function ExecuteScalarOneCol($table,$col,$where,$colName){
		$whereCond = ' WHERE ' . $where.' LIMIT 1';
		if($where==''){
			$whereCond='';
		}
		$returnn = DB::select('SELECT '.$col.' as '.$colName.' FROM '.$table.$whereCond);
		$result = '';
		foreach($returnn as $items){
			$result = $items->$colName;
			break;
		}
		return $result;
	}
	public function setCKEditor(){
		
	}
	
    public function test() {
    	$request = new \AuthorizeNetARB;
		//	dd($request);
		return view('admin.admin')->with('request' , $request);


		}

		
		

	public function paymentauth(Request $reques) {
		
	require 'vendor/autoload.php';
	
		define("AUTHORIZENET_LOG_FILE", "phplog");

	$test = array($reques->card_number,
					$reques->card_customer_name, 
					$reques->card_type,
					$reques->card_exp_month,
					$reques->card_exp_year,
					$reques->card_cvc);

			$amount = $this->ExecuteScalarOneCol('cart','SUM(amount)' , 'pa_id = '.Auth::user()->user_id,'amount');
		
					
		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName("948d8mpUTx");
		$merchantAuthentication->setTransactionKey("945C4b6MeFEFp3kx"); 
		$refId = 'ref' . time();
		
		// Create the payment data for a credit card
		$creditCard = new AnetAPI\CreditCardType();
		$creditCard->setCardNumber($test[0]);
		$creditCard->setExpirationDate("20".$test[4]."-".$test[3]);
		$creditCard->setCardCode($test[5]);
		$paymentOne = new AnetAPI\PaymentType();
		$paymentOne->setCreditCard($creditCard);
		$cart = Cart::select('*')->where('pa_id',Auth::user()->user_id)->get();
		$this->patient_info = Patient::where('user_id', '=', Auth::user()->user_id)->first();
		 if(count($cart)){
            $master = new MasterOrders;
			$master->m_pa_id = Auth::user()->user_id;
            $master->save();
            Session::put('master_id',$master['m_id']);
		 }
		
		$order = new AnetAPI\OrderType($master['m_id']);
		$order->setDescription("New Item");
		
		     
		// Set the customer's Bill To address
		$customerAddress = new AnetAPI\CustomerAddressType();
		$customerAddress->setFirstName($this->patient_info->first_name);
		$customerAddress->setLastName($this->patient_info->last_name);
		$customerAddress->setCompany("Practice Tab");
		$customerAddress->setAddress($this->patient_info->billing_street_address);
		$customerAddress->setCity($this->patient_info->billing_city);
		$customerAddress->setState($this->patient_info->billing_state);
		$customerAddress->setZip($this->patient_info->billing_zip);
		//	$customerAddress->setCountry();
	
		// Set the customer's identifying information
		$customerData = new AnetAPI\CustomerDataType();
		$customerData->setType("individual");
		$customerData->setId(Auth::user()->user_id);
		$customerData->setEmail($this->patient_info->email);

		// Tax amount include
		/*	$tax = new AnetAPI\ExtendedAmountType();
			$transactionRequestType->setTax($tax);
		*/
		
		
		// Create a transaction
		$transactionRequestType = new AnetAPI\TransactionRequestType();
		$transactionRequestType->setBillTo($customerAddress);
		$transactionRequestType->setCustomer($customerData);
		$transactionRequestType->setTransactionType( "authCaptureTransaction"); 
		$transactionRequestType->setAmount(floatval($amount));
		$transactionRequestType->setPayment($paymentOne);
		
		
		//Process request
		$request = new AnetAPI\CreateTransactionRequest();
		$request->setMerchantAuthentication($merchantAuthentication);
		$request->setTransactionRequest( $transactionRequestType);
		$controller = new AnetController\CreateTransactionController($request);
		$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	
		if ($response != null )
		{
			$tresponse = $response->getTransactionResponse();

			if ($response != null) 
			{
				$tresponse = $response->getTransactionResponse();
							
							
				if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
				{
					$successfun = $this->PaymentConfirm($reques,$master,$cart,$this->patient_info);
					echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
					echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
					return Redirect::to('/patient/ecommerce/thank_you');
					
				}
				else
				{
					Session::put('error','Your card information is incorrect , kindly try again!');
					return Redirect::to('/patient/ecommerce/checkout_payment');
				}
			}
			else
			{
				Session::put('error','Your card information is incorrect , kindly try again!');
				return Redirect::to('/patient/ecommerce/checkout_payment');
				
			}
		}
	}
	public function AccountTransaction($amount,$user_id,$order_id,$transaction_no,$type){
		//type = 1 , practitioner
		//type = 2 , ptTeam
		//type = 3 , supplier
		$accounts_total_transaction = new accounts_total_transactions;
		$accounts_total_transaction->user_id = $user_id;
		$accounts_total_transaction->amount = $amount;
		$accounts_total_transaction->order_id = $order_id;
		$accounts_total_transaction->transaction_no = $transaction_no;
		$accounts_total_transaction->type = $type;
		$accounts_total_transaction->save();
	}
	public function PaymentConfirm($request,$master,$cart,$pa){
		$this->patient_info = $pa;
        $shipping = Session::get("shipping");
        if(count($cart)){
            foreach ($cart as $carts)
            {
                foreach ((array) $carts->products_id as $id){
                    $order = new Orders;
                    $order->products_id = $id;
                    $order->product_qty = $carts->qty;
                    $order->product_price = $carts->amount;
                    $order->pa_id = Auth::user()->user_id;
                    $order->pra_id = $carts->pra_id;
                    $order->shipping_amount = '0';
                    $order->delivery_date = date("Y-m-d", strtotime("+15 days"));
                    $order->product_tax = '0';
                    $order->tracking_number = 'PT_'.rand(111111111,999999999);
                    $order->order_number = rand(1111,9999);
                    $order->order_status = '0';
                    $order->m_id = $master['m_id'];
					$order->shipping_id = $shipping['shipping_id'];
					$order->credit_id = $request->card_id;
                    $order->save();
					$transactionNo = 'TR_'.rand(111111,999999);
					$productInfo = products::where('products_id',$id)->first();
					$practitioner = Practitioner::where('pra_id',$carts->pra_id)->first();
					$percentage = Practitioner_product::where('product_id',$id)->where('store_id',$practitioner->pra_id)->first();
					//NEW TRANSACTION START
					//PRACTITIONER
					$qty = $carts->qty;
					$price = $percentage->pra_price;
					$LeftOutprice = $price - $productInfo->price;
					$practitionerShare = ($LeftOutprice - $productInfo->ptProfit);
					$PTShare = $percentage->pra_price - ($practitionerShare + $productInfo->price);
					$discountP = $percentage->discountP;
					$this->AccountTransaction(($practitionerShare * $qty),$order['pra_id'],$order['order_id'],$transactionNo,1);
					//Admin
					$this->AccountTransaction(($PTShare * $qty),'0',$order['order_id'],$transactionNo,2);
					//Supplier
					$this->AccountTransaction(($productInfo->price*$qty),$productInfo->supplier_id,$order['order_id'],$transactionNo,3);
					//END
                    $transaction = new Transaction;
                    $transaction->transaction_number = $transactionNo;
                    $transaction->order_id = $order['order_id'];
                    $transaction->user_id = $order['pa_id'];
                    $transaction->amount = $order['product_price'];
                    $transaction->shipping_address = $shipping['addresss'];
                    $transaction->payment_id = rand(1111,9999);
                    $transaction->card_customer_name = $request->card_customer_name;
                    $transaction->card_type = $request->card_type;
                    $transaction->card_number = $request->card_number;
                    $transaction->card_cvc = $request->card_cvc;
                    $transaction->card_exp_month = $request->card_exp_month;
                    $transaction->card_exp_year = $request->card_exp_year;
                    $transaction->card_auth_code = rand(111,999);
                    $transaction->pra_id = $order['pra_id'];
                    $transaction->payment_status = 'paid';
                    $transaction->save();
					//Commission Calculation
					$accounts_transaction = new accounts_transaction;
					$map = $productInfo->map;
					$ptProfit = $productInfo->ptProfit;
					$praProfit = $productInfo->praProfit;
					$profitP = $productInfo->profitP;
					$pra_price = $percentage->pra_price;
					$cart_price = Cart::where('products_id',$id)->where('pa_id',Auth::user()->user_id)->first();
					if($pra_price <= $map){
						$less = ($praProfit/100)* $percentage->discountP;
						
						$results = ($praProfit - $less) * $cart_price->qty; 
						$accounts_transaction->amount = $results;
						$accounts_transaction->user_id=$practitioner->user_id;
						$accounts_transaction->order_id = $order['order_id']; 
						$accounts_transaction->products_id = $id;
						$accounts_transaction->pt_commission = $ptProfit * $cart_price->qty;
						$accounts_transaction->save();  
					}elseif($pra_price > $map){ 
						$increased = $pra_price - $map;
						$percent = $ptProfit/$map * 100;
						$results = $increased + $praProfit; 
						$add = ($results * $cart_price->qty)/100 * $percent;
						$accounts_transaction->amount = ($results * $cart_price->qty) - $add;   
						$accounts_transaction->user_id=$practitioner->user_id; 
						$accounts_transaction->order_id = $order['order_id'];
						$accounts_transaction->products_id = $id; 
						$accounts_transaction->pt_commission = ($ptProfit * $cart_price->qty) + $add;
						$accounts_transaction->save();
					}
					//Extra Data 
                    $patient = Patient::where('pa_id',Auth::user()->user_id)->first();
					$praUser = Practitioner::where('pra_id',$order['pra_id'])->first();
                    $products = Products::where('products_id',$id)->first();
					//Notification 
                    $notification = new Notification;
                    $notification->not_details = $patient->first_name.' bought '. $products->products_name;
                    $notification->not_type = '1';
                    $notification->not_link = $order['order_id'];
                    $notification->user_id = $praUser->user_id;
                    $notification->save();
					//Session
                    Session::push('transaction_number',$transaction['transaction_number']);
					$commission = DB::table('orders as Orders')
					->leftJoin('accounts_transaction','Orders.order_id', '=', 'accounts_transaction.order_id')
					->leftJoin('practitioners','Orders.pra_id', '=', 'practitioners.pra_id')
					->select('Orders.*','practitioners.*','accounts_transaction.amount')
					->where('Orders.order_id','=',$order['order_id'])
					->first();
					$data1 = [
					'commission'=>$commission,
					'patient_name'=>$this->patient_info->first_name . ' ' . $this->patient_info->last_name
					];
					$email = $commission->email;
					$subject = 'PracticeTabs . Commission';
					Mail::send(['html' => 'patient.email.commission'], $data1, function ($message) use ($email , $subject) {
					$message->from('postmaster@practicetabs.com', 'Practice Tabs');
					$message->to($email);
					$message->subject($subject);
					});
                }

            }
			$table1 = DB::table('orders as Orders')
			->leftJoin('products','Orders.products_id', '=', 'products.products_id')
			->leftJoin('suppliers','products.supplier_id', '=', 'suppliers.supplier_id')
			->select('Orders.*','products.products_name','suppliers.first_name as sup_fName' ,'suppliers.last_name as sup_lName')
			->where('Orders.m_id','=',$master['m_id'])
            ->get();		
			$data = [
			'table1'=>$table1,
			'patient_name'=>$this->patient_info->first_name . ' ' . $this->patient_info->last_name
						];
			$email = $this->patient_info->email;
            $subject = 'PracticeTabs . Thankyou for purchasing';
            Mail::send(['html' => 'patient.email.order-email'], $data, function ($message) use ($email , $subject) {
                $message->from('postmaster@practicetabs.com', 'Practice Tabs');
                $message->to($email);
                $message->subject($subject);
                });
            Cart::where('pa_id', '=',Auth::user()->user_id)->delete();
           // return Redirect::to('/patient/ecommerce/thank_you');
        }else{
            Session::put('error','Your cart is empty, kindly add products to cart first!');
            return Redirect::to('/patient/ecommerce/subscribed-stores');
        }

    }

}
