<?php
namespace App\Http\Controllers\Patient;

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
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePassFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Models\scheduler;
use App\Models\accounts_transaction;
use Illuminate\Support\Facades\Mail;

/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class EcommerceController extends Controller
{
    var $patient_info = null;
    public function __construct()
    {
        $this->patient_info = Patient::where('user_id', '=', Auth::user()->user_id)->first();
        $data =  DB::table('cart')
            ->leftJoin('products', 'cart.products_id', '=', 'products.products_id')
            ->select('cart.*','products.*')->where('pa_id',$this->patient_info->user_id)->groupBy('cart_id')->get();
        Session::put('cart',$data);

    }
    public function index() 
    {
        return view('patient.ecommerce.index');
    }

    public function checkout(){
        $product = DB::table('cart')
            ->leftJoin('products', 'cart.products_id', '=', 'products.products_id')
            ->leftJoin('imageTable', function ($join) {
                $join->on('cart.products_id', '=', 'imageTable.refId')
                    ->where('imageTable.table', '=', 'products');
            })
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->leftJoin('Practitioner_product', function ($join) {
                $join->on('cart.products_id', '=', 'Practitioner_product.product_id');
                $join->on('cart.pra_id', '=', 'Practitioner_product.store_id');
            })
            ->select('cart.*','products.*','imageTable.*','Practitioner_product.discountP as pra_discount')->where('pa_id',$this->patient_info->user_id)->groupBy('cart_id')->get();

        return view('patient.ecommerce.cart-wizart')->with('products',$product);
    }

    public  function stores(){

//        $stores = DB::table('practitioners')
//            ->whereNotIn('pra_id',function ($query) {
//                $query->select('pra_id')->where('isApproved','1')->from('pra_subscribe');
//            })
//            ->get();
//        $stores =  DB::table('practitioners')
//            ->leftJoin('pra_subscribe', 'practitioners.pra_id', '=', 'pra_subscribe.pra_id')
//            ->select('practitioners.*','pra_subscribe.isApproved')->where('pra_subscribe.isApproved','0')->orWhere('pra_subscribe.isApproved',null)
//            ->get();
        $stores =  DB::table('practitioners')
            ->leftJoin('pra_subscribe', 'practitioners.pra_id', '=', 'pra_subscribe.pra_id')
            ->leftJoin('settings', 'practitioners.user_id', '=', 'settings.user_id')
            ->select('practitioners.*','pra_subscribe.isApproved','settings.*')->where('pra_subscribe.isApproved','0')->orWhere('pra_subscribe.isApproved',null)
            ->orderBy('id', 'asc')
            ->paginate(10);
		/*$storesEdit = DB::table('practitioners')
		->join('settings', function ($join) {
            $join->on('practitioners.user_id', '=', 'settings.user_id')
                 ->where('settings.key', '=', 'CONCAT("PRA_"practitioners.pra_id"_STORE"');
        })
		->select('practitioners.*')
		->get();
		dd($storesEdit);*/
        return view('patient.ecommerce.stores')->with('meta', array('page_title'=>'Stores List'))->with('stores',$stores)->with('subscribe','active');
    }
    public function addItem(Request $request) {
		
		$checked = PraSubscribe::where('pra_id',$request->id)->where('pa_id',$this->patient_info->pa_id)->where('store_code',$request->store_code)->count();
		if($checked > 0){
			$subscribe = PraSubscribe::where('pra_id',$request->id)->where('pa_id',$this->patient_info->pa_id)->where('store_code',$request->store_code)->first();
        
        $subscribe->isApproved = '1';
        $subscribe->save();
        Session::put('success','Store has been successfully subscribed!');
		}else{
			Session::put('error','Please enter valid store code!');
		}
        

        return Redirect::Back();
    }
    public  function subscribed(){

//        $stores = DB::table('practitioners')
//            ->whereNotIn('pra_id',function ($query) {
//                $query->select('pra_id')->where('isApproved','1')->from('pra_subscribe');
//            })
//            ->get();
        Session::forget('category_filter');
        $stores =  DB::table('practitioners')
            ->leftJoin('pra_subscribe', 'practitioners.pra_id', '=', 'pra_subscribe.pra_id')
            ->leftJoin('settings', 'practitioners.user_id', '=', 'settings.user_id')
            ->select('practitioners.*','pra_subscribe.isApproved','settings.*')->where('pra_subscribe.isApproved','1')
            ->where('pra_subscribe.pa_id',$this->patient_info->pa_id)
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('patient.ecommerce.subscribed')->with('meta', array('page_title'=>'Stores List'))->with('stores',$stores)->with('subscribe', 'active');
    }
    public function products($id){

        $category = Session::get('filter_category');
		$products_name = Session::get('filter_products_name');
        if(isset($category) && $category != null){
            $selected_category = DB::table('categories')->where('cat_id',$category)->first();
            $categories = DB::table('categories')->get();
            /*$products = DB::table('Practitioner_product')
                ->leftJoin('products', 'Practitioner_product.product_id', '=', 'products.products_id')
                ->leftJoin('imageTable', 'imageTable.refId', '=', 'Practitioner_product.product_id')
                ->select('Practitioner_product.*','products.*','imageTable.*')->where('store_id',$id)->where('products.cat_id',$category)->groupBy('product_id')
                ->paginate(10);*/
				
			$productFilter = DB::table('products')
			->leftJoin('Practitioner_product', 'Practitioner_product.product_id', '=', 'products.products_id')
			->where('store_id',$id)
			->whereRaw('FIND_IN_SET('.$category.',products.cat_id)')
			->paginate(10);
            Session::forget('filter_category');
            $store = Practitioner::where('pra_id',$id)->first();
            return view('patient.products')->with('products',$productFilter)->with('store',$store)->with('categories',$categories)->with('selected',$selected_category);
        }elseif(isset($products_name) && $products_name != null){
            
            $categories = DB::table('categories')->get();
            /*$products = DB::table('Practitioner_product')
                ->leftJoin('products', 'Practitioner_product.product_id', '=', 'products.products_id')
                ->leftJoin('imageTable', 'imageTable.refId', '=', 'Practitioner_product.product_id')
                ->select('Practitioner_product.*','products.*','imageTable.*')->where('store_id',$id)->where('products.cat_id',$category)->groupBy('product_id')
                ->paginate(10);*/
				
			$productFilter = DB::table('products')
			->leftJoin('Practitioner_product', 'Practitioner_product.product_id', '=', 'products.products_id')
			->where('store_id',$id)
			->where('products_name', 'like', '%'.$products_name.'%')
			->paginate(10);
            Session::forget('filter_products_name');
            $store = Practitioner::where('pra_id',$id)->first();
            return view('patient.products')->with('products',$productFilter)->with('store',$store)->with('categories',$categories)->with('products_name',$products_name);;
        }
		else{
            $categories = DB::table('categories')->get();
            $products = DB::table('Practitioner_product')
                ->leftJoin('products', 'Practitioner_product.product_id', '=', 'products.products_id')
                ->leftJoin('imageTable', 'imageTable.refId', '=', 'Practitioner_product.product_id')
                ->select('Practitioner_product.*','products.*','imageTable.*')->where('store_id',$id)->groupBy('product_id')
                ->paginate(10);
            $store = Practitioner::where('pra_id',$id)->first();
            return view('patient.products')->with('products',$products)->with('store',$store)->with('categories',$categories);
        }
    }

    public function view_product($store_id,$product_id){
		$value = 'PRA_'.$store_id.'_STORE';
        $product = DB::table('products')
		->leftJoin('Practitioner_product', 'Practitioner_product.product_id', '=', 'products.products_id')
            //->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
			->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
			->leftJoin('practitioners', 'Practitioner_product.store_id', '=', 'practitioners.pra_id')
			->leftJoin('settings', 'practitioners.user_id', '=', 'settings.user_id')
            //->select('products.*','categories.*','Practitioner_product.*','suppliers.first_name','suppliers.last_name','settings.value')->where('products_id',$product_id)->where('Practitioner_product.store_id',$store_id)
			->select('products.*','Practitioner_product.*','suppliers.first_name','suppliers.last_name','settings.value')
			->where('products.products_id',$product_id)
			->where('Practitioner_product.store_id',$store_id)
			->where('settings.key',$value)->first();
        $images = imageTable::where('refId',$product_id)->where('table','products')->get();
		
        return view('patient.ecommerce.view_product')->with('product',$product)->with('image',$images)->with('store_id',$store_id);

    }
    public function cart(Request $request){
        $product = Practitioner_product::where('product_id',$request->products_id)->where('store_id',$request->store_id)->first();
        $check = Cart::where('products_id',$request->products_id)
		->where('pa_id','=',$this->patient_info->user_id)->where('pra_id','=',$request->store_id)
		->first();
        //$discount = $product->price - ($product->price * ($product->discountPer / 100));
        if(count($check)){
            $cart = Cart::where('products_id',$request->products_id)
			->where('pa_id','=',$this->patient_info->user_id)
			->first();
            $cart->qty = $cart->qty + $request->quantity;
            $cart->amount = $cart->amount + ($product['pra_price'] * $request->quantity);
            $cart->save();
        }else{
            $cart = new Cart;
            $cart->products_id = $request->products_id;
            $cart->qty = $request->quantity;
            $cart->pa_id = $this->patient_info->user_id;
            $cart->pra_id = $request->store_id;
            $product_total = $product['pra_price'] * $request->quantity;
            $cart->amount = $product_total;
            $cart->pra_id = $request->store_id;
            $cart->save();
        }
        return Redirect::to('/patient/ecommerce/checkout_cart');
    }

    public function checkout_cart(){

        $product = DB::table('cart')
            ->leftJoin('products', 'cart.products_id', '=', 'products.products_id')
            ->leftJoin('imageTable', function ($join) {
                $join->on('cart.products_id', '=', 'imageTable.refId')
                    ->where('imageTable.table', '=', 'products');
            })
			->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->leftJoin('Practitioner_product', function ($join) {
                $join->on('cart.products_id', '=', 'Practitioner_product.product_id');
                $join->on('cart.pra_id', '=', 'Practitioner_product.store_id');
            })
            ->select('cart.*','products.*','imageTable.*','Practitioner_product.*')->where('pa_id',$this->patient_info->user_id)->groupBy('cart_id')->get();

        return view('patient.ecommerce.checkout_cart')->with('products',$product);


    }

    public function save_cart(Request $request){
		$id = count($request->quantity);
		$length = count($request->products_id);
		for ($i = 0; $i < $length; $i++) {
		   for ($p = 0; $p < $length; $p++) {
			   
			   $practitioner = Cart::where('products_id',$request->products_id[$i])->where('pa_id',$this->patient_info->user_id)->first();
			  
			   $product = Practitioner_product::where('product_id',$request->products_id[$i])->where('store_id',
			   $practitioner['pra_id'])->first();
			  $product_total = $product['pra_price'] * $request->quantity[$p];
              $cart = Cart::where('pa_id',$this->patient_info->user_id)->where('products_id',$request->products_id[$i])->first();
              $cart->amount = $product_total;
              $cart->qty = $request->quantity[$p];
              $cart->save();

			   //$products = 1 + $request->products_id[$i];
			   //dd($products);
		   //print_r($request->quantity[$p].' has '.$request->products_id[$i].'<br>');
		   $i++;
		}
		}
	return Redirect::to('/patient/ecommerce/checkout_info');
		
    }

    public function checkout_info(){
		
        $cart = Cart::where('pa_id',$this->patient_info->user_id)->get();
        if(count($cart)){
            //$info = Shipping::where('pa_id',$this->patient_info->user_id)->first();
			$info='';
			$shippingAdd = DB::select('SELECT * FROM shipping_address WHERE shipping_address.type = 1 AND pa_id = '.$this->patient_info->user_id);
            return view('patient.ecommerce.checkout_info')->with('info',$info)->with('shippingAdd',$shippingAdd);
        }
        else{
            Session::put('error','Your cart is empty, kindly add products to cart first!');
            return Redirect::to('/patient/ecommerce/subscribed-stores');
        }
    }
    public function save_shipping(Request $request){
			$new_id = $request->ship_id;
			//dd($new_id);
        Session::put("shipping", ['first_name'=>$request->first_name, 'last_name'=>$request->last_name,'phone'=>$request->Phone,'addresss'=>$request->Address,'zip_code'=>$request->zip_code,'shipping_id'=>$new_id]);

        return Redirect::to('/patient/ecommerce/checkout_payment');
    }

    public function checkout_payment(){

        $cart = Cart::where('pa_id',$this->patient_info->user_id)->get();
		$creditCard = DB::select('SELECT * FROM credit_card_info WHERE user_id = '.$this->patient_info->user_id);
        if(count($cart)){
            return view('patient.ecommerce.payment')->with('creditCard',$creditCard);
        }
        else{
            Session::put('error','Your cart is empty, kindly add products to cart!');
            return Redirect::to('/patient/ecommerce/subscribed-stores');
        }
    }

    public function remove_product($id)
    {
        $contact = Cart::where('cart_id',$id)->first();
        if(isset($contact)){

            $contact->delete();

            echo 'success';
        }else{
            echo 'error';
		}
    }


    public function thank_you(){

        $trans =  DB::table('master_orders')
            ->leftJoin('orders','master_orders.m_id', '=', 'orders.m_id')
            ->select('master_orders.*',DB::raw("count(orders.order_id) as total_products"),DB::raw("avg(orders.order_status) as average"))->where('master_orders.m_id',Session::get('master_id'))
            ->get();

//        $trans = DB::table('transaction')
//            ->leftJoin('orders', 'transaction.order_id', '=', 'orders.order_id')
//            ->leftJoin('products', 'orders.products_id', '=', 'products.products_id')
//            ->select('transaction.*','orders.*','products.*')->whereIn('transaction_number',Session::get('transaction_number'))->get();
        if(count($trans)){
            Session::forget('master_id');
            return view('patient.ecommerce.thankyou')->with('trans',$trans);
        }else{
            Session::put('error','Your cart is empty, kindly add products to cart first!');
            return Redirect::to('/patient/ecommerce/subscribed-stores');
        }

    }

    public function pending_orders(){

//        $orders = DB::table('orders')
//            ->leftJoin('products', 'orders.products_id', '=', 'products.products_id')
//            ->leftJoin('imageTable', function ($join) {
//                $join->on('products.products_id', '=', 'imageTable.refId')
//                    ->where('imageTable.table', '=', 'products');
//            })
//            ->select('orders.*','products.*','imageTable.*')->where('pa_id',$this->patient_info->user_id)->where('order_status','0')->groupBy('order_id')->orderBy('order_id','desc')->get();
        $orders =  DB::table('master_orders')
            ->leftJoin('orders','master_orders.m_id', '=', 'orders.m_id')
            ->select('master_orders.*',DB::raw("count(orders.order_id) as total_products"),DB::raw("avg(orders.order_status) as average"))->where('orders.pa_id',$this->patient_info->user_id)
//            ->where(DB::raw("avg(orders.order_status)"),'!=' ,'1')
            ->groupBy('m_id')->orderBy('m_id','desc')
            ->having(DB::raw("avg(orders.order_status)"),'!=' ,'1')
            ->get();
        return view('patient.orders.pending_orders')->with('orders',$orders)->with('order_main','active')->with('order_pending','active');

    } 

    public function completed_orders(){

//        $orders = DB::table('orders')
//            ->leftJoin('products', 'orders.products_id', '=', 'products.products_id')
//            ->leftJoin('imageTable', function ($join) {
//                $join->on('products.products_id', '=', 'imageTable.refId')
//                    ->where('imageTable.table', '=', 'products');
//            })
//            ->select('orders.*','products.*','imageTable.*')->where('pa_id',$this->patient_info->user_id)->where('order_status','1')->groupBy('order_id')
//            ->orderBy('order_id','desc')->get();
        $orders =  DB::table('master_orders')
            ->leftJoin('orders','master_orders.m_id', '=', 'orders.m_id')
            ->select('master_orders.*',DB::raw("count(orders.order_id) as total_products"),DB::raw("avg(orders.order_status) as average"))->where('orders.pa_id',$this->patient_info->pa_id)
//            ->where(DB::raw("avg(orders.order_status)"),'!=' ,'1')
            ->groupBy('m_id')->orderBy('m_id','desc')
            ->having(DB::raw("avg(orders.order_status)"),'=' ,'1')
            ->get();
        return view('patient.orders.completed_orders')->with('orders',$orders)->with('order_main','active')->with('order_fulfill','active');

    }

    public function transactions(){

        $transaction = DB::table('transaction')
            ->leftJoin('orders', 'transaction.order_id', '=', 'orders.order_id')
            ->select('transaction.*','orders.*')->where('pa_id',$this->patient_info->user_id)->orderBy('tr_id','desc')->get();
        return view('patient.orders.transaction')->with('transaction',$transaction);

    }

    public function order($id){ 
        $details = DB::table('orders')
            ->leftJoin('master_orders', 'orders.m_id', '=', 'master_orders.m_id')
            ->leftJoin('transaction', 'orders.order_id', '=', 'transaction.order_id')
            ->leftJoin('practitioners', 'orders.pra_id', '=', 'practitioners.pra_id')
            ->leftJoin('settings', function ($join) {
                $join->on('practitioners.user_id', '=', 'settings.user_id')
                    ->where('settings.key', 'like', 'PRA%');
            })
            ->select('orders.*','transaction.*','settings.*',DB::raw("count(orders.order_id) as total_products"),DB::raw("sum(orders.product_qty) as total_qty"),DB::raw("sum(orders.product_price) as total_price"))->where('master_orders.m_id',$id)->first();

        $orders = DB::table('master_orders')
            ->leftJoin('orders', 'master_orders.m_id', '=', 'orders.m_id')
            ->leftJoin('products', 'orders.products_id', '=', 'products.products_id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->leftJoin('imageTable', function ($join) {
                $join->on('products.products_id', '=', 'imageTable.refId')
                    ->where('imageTable.table', '=', 'products');
            })
            ->leftJoin('transaction', 'orders.order_id', '=', 'transaction.order_id')
            ->leftJoin('practitioners', 'orders.pra_id', '=', 'practitioners.pra_id')
            ->leftJoin('settings', function ($join) {
                $join->on('practitioners.user_id', '=', 'settings.user_id')
                    ->where('settings.key', 'like', 'PRA%');
            })
            ->select('master_orders.*','orders.*','products.*','imageTable.*','transaction.*','settings.*','suppliers.first_name as sup_first','suppliers.last_name as sup_last','suppliers.email as sup_email')->where('master_orders.m_id',$id)
            ->groupBy('orders.order_id')
            ->get();

        return view('patient.orders.order')->with('order',$orders)->with('details',$details);

    }

    public function cartsAdd(Request $request)
    {

        $product_id = $_POST['pro_id'];
        $check = Cart::where('products_id',$product_id)
		->where('pa_id','=',$this->patient_info->user_id)
		->first();
        $product = Practitioner_product::where('product_id',$product_id)->where('store_id',$_POST['pra_id'])->first();
        $qty = $_POST['quantity'];
        $pra_id = $_POST['pra_id'];
		$discount = $product->discountPer;
        if(count($check)){
            $cart = Cart::where('products_id',$product_id)
			->where('pa_id','=',$this->patient_info->user_id)
			->first();
            $cart->qty = $cart->qty + $qty;
            $cart->amount = $cart->amount + ($discount * $qty);
            $cart->save();
            Session::put('success','Product added to your cart successfully!');
            echo $cart->cart_id;
        }
        else{
            $cart = new Cart;
            $cart->pa_id = $this->patient_info->user_id;
            $cart->products_id = $product_id;
            $cart->pra_id = $pra_id;
            $product_total = $product->pra_price * $request->quantity;
            $cart->amount = $product_total;
            $cart->qty = $qty;
            $cart->save();
            Session::put('success','Product added to your cart successfully!');
            echo $cart->cart_id;
        }

    }

    public function order_tracking(Request $request){

        $tracking_number = trim($request->tracking_number);
        $orders = DB::table('orders')
            ->leftJoin('products', 'orders.products_id', '=', 'products.products_id')
            ->leftJoin('imageTable', function ($join) {
                $join->on('products.products_id', '=', 'imageTable.refId')
                    ->where('imageTable.table', '=', 'products');
            })
            ->leftJoin('transaction', 'orders.order_id', '=', 'transaction.order_id')
            ->select('orders.*','products.*','imageTable.*','transaction.*')->where('orders.tracking_number',$tracking_number)->where('pa_id',$this->patient_info->user_id)->first();

        return view('patient.orders.tracking')->with('order',$orders)->with('tracking_number',$tracking_number);

    }
    public function search_products(Request $request){
        Session::put('filter_category',$request->category);
        return redirect::to("patient/ecommerce/store/products/$request->stores_id");

    }
	public function search_products_name(Request $request){
        Session::put('filter_products_name',$request->products_name);
        return redirect::to("patient/ecommerce/store/products/$request->stores_id");

    }
	 public function contact_info(){
		 
		 return view('patient.orders.contact_info')->with('setting_menu','active')->with('shipping_add','active');
	 }
	 public function credit_card_info(){
		 
		 return view('patient.orders.credit_card_info')->with('setting_menu','active')->with('credit_card_info','active');
	 }
	 
	 public function orderDashboard(){
		 $table = DB::select('SELECT totalAmt,m_id,productCount,maxDelivery,created_at FROM master_orders
		LEFT JOIN (
		SELECT m_id AS order_m_id,
		COUNT(orders.products_id) AS productCount , 
		MAX(orders.delivery_date) AS maxDelivery , 
		SUM(product_price * product_qty) AS totalAmt
		 FROM orders
		WHERE order_status IN(1,0)
		GROUP BY order_m_id
		) AS orders ON orders.order_m_id = master_orders.m_id
		WHERE productCount IS NOT NULL AND maxDelivery IS NOT NULL
		ORDER BY maxDelivery DESC');
		 return view('patient.orders.order-dashboard')->with('order_main','active')
		 ->with('table',$table)
		 ;
	 }
	 
	 public function orderDashboardDetail($id){
		 $orders = DB::select('SELECT products.products_name,orders.* from orders
		 LEFT JOIN products on products.products_id = orders.products_id
		 where m_id = '.$id);
		 
		 
		 if(isset($orders)){
			 foreach($orders as $items){
				echo '<tr>';
				echo '<td>';
				echo $items->products_name;
				echo '</td>';
				echo '<td>';
				echo $items->product_qty .' x ' . $items->product_price;
				echo '</td>';
				echo '<td>';
				echo $items->order_status == 0 ? 'pending' : 'deliverd';
				echo '</td>';
				echo '</tr>';
			 }
		 } 
		// return view('patient.orders.order-invoice')->with('order_main','active')
		// ->with('table',$table);
	 }
}
