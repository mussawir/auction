<?php

namespace App\Http\Controllers\Practitioner;
use App\Models;
use App\Models\PraSubscribe;
use App\Models\Practitioner_product;
use App\Models\Practitioner;
use App\Models\imageTable;
use App\Models\settings;
use App\Models\Products;
use App\Models\Patient;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Dompdf\Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
class EcommerceController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
		$storeValue = 'PRA_'.$this->practitioner_info->pra_id.'_STORE';
		$actionName = Route::getCurrentRoute()->getActionName();
		if($this->getSettingsAllowed($storeValue)==""&&$actionName!='App\Http\Controllers\Practitioner\EcommerceController@storeName')
		{
				Session::put('error','Please Set your store name first');
				if($actionName=='App\Http\Controllers\Practitioner\EcommerceController@saveStoreName'){
				}
				else{
				return Redirect::to('/practitioner/ecommerce/store-name?type=error')->send();
				}
		}
    }
	public function getSettingsAllowed($key)
	{
		$value = DB::table('settings')
            ->select('settings.value')
->where('settings.key','=',$key)
->where('settings.user_id','=',Auth::user()->user_id)
            ->first();
			if(isset($value))
			{
		return $value->value;
			}
			else
			{
				return "";
			}
	}
    //Request functions
    public function index()
    {
        /*$table1 = PraSubscribe::select('*')
        ->orderBy('created_at', 'asc')
        ->get();*/
$table1 =  DB::table('pra_subscribe')
            ->leftJoin('patients', 'pra_subscribe.pa_id', '=', 'patients.pa_id')
            ->select('pra_subscribe.*','patients.first_name as first_name','patients.last_name as last_name')
            ->where('pra_subscribe.isApproved','=','0')
            ->where('pra_subscribe.pra_id','=',$this->practitioner_info->pra_id)
            ->where('pra_subscribe.request_msg','<>',null)
            ->get();
        return view('practitioner.ecommerce.new')
            ->with('meta', array('page_title'=>'Request List','store_main'=>'active'))
            ->with('ecommerce','active')
			->with('practitioner_info',$this->practitioner_info)
            ->with('req_ecommerce','active')
            ->with('table1',$table1)
            ;
    }
    public function products_list(){
		
        $sups = Supplier::get();
        $meta = array('page_title'=>'Store Products', 'pro_list'=>'active','store_main'=>'active');
        $products = DB::table('Practitioner_product')
            ->leftJoin('products', 'Practitioner_product.product_id', '=', 'products.products_id')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('Practitioner_product.*','products.*','categories.cat_name',DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier_name"))
            ->where('store_id',$this->practitioner_info->pra_id)
            ->get();
        return view('practitioner.ecommerce.products_list')
		->with('meta',$meta)
		->with('practitioner_info',$this->practitioner_info)
		->with('products',$products)
		->with('items',$sups);
    }
    public function prac_profit(Request $request){
        $id = $request->id;
        $discountedPrice = $request->discountedPrice;
        $discount = $request->discount;
        $products = Practitioner_product::where('store_id',$this->practitioner_info->pra_id)->where('product_id',$id)->first();
        $products->discountP = $discount;
        $products->pra_price =  $discountedPrice;
        $products->increased_percentage = null;
        $products->save();
        echo 'success';
    }
    public function increase_price(Request $request){
        $id = $request->id;
        $increase = $request->increase;
        $increaseP = $request->increasedPrice;
        $products = Practitioner_product::where('store_id',$this->practitioner_info->pra_id)->where('product_id',$id)->first();
        $products->pra_price = $increaseP;
        $products->increased_percentage = $increase;
        $products->discountP = '0';
        $products->discountAmount = '';
        $products->save();
        echo 'success';
    }
    public function approve($id)
    {
        //$input = $request->all();
        PraSubscribe::where('pra_id', $this->practitioner_info->pra_id)
          ->where('pa_id', $id)
          ->where('isApproved', 0)
          ->update(['isApproved' => 1]);
          echo 'success';
    }
     public function reject($id)
    {
        //$input = $request->all();
        PraSubscribe::where('pra_id', $this->practitioner_info->pra_id)
          ->where('pa_id', $id)
          ->where('isApproved', 0)
          ->update(['request_msg' => null]);
          echo 'success';
    }
    //Product functions 
     public function products()
    {
        $pa_products = DB::table('Practitioner_product')->select('Practitioner_product.product_id')
        ->where('Practitioner_product.store_id','=',$this->practitioner_info->pra_id)
        ->get();
        $pa_proId = '';
        foreach($pa_products as $item)
        {
            $pa_proId .= $item->product_id;
            $pa_proId.=',';
        }
        $pa_proId = rtrim($pa_proId, ",");
        $explodedVal = explode(',',$pa_proId);
        $table1 =  DB::table('products')
        ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('products.*','suppliers.first_name as first_name','suppliers.last_name as last_name')
->whereNotIn('products.products_id',$explodedVal)
//->where('Practitioner_product.store_id','<>',$this->practitioner_info->pra_id)
            ->paginate(25)
			;
       return view('practitioner.ecommerce.pro-add')
            ->with('meta', array('page_title'=>'Add Products'))
            ->with('ecommerce','active')
            ->with('pro_ecommerce','active')
            ->with('table1',$table1)
            ;
    }
    public function productsAdd(Request $request)
    {
        $product_id = $request->pro_id;
		$price = Products::select('map')->where('products_id',$product_id)->first();
        $products = Practitioner_product::where('product_id',$product_id)->where('store_id',$this->practitioner_info->pra_id);
        $products->delete();
        $Practitioner_product = new Practitioner_product;
        $Practitioner_product->store_id = $this->practitioner_info->pra_id;
        $Practitioner_product->product_id = $product_id;
        $Practitioner_product->pra_price = $price['map'];
        $Practitioner_product->save();
        Session::put('success','Product added to your store successfully!');
        echo 'success';
    }
    //In Store Products
    public function InListProducts()
    {
        $pa_products = DB::table('Practitioner_product')->select('Practitioner_product.product_id')
        ->where('Practitioner_product.store_id','=',$this->practitioner_info->pra_id)
        ->get();
        $pa_proId = '';
        foreach($pa_products as $item)
        {
            $pa_proId .= $item->product_id;
            $pa_proId.=',';
        }
        $pa_proId = rtrim($pa_proId, ",");
        $explodedVal = explode(',',$pa_proId);
        $table1 =  DB::table('products')
        ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('products.*','suppliers.first_name as first_name','suppliers.last_name as last_name')
->whereIn('products.products_id',$explodedVal)
            ->get();
        return view('practitioner.ecommerce.store-pro-list')
            ->with('meta', array('page_title'=>'Store Products'))
            ->with('ecommerce','active')
            ->with('proList_ecommerce','active')
            ->with('table1',$table1)
            ;
    }
    public function productsRemove(Request $request)
    {
        DB::table('Practitioner_product')->where('product_id', '=', $_POST['pro_id'])->where('store_id', '=', $this->practitioner_info->pra_id)->delete();
        Session::put('success','Product Remove from your store successfully!');
        echo 'success';
    }
    
       
    //Store Name 
    public function removeStoreName()
    {
        $storeValue = 'PRA_'.$this->practitioner_info->pra_id.'_STORE';
		$manufacturer =  DB::table('settings')->where('key', '=', $storeValue)->where('user_id', '=', Auth::user()->user_id)->first();		
			if(isset($manufacturer)){
				if (isset($manufacturer->settings_image) && (!empty($manufacturer->settings_image))) {
				if(file_exists(public_path() . '/practitioners/store/' . $manufacturer->settings_image)) {
				unlink(public_path() . '/practitioners/store/' . $manufacturer->settings_image);
					}
				}
			}			
		DB::table('settings')->where('key', '=', $storeValue)->where('user_id', '=', Auth::user()->user_id)->delete();
		Session::put('success','Custom Store Name Removed!');
        return Redirect::Back();
	}
    public function saveStoreName(Request $request)
    {
		$path='';
        $storeValue = 'PRA_'.$this->practitioner_info->pra_id.'_STORE';
        $flag = $request->value;
        DB::table('settings')->where('key', '=', $storeValue)->where('user_id', '=', Auth::user()->user_id)->delete();
        $filename = '';
        if($request->hasFile('logo_image')) {
          
            $file = $request->file('logo_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

			$file->move(public_path().'/images/practitioners/' .$this->practitioner_info->url .'/', $filename);
	                 
    }

        settings::create([
                'key' =>  $storeValue,
                'value' => $flag,
                'user_id'=>Auth::user()->user_id,
                'settings_image' => $filename
            ]);
        Session::put('success','Custom Store Name Set!');
		return Redirect::to('/practitioner/ecommerce/store-name?type=success');
    }
    public function storeName()
    {
        $storeValue = 'PRA_'.$this->practitioner_info->pra_id.'_STORE';
        $PreTag = DB::table('settings')->where('key', '=', $storeValue)->where('user_id', '=', Auth::user()->user_id)->first();
     
	 $btnShow = 'show';
        if(!$PreTag) {
   $btnShow  = 'hide'; }
        return view('practitioner.ecommerce.store-name')
            ->with('meta', array('page_title'=>'Custom Store Name','store_main'=>'active'))
            ->with('practitioner_info',$this->practitioner_info)
			->with('ecommerce','active')
            ->with('name_ecommerce','active')
            ->with('btnShow',$btnShow)->with('StoreData',$PreTag)
            ;
			
    }
    
    public function orders(){

        $orders = DB::table('orders')
            ->leftJoin('products', 'orders.products_id', '=', 'products.products_id')
            ->leftJoin('master_orders', 'orders.m_id', '=', 'master_orders.m_id')->GROUPBY('m_id')
            ->leftJoin('imageTable', function ($join) {
                $join->on('products.products_id', '=', 'imageTable.refId')
                    ->where('imageTable.table', '=', 'products');
            })
            ->select('orders.*','products.*','imageTable.*')->where('pra_id',$this->practitioner_info->pra_id)->groupBy('order_id')->orderBy('order_id','desc')->get();
        return view('practitioner.ecommerce.sold_products')->with('meta', array('page_title'=>'Sold Products','store_main'=>'active'))->with('orders',$orders)->with('ecommerce','active')->with('soldproducts_ecommerce','active');
        
    }

    public function order_details($id){

        $orders = DB::table('orders')
            ->leftJoin('products', 'orders.products_id', '=', 'products.products_id')
            ->leftJoin('imageTable', function ($join) {
                $join->on('products.products_id', '=', 'imageTable.refId')
                    ->where('imageTable.table', '=', 'products');
            })
            ->leftJoin('transaction', 'orders.order_id', '=', 'transaction.order_id')
            ->leftJoin('practitioners', 'orders.pra_id', '=', 'practitioners.pra_id')
			->leftJoin('patients', 'patients.pa_id', '=', 'orders.pa_id')
            ->leftJoin('settings', function ($join) {
                $join->on('practitioners.user_id', '=', 'settings.user_id')
                    ->where('settings.key', 'like', 'PRA%');
            })
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('orders.*','patients.first_name','patients.last_name','products.*','imageTable.*','transaction.*','settings.*','suppliers.first_name as sup_firstname','suppliers.last_name as sup_lastname')
            ->where('orders.order_id',$id)->first();
            
            

        return view('practitioner.ecommerce.order_details')
        ->with('order',$orders)
        ->with('meta', array('page_title'=>$orders->products_name))
        ->with('practitioner_info',$this->practitioner_info)        
        ->with('ecommerce','active');

    }
	
	public function product_details($id){
			
      $image = DB::table('imageTable')
            ->where('refId',$id)->where('table','products')
            ->get();

            $products =  DB::table('products')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('products.*','suppliers.*')
            ->where('products_id',$id)
            ->first();

           // $image = imageTable::where('refId',$id)->where('table','products')->first();
            
        $meta = array('page_title'=>'Suppliers Product Details', 'supp_main_menu'=>'active');

        return view('practitioner/ecommerce/product_details')
        ->with('meta',$meta)
        ->with('images',$image)
        ->with('practitioner_info',$this->practitioner_info)
        ->with('product',$products);
    }
	public function invitations(){
        $meta = array('page_title'=>'Send Store Invitation', 'send_invitation'=>'active','store_main'=>'active');
        return view('practitioner/ecommerce/send_invite')->with('meta',$meta)->with('ecommerce','active')
		->with('send_invitation','active')
		->with('practitioner_info',$this->practitioner_info)
		;
		
    }
	public function send_store_invitation(Request $request){
		$storeValue = 'PRA_'.$this->practitioner_info->pra_id.'_STORE';
			$manufacturer =  DB::table('settings')->where('key', '=', $storeValue)->where('user_id', '=', Auth::user()->user_id)->first();
			$practitioner = Practitioner::where('pra_id',$this->practitioner_info->pra_id)->first();
			$email = $request->email;
			$subject = 'Invitation Store';
			$pat_name = $request->name;
			$store_code = rand(111111,999999);
		$data = [
                'store_code'=>  $store_code,
				'manufacturer' => $manufacturer,
				'full_name' => $practitioner->first_name. ' ' .$practitioner->last_name,
				'pat_name' => $pat_name
            ];
		$check_patient = Patient::where('email',$email)->first();
		if(count($check_patient) > '0'){
			
            Mail::send(['html' => 'practitioner.ecommerce.invite_email'], $data, function ($message) use ($email , $subject) {
                $message->from('postmaster@practicetabs.com', 'Practice Tabs');
                $message->to($email);
                $message->subject($subject);
                });
				$store_request = new PraSubscribe;
				$store_request->request_msg = 'Store Request';
				$store_request->isApproved = '0';
				$store_request->pra_id = $this->practitioner_info->pra_id;
				$store_request->pa_id = $check_patient->pa_id;
				$store_request->store_code = $store_code;
				$store_request->save();
			Session::put('success','Store invitation code has been sent!');
			
		}else{
			Session::put('error','Email should be registered with practicetabs!');
			
		}
		return Redirect::Back();
    }
       
}
