<?php

namespace App\Http\Controllers\Admin;

use App\Models\Orders;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
		//Auth::user()->user_id
		$orders = DB::select('
			SELECT totalAmt,m_id,productCount,maxDelivery , patients.first_name AS pa_first_name  , patients.last_name AS pa_last_name  FROM master_orders
			LEFT JOIN (
			SELECT m_id AS order_m_id,
			COUNT(orders.products_id) AS productCount , 
			MAX(orders.delivery_date) AS maxDelivery 
			/*,SUM(product_price * product_qty) AS totalAmt*/,SUM(accounts_total_transactions.amount) AS totalAmt FROM orders
			LEFT JOIN accounts_total_transactions ON  accounts_total_transactions.order_id = orders.order_id
			AND accounts_total_transactions.type = 2 AND accounts_total_transactions.user_id = 0
			GROUP BY order_m_id
			) AS orders ON orders.order_m_id = master_orders.m_id
			LEFT JOIN patients ON patients.pa_id = master_orders.m_pa_id
			WHERE productCount IS NOT NULL AND maxDelivery IS NOT NULL
			ORDER BY maxDelivery DESC');  
        $meta = array('page_title'=>'Orders', 'order_main_menu'=>'active','order_pt_profit'=>'active'); 

        return view('admin.orders.index')->with('table', $orders)->with('meta', $meta);
    }
	public function orderInvoice($id){ 
		$meta = array('page_title'=>'Orders', 'order_main_menu'=>'active','order_pt_profit'=>'active'); 
		$orders = DB::select('SELECT 
		shipping_address.first_name AS shipping_name_j,
		shipping_address.Address AS shipping_address_j,
		shipping_address.zip_code AS shipping_zip_j,
		shipping_address.Phone AS shipping_phone_j,
		credit_card_info.cardholder_name AS card_name_j,
		credit_card_info.card_number AS card_no_j,
		credit_card_info.payment_types AS card_type_j,
		credit_card_info.expiration_date_mm, credit_card_info.expiration_date_yy,
		credit_card_info.address AS billing_address_j,credit_card_info.zip_code AS billing_zip_j,
		patients.first_name, patients.last_name, patients.email, patients.primary_phone, 
		patients.mailing_street_address, patients.mailing_city, patients.mailing_zip, 
		patients.billing_city, patients.billing_zip, products.products_name, accounts_total_transactions.amount AS supplier_cost_amount
		,orders.* FROM orders LEFT JOIN products ON products.products_id = orders.products_id LEFT JOIN accounts_total_transactions 
		ON accounts_total_transactions.order_id = orders.order_id AND accounts_total_transactions.type = 2 AND 
		accounts_total_transactions.user_id = 0 LEFT JOIN patients ON patients.pa_id = orders.pa_id 
		LEFT JOIN shipping_address ON shipping_address.s_id = orders.shipping_id 
		LEFT JOIN credit_card_info ON credit_card_info.credit_id = orders.credit_id
		 where m_id = '.$id);
        return view('admin.orders.order-invoice')->with('meta', $meta)->with('orders',$orders)->with('invNo',$id);
	}
	public function orderDetails($id){
		 $orders = DB::select('SELECT patients.first_name, patients.last_name, patients.email, patients.primary_phone, patients.mailing_street_address, patients.mailing_city, patients.mailing_zip, patients.billing_street_address, patients.billing_city, patients.billing_zip, products.products_name,
		 accounts_total_transactions.amount as supplier_cost_amount,orders.* from orders
		 LEFT JOIN products on products.products_id = orders.products_id
		 LEFT JOIN accounts_total_transactions on accounts_total_transactions.order_id = orders.order_id
		 AND accounts_total_transactions.type = 2 AND accounts_total_transactions.user_id = 0
		 LEFT JOIN patients ON patients.pa_id = orders.pa_id  
		 where m_id = '.$id); 
		 
		 if(isset($orders)){
							echo '<div class="row" id="data-table-patient"><div class="alert alert-info">';
							foreach($orders as $item){
							  echo '<strong>First Name :</strong> '.$item->first_name;
							  echo '</br>';
							  echo '<strong>Last Name :	</strong> '.$item->last_name;
							  echo '</br>';
							  echo '<strong>Email : </strong> '.$item->email;
							  echo '</br>';
							  echo '<strong>Phone Number : </strong> '.$item->primary_phone;
							  echo '</br>';
							  break;
							}
echo '</div></div><div class="row"><table id="data-table-ajax" class="table table-hover"><thead><tr><th>Product Name</th><th>Qty * Amount</th><th>Status</th></tr></thead><tbody>';
			 foreach($orders as $items){
				echo '<tr>';
				echo '<td>';
				echo $items->products_name;
				echo '</td>';
				echo '<td>';
				echo $items->product_qty .' x ' . ($items->supplier_cost_amount/$items->product_qty);
				echo '</td>';
				echo '<td>';
				if($items->order_status=='2'){echo 'Process';}
				if($items->order_status=='1'){echo 'Shippied';}
				if($items->order_status=='0'){echo 'New';}
				echo '</td>';
				echo '</tr>';
			 }
			echo '</tbody></table></div>';
		 }
		//return view('supplier.product.order-detail')->with('orders' , $orders );
	 }
}
