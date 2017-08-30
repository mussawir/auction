<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\accounts_transaction;
use App\Models\User;
use App\Models\Orders;
use App\Models\Practitioner;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AccountsController extends Controller
{
    var $practitioner_info = null;
	var $logged_user = null;
	var $fullName = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
		$this->logged_user = User::where('user_id','=',Auth::user()->user_id)->first();
		$this->fullName = $this->logged_user->first_name .' '. $this->logged_user->last_name;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commission($fromDate=null,$toDate=null,$productId=null)
    {
		$AvailTags = DB::table('products')
		->leftJoin('Practitioner_product', 'Practitioner_product.product_id', '=', 'products.products_id')
		->select('products.*')
		->where('Practitioner_product.store_id','=',$this->practitioner_info->pra_id)
		->get();
		$dateFilter=false;
		$productFilter= false;
		if($fromDate!=null && $toDate==null) 
		{
			$toDate = $fromDate;
			$dateFilter = true;
		}
		if($fromDate==null && $toDate!=null) 
		{
			$fromDate=$toDate;
			$dateFilter = true;
		}
		if($fromDate!=null && $toDate!=null)
		{
			$dateFilter = true;
		}
		if($productId=='null'){
			$productId=null;
		}
		if($productId!=null) {
			$productFilter = true;
		}
		/*$accounts_transaction = DB::table('accounts_transaction')
            ->leftJoin('products', 'accounts_transaction.products_id', '=', 'products.products_id')
            ->leftJoin('orders', function ($join) {
                $join->on('orders.order_id', '=', 'accounts_transaction.order_id');
                $join->on('orders.products_id', '=', 'accounts_transaction.products_id');
            })
			->leftJoin('patients', 'orders.pa_id', '=', 'patients.user_id')
            ->select('accounts_transaction.*','products.products_name','patients.first_name as buy_firstName'
			,'patients.last_name as buy_lastName','orders.order_number'
			)
			->where('accounts_transaction.user_id',Auth::user()->user_id);*/
			$table = DB::select('SELECT orders.order_number,patients.last_name as buy_lastName,patients.first_name as buy_firstName,products.products_name,CAST((CAST(accounts_total_transactions.amount AS DECIMAL(12,2)) / CAST(orders.product_qty AS DECIMAL(12,2))) AS DECIMAL(12,2)) AS per_product_amount,orders.product_qty , accounts_total_transactions.* FROM accounts_total_transactions 
			LEFT JOIN orders ON orders.order_id = accounts_total_transactions.order_id
			LEFT JOIN products ON products.products_id = orders.products_id
			LEFT JOIN patients ON patients.user_id = orders.pa_id
			WHERE accounts_total_transactions.type = 1 AND accounts_total_transactions.user_id = '.$this->practitioner_info->pra_id.'
			');
			//->groupBy('cart_id')
			if($dateFilter)
			{
				$start = date("Y-m-d",strtotime($fromDate));
				$end = date("Y-m-d",strtotime($toDate));
				$accounts_transaction->whereBetween('accounts_transaction.created_at', array($start, $end));
			}
			if($productFilter)
			{
				$likeData = '%'.$productId.'%';
				$accounts_transaction->where('products.products_name', 'like', $likeData);
			}
			//$table = $accounts_transaction->get();

		$orders = Orders::where('pra_id',$this->practitioner_info->pra_id)->get();
		$commission = DB::table('accounts_total_transactions')
		->where('user_id',$this->practitioner_info->pra_id)
		->where('type','1')->sum('amount');
		//$table = accounts_transaction::where('user_id','=',Auth::user()->user_id);
		$pageTitle = $this->fullName.' Commission';
        $meta = array('page_title'=>$pageTitle, 'accounts'=>'active', 'accounts_comm'=>'active','store_main'=>'active');
        return view('practitioner.accounts_transaction.commission-report')->with('meta', $meta)->with('ecommerce','active')
		->with('practitioner_info',$this->practitioner_info)
		->with('logged_user',$this->fullName)
		->with('AvailTags',$AvailTags)
		->with('table', $table)
		->with('fromDate',$fromDate)
		->with('toDate',$toDate)
		->with('product',$productId)
		->with('orders',$orders)
		->with('commission',$commission)
		;
    }
	public function commission_details($id){
		
		/*$orders = DB::table('orders')
            ->leftJoin('products', 'orders.products_id', '=', 'products.products_id')
			->leftJoin('accounts_transaction', 'orders.order_id', '=', 'accounts_transaction.order_id')
           
            ->leftJoin('transaction', 'orders.order_id', '=', 'transaction.order_id')
            ->leftJoin('practitioners', 'orders.pra_id', '=', 'practitioners.pra_id')
			->leftJoin('patients', 'orders.pa_id', '=', 'patients.pa_id')
            ->leftJoin('settings', function ($join) {
                $join->on('practitioners.user_id', '=', 'settings.user_id')
                    ->where('settings.key', 'like', 'PRA%');
            })
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('orders.*','products.*','transaction.*','settings.*','suppliers.first_name as sup_firstname','suppliers.last_name as sup_lastname','accounts_transaction.amount','patients.first_name as pat_firstname','patients.last_name as pat_lastname')
			->where('orders.order_id',$id)
			->first();*/
		$orders = collect(\DB::select('SELECT 
		suppliers.first_name as sup_firstname,patients.last_name as pat_lastname,
		suppliers.last_name as sup_lastname,patients.first_name as pat_firstname,
		transaction.card_customer_name,transaction.card_type,transaction.card_number,transaction.shipping_address as t_shipping_address,
		products.*,orders.*,settings.*,accounts_total_transactions.amount as commissionAmount FROM accounts_total_transactions 
			LEFT JOIN orders ON orders.order_id = accounts_total_transactions.order_id
			LEFT JOIN products ON products.products_id = orders.products_id
			LEFT JOIN suppliers on suppliers.supplier_id = products.supplier_id
			LEFT JOIN patients ON patients.user_id = orders.pa_id
			LEFT JOIN practitioners ON practitioners.pra_id = orders.pra_id
			LEFT JOIN settings on settings.user_id = practitioners.user_id AND 
			settings.key LIKE "%PRA%"
			LEFT JOIN transaction on transaction.order_id = orders.order_id
			WHERE accounts_total_transactions.type = 1 AND accounts_total_transactions.user_id = '.$this->practitioner_info->pra_id.' AND accounts_total_transactions.order_id = '.$id))->first();
			$pageTitle = 'Commission | ' .$orders->products_name;
			$meta = array('page_title'=>$pageTitle, 'accounts'=>'active', 'accounts_comm'=>'active','store_main'=>'active');
        return view('practitioner.ecommerce.commssion_details')
		->with('practitioner_info',$this->practitioner_info)->with('order',$orders)->with('meta',$meta)->with('ecommerce','active');

		
	}
}
