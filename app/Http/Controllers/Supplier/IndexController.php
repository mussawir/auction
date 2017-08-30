<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\Supplier;
use App\Models\m_flag;
use App\Models\Products;
use App\Models\Orders;
use App\Models\settings;
use App\Models\imageTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class IndexController extends Controller
{
	var $supplier_info = null;
	var $destPath = null;
	public function __construct()
	{
		$this->supplier_info = Supplier::where('user_id', '=', Auth::user()->user_id)->first();
		$this->destPath = 'public/Supplier/'.Auth::user()->user_id;
		$pathIsset = Session::get('setPath');
		if($pathIsset==""||$pathIsset!=$this->destPath)
		{
			$path = 'public/Supplier/'.Auth::user()->user_id;
		//	File::makeDirectory($path, 0777, true, true);
			$url = url('/').'/public/plugins/fileman_lastest/php/setSession.php';
			header('Location: '.$url.'?path='.Auth::user()->user_id);
			Session::put('setPath',$path);
		}
	}
	public function checkSKU(){
		if(isset($_POST['SKU'])){
			if(isset($_POST['id'])){
				if (Products::where('SKU', '=', $_POST['SKU'])->where('products_id', '!=', $_POST['id'])->count() > 0) {
					echo 'exist';
					return;
				}
				else{
					echo 'not';
					return;
				}
			}
			else{
				
				if (Products::where('SKU', '=', $_POST['SKU'])->count() > 0) {
					echo 'exist';
					return;
				}
				else{
					echo 'not';
					return;
				}
			}
		}
	}
	public function copyFile($filePath)
	{
		if($this->getSettingsAllowed('save_public')=='yes')
		{
			$filename = pathinfo($filePath, PATHINFO_FILENAME);
			$extension = pathinfo($filePath, PATHINFO_EXTENSION);
			if(!File::copy($filePath, $this->destPath.'/'.$filename . '.' . $extension))
			{
				echo 'success';
			}
			else
			{ echo 'fail'; }
		}
	}
	public function getSettingsAllowed($key)
	{
		$value = DB::table('settings')
            ->select('settings.value')
->where('settings.key','=',$key)
            ->first();
		return $value->value;
	}
	public function index()
	{
		$pending = collect(\DB::select('SELECT count(*) as pending_orders from orders where order_status = 0 
		AND products_id IN (SELECT products_id from products where supplier_id = '.$this->supplier_info->supplier_id.')'))->first();
		 
		$completed = collect(\DB::select('SELECT count(*) as pending_orders from orders where order_status = 1 
		AND products_id IN (SELECT products_id from products where supplier_id = '.$this->supplier_info->supplier_id.')'))->first();
		
		$totalPro = collect(\DB::select('SELECT count(*) as total_products from products where
		  supplier_id = '.$this->supplier_info->supplier_id))->first();
		
		$transactions = collect(\DB::select('SELECT SUM(amount) as amount from accounts_total_transactions where user_id = '.$this->supplier_info->supplier_id.' AND accounts_total_transactions.TYPE = 3'))->first();
		
		return view('supplier.index')
			->with('page_title', 'Dashboard')
			->with('pending',$pending)
			->with('completed',$completed)
			->with('totalPro',$totalPro)
			->with('transactions',$transactions)
			->with('db_main_menu', 'active');
	}
public function productIndex()
{
	$table1 =  DB::table('products')
        ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('products.*','suppliers.first_name as first_name','suppliers.last_name as last_name')
->where('products.supplier_id','=',$this->supplier_info->supplier_id)
//->where('Practitioner_product.store_id','<>',$this->practitioner_info->pra_id)
            ->get();
	return view('supplier.product.product-list')
			->with('page_title', 'Product List')
			->with('pro_main_menu', 'active')
			->with('pro_list', 'active')
			->with('table1',$table1);
}
public function productDetails($id)
{
	$product = DB::table('products')->where('products_id',$id)->first();
	//$categories = DB::table('categories')->where('cat_id','$cat')->first();
           $images = imageTable::where('refId',$id)->where('table', 'products') ->get();
		   return view('supplier.product.product_details')
		   ->with('product',$product)
		   //->with('categories',$categories)
		   ->with('image',$images)
		   ->with('store_id',$this->supplier_info->supplier_id);
}
	public function changePassword()
	{
		return view('admin.index.change-password');
	}

	public function saveNewPassword(ChangePassFormRequest $request)
	{
		$user = User::find(Auth::user()->user_id);
		$user->password = bcrypt($request['new_password']);
		$user->save();

		Session::put('success', 'Your password has been changed successfully!');
		return Redirect::Back();
	}
	public function NewProduct()
	{
		$preTags = DB::table('settings')->where('key', '=', 'TAG')->where('user_id', '=', Auth::user()->user_id)->get();
		$AvailTags = DB::table('M_FLAG')->where('FlagType', '=', 'TAG')->where('user_id', '=', Auth::user()->user_id)->get();
		$category = DB::table('categories')->get();
		$brand = DB::table('Brands')->where('supplier_id', '=', $this->supplier_info->supplier_id)->get();
		return view('supplier.product.new')
			->with('page_title', 'Add Product')
			->with('pro_main_menu', 'active')
			->with('pro_new', 'active')
			->with('preTags',$preTags)
			->with('AvailTags',$AvailTags)
			->with('category',$category)
			->with('brand',$brand);
	}
	public function edit($id)
	{
		$product = DB::table('products')->where('products_id','=',$id)->get();
		$productSearch = DB::table('products')->where('products_id','=',$id)->first();
		$imageTable = DB::table('imageTable')->where('refId','=',$productSearch->products_id)
		->where('table','=','products')
		->get();
		$preTags = DB::table('settings')->where('key', '=', 'TAG')->where('user_id', '=', Auth::user()->user_id)->get();
		$AvailTags = DB::table('M_FLAG')->where('FlagType', '=', 'TAG')->where('user_id', '=', Auth::user()->user_id)->get();
		$category = DB::table('categories')->get();
		$brand = DB::table('Brands')->where('supplier_id', '=', $this->supplier_info->supplier_id)->get();
		return view('supplier.product.edit')
			->with('page_title', 'Update Product')
			->with('productId',$id)
			->with('pro_main_menu', 'active')
			->with('pro_list', 'active')
			->with('preTags',$preTags)
			->with('AvailTags',$AvailTags)
			->with('category',$category)
			->with('brand',$brand)
			->with('product',$product)
			->with('imageTable',$imageTable)
			;
	}
	public function update(Request $request)
	{
		$pathUpdate='';
		$parent_id = rtrim($request->cat_id, ",");
		$basePath = base_path();
		$delDirectory=false;
		$products = products::find($request->products_id);
		$products->products_name = $request->products_name;
        $products->short_description = $request->short_description;
		$products->productDescription = $request->productDescription;
		$products->price = $request->price;
		$products->quantity = $request->quantity;
		$products->map = $request->map;
		$products->taxPer = $request->taxPer;
		$products->price = $request->price;
		$products->tags = $request->tags_1;
		$products->cat_id = $parent_id;
		$products->brand_id = $request->brand_id;
		$products->SKU = $request->SKU;
		$products->tags = $request->tags_1;
		if($request->hasFile('mainFiles')) {
			File::delete($products->mainFiles);
            $files = $request->file('mainFiles');
			//$path = 'public/Main/products/'.$request->products_id;
			$path = 'public/images/suppliers';
			//File::makeDirectory($path, 0777, true, true);
				$rand_num = rand(11111, 99999);
				$filename = $rand_num .'-'.$files->getClientOriginalName();
				$upload_success = $files->move($path, $filename);
				$pathUpdate= $path.'/'.$filename;
				$products->mainImage = $pathUpdate;
				$this->copyFile($pathUpdate);
        }
		$products->save();
		$imageTableDel = imageTable::where('refId','=',$request->products_id)->where('table','=','products')->get();
		foreach($imageTableDel as $imagePaths)
		{
			$directory = dirname($basePath.'/'.$imagePaths->image_path);
			imageTable::find($imagePaths->id)->delete();
			File::delete($imagePaths->image_path);
		
			$delDirectory=true;
		}
		if($delDirectory)
		{
		//	$success = rmdir($directory);
		}
		$this->uploadImage($request,$request->products_id);
        Session::put('success','Product updated successfully!');
        return Redirect::to('/supplier/product/list');
	}
	public function saveSupplierImage($picPath)
	{
		$path = 'public/Supplier/'.$this->supplier_info->supplier_id;
		File::makeDirectory($path, 0777, true, true);
		File::move($picPath, $path);
	}
	public static function uploadImage(Request $request,$productId)
	{
		if($request->hasFile('files')) {
            $files = $request->file('files');
        }
         else
        {
        	return;
        }
    $file_count = count($files);
    $uploadcount = 0;
    //$path = 'public/products/'.$productId.'_'.mt_rand();
	  $path = 'public/images/suppliers';
	//File::makeDirectory($path, 0777, true, true);
    foreach($files as $file) {
      $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
      //$validator = Validator::make(array('file'=> $file), $rules);
      //if($validator->passes()){
      	$rand_num = rand(11111, 99999);
        $filename = $rand_num .'-'.$file->getClientOriginalName();
        $upload_success = $file->move($path, $filename);
        //$this->savePaths(,,'products');
        $data = new imageTable;
    $data->image_path = $path.'/'.$filename;
    $data->refId = $productId;
    $data->table = 'products';
    $data->pixle = '500';
    $data->save();
        $uploadcount ++;
      //}
    }
    if($uploadcount == $file_count){
      echo 'success';
    } 
    else {
      //echo 'fail';
    }
	}
	public function NewProductAdd(Request $request)
	{
		$parent_id = rtrim($request->cat_id,",");
		
		$supplier_id = $this->supplier_info->supplier_id;
		$product_id = products::create([
				'products_name'=>$request->products_name,
				'brand_id'=>$request->brand_id,
				'cat_id'=> $parent_id,
                'productDescription' =>  $request->productDescription,
				'short_description' =>  $request->short_description,
                'price' =>  $request->price,
                'quantity' =>  $request->quantity,
                'supplier_id' =>  $supplier_id,
                'map' =>  $request->map,
                'taxPer' =>  $request->taxPer,
                'featured' =>$request->featured,
                'status' =>$request->status,
                'tags'=>$request->tags_1,
				'SKU'=>$request->SKU,
                'createdBy' => Auth::user()->user_id
            ])->products_id;
			//mainFiles
			if($request->hasFile('mainFiles')) {
            $files = $request->file('mainFiles');
			//$path = 'public/Main/products/'.$product_id;
			$path = 'public/images/suppliers';
		//	File::makeDirectory($path, 0777, true, true);
			$pathUpdate = '';
				$rand_num = rand(11111, 99999);
				$filename = $rand_num .'-'.$files->getClientOriginalName();
				$upload_success = $files->move($path, $filename);
				$pathUpdate= $path.'/'.$filename;
			$pro = products::find($product_id);
			$pro->mainImage = $pathUpdate;
			//$this->copyFile($pathUpdate);
			
			$pro->save();
        }
		
		Session::put('success','Product Created!');
		$this->uploadImage($request,$product_id);
		return Redirect::Back();
	}
	public function NewTag()
	{
		$tagList = DB::table('M_FLAG')->where('flagType', '=', 'TAG')->where('user_id', '=', Auth::user()->user_id)->get();
		return view('supplier.product.tag-new')
			->with('page_title', 'Add Product Tag')
			->with('tag_main_menu', 'active')
			->with('tag_new', 'active')
			->with('tagList',$tagList)
			;
	}
	public function PreTags()
	{
		$AvailTags = DB::table('M_FLAG')->where('FlagType', '=', 'TAG')->where('user_id', '=', Auth::user()->user_id)->get();
		$PreTag = DB::table('settings')->where('key', '=', 'TAG')->where('user_id', '=', Auth::user()->user_id)->first();
		$btnShow = 'show';
		if(!$PreTag) {
   $btnShow  = 'hide'; }
		return view('supplier.product.predefined')
			->with('page_title', 'Predefined Tag')
			->with('tag_main_menu', 'active')
			->with('pre_tag_list', 'active')
			->with('btnShow',$btnShow)
			->with('AvailTags',$AvailTags);
	}
	public function StorePreTags(Request $request)
	{
		$flagType = $request->key;
		$flag = $request->value;
		DB::table('settings')->where('key', '=', $flagType)->where('user_id', '=', Auth::user()->user_id)->delete();
		settings::create([
                'key' =>  $flagType,
                'value' => $flag,
                'user_id'=>Auth::user()->user_id
            ]);
		Session::put('success','Predefine Tag Created!');
		return Redirect::Back();
	}
	public function destroyTag($id)
	{
		DB::table('M_FLAG')->where('id', '=' , $id)->delete();
		echo 'success';
	}
	public function saveTags(Request $request)
	{
		$flagType = $request->flagType;
		$flag = $request->flag;
		m_flag::create([
                'FlagType' =>  $flagType,
                'Flag' => $flag,
                'user_id'=>Auth::user()->user_id
            ]);
		Session::put('success','Tag Created!');
		return Redirect::Back();
	}
	public function orderStatus($statusId=null)
	{
		if($statusId==null)
		{
			$explodedVal=array("0","1","2","3"); 
		}
		else
		{
			$explodedVal=array($statusId); 
		}
		$table1 =  DB::table('orders')
        ->leftJoin('products', 'orders.products_id', '=', 'products.products_id')
		->leftJoin('patients', 'orders.pa_id', '=', 'patients.pa_id')
		->leftJoin('practitioners', 'orders.pra_id', '=', 'practitioners.pra_id')
            ->select('orders.*','products.products_name','patients.first_name as pa_first_name'
			,'patients.last_name as pa_last_name','practitioners.first_name as pra_first_name'
			,'practitioners.last_name as pra_last_name'
			)->where('products.supplier_id','=',$this->supplier_info->supplier_id)
->whereIn('orders.order_status',$explodedVal)
//->where('Practitioner_product.store_id','<>',$this->practitioner_info->pra_id)
            ->get();
			if($statusId==null){$orderList = 'order_list';}else{$orderList = 'order_list_'.$statusId;}
			$pageTitle = '';
			if($statusId==null){$pageTitle='Orders';}
			else if($statusId==0){$pageTitle='Pending Orders';}
			else if($statusId==1){$pageTitle='Delivered Orders';}
			else if($statusId==2){$pageTitle='Process Orders';}
			else if($statusId==3){$pageTitle='Cancelled Orders';}
			else {$pageTitle='Orders';}
	return view('supplier.product.check-order-status')
			->with('page_title', $pageTitle)
			->with('orders_main_menu', 'active')
			->with($orderList, 'active')
			->with('table1',$table1);

	}
	public function updateStatus(Request $request)
	{
				$orderId = array();
		foreach($_POST as $key=>$value)
		{
			$order_id = str_replace('order_status_','',$key);
			DB::table('orders')
            ->where('order_id', $order_id)
            ->update(['order_status' => $value]);
			if($value==3)
			{
			$table1 = DB::table('orders as Orders')
			->leftJoin('products','Orders.products_id', '=', 'products.products_id')
			->leftJoin('patients','Orders.pa_id', '=', 'patients.pa_id')
			->leftJoin('suppliers','products.supplier_id', '=', 'suppliers.supplier_id')
			->select('Orders.*','patients.*','products.products_name','suppliers.first_name as sup_fName' ,'suppliers.last_name as sup_lName')
			->where('Orders.order_id','=',$order_id)
            ->first();
			$data = [
			'table1'=>$table1,
			]; 
			$email = $table1->email;
            $subject = 'PracticeTabs . Order Cancelled'; 
            Mail::send(['html' => 'supplier.cancellation'], $data, function ($message) use ($email , $subject) {
                $message->from('postmaster@practicetabs.com', 'Practice Tabs');
                $message->to($email);
                $message->subject($subject);
                });
			}
		}
	}
	
	 public function orderDashboard($statusId=null){
		if($statusId==null)
		{
			$explodedVal=array("0","1","2","3","4"); 
		}
		else
		{
			$explodedVal=array($statusId); 
		}
		$order_list = 'order_list_'.$statusId;
		 $user_id = Auth::user()->user_id;
		 $table = DB::select('
			SELECT totalAmt,m_id,productCount,maxDelivery , patients.first_name AS pa_first_name  , patients.last_name AS pa_last_name  FROM master_orders
			LEFT JOIN (
			SELECT m_id AS order_m_id,
			COUNT(orders.products_id) AS productCount , 
			MAX(orders.delivery_date) AS maxDelivery 
			/*,SUM(product_price * product_qty) AS totalAmt*/,SUM(accounts_total_transactions.amount) AS totalAmt FROM orders
			LEFT JOIN accounts_total_transactions ON  accounts_total_transactions.order_id = orders.order_id
			AND accounts_total_transactions.type = 3 AND accounts_total_transactions.user_id = (SELECT supplier_id FROM suppliers WHERE user_id = '.$user_id.')
			WHERE orders.products_id IN (SELECT products_id FROM products WHERE supplier_id = (SELECT supplier_id FROM suppliers WHERE user_id = '.$user_id.'))
			AND  order_status IN ('.implode(",",$explodedVal).')
			GROUP BY order_m_id
			) AS orders ON orders.order_m_id = master_orders.m_id
			LEFT JOIN patients ON patients.pa_id = master_orders.m_pa_id
			WHERE productCount IS NOT NULL AND maxDelivery IS NOT NULL
			ORDER BY maxDelivery DESC');
		 return view('supplier.product.order-status')->with( $order_list ,'active')->with('orders_main_menu','active')->with('page' , $order_list )
		 ->with('table',$table); 
	 }
	 
	  public function orderDashboardDetail($id){
		 $orders = DB::select('SELECT patients.first_name, patients.last_name, patients.email, patients.primary_phone, patients.mailing_street_address, patients.mailing_city, patients.mailing_zip, patients.billing_street_address, patients.billing_city, patients.billing_zip, products.products_name,
		 accounts_total_transactions.amount as supplier_cost_amount,orders.* from orders
		 LEFT JOIN products on products.products_id = orders.products_id
		 LEFT JOIN accounts_total_transactions on accounts_total_transactions.order_id = orders.order_id
		 AND accounts_total_transactions.type = 3 AND accounts_total_transactions.user_id = '.$this->supplier_info->supplier_id.'
		 LEFT JOIN patients ON patients.pa_id = orders.pa_id  
		 where m_id = '.$id.' AND products.supplier_id = '.$this->supplier_info->supplier_id); 
  
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
echo '</div></div><div class="row"><table id="data-table-ajax" class="table table-hover"><thead><tr><th>Product Name</th><th>Qty * Amount</th></tr></thead><tbody>';
			 foreach($orders as $items){
				echo '<tr>';
				echo '<td>';
				echo $items->products_name;
				echo '</td>';
				echo '<td>';
				echo $items->product_qty .' x ' . ($items->supplier_cost_amount/$items->product_qty);
				echo '</td>';
						
				echo '</tr>';
			 }
			echo '</tbody></table></div>';
		 }
		//return view('supplier.product.order-detail')->with('orders' , $orders );
	 }
	 	public function updateorderstatus()
			{	
				$id  = $_POST['id']; 
				$value = $_POST['status'];
				$result = DB::statement('UPDATE orders set order_status = '.$value.' WHERE m_id = '.$id.'. AND products_id IN (SELECT products_id from products where supplier_id = '.$this->supplier_info->supplier_id.')');
				if($result){
					echo 'success';
				}
				else {
					echo 'Some Error Occured';
				} 
			}  
		 public function ordershippeddashboard($statusId=null){
				 
				if($statusId==null)
				{
					$explodedVal=array("0","1","2","3","4"); 
				}
				else
				{
					$explodedVal=array($statusId); 
				}
				$order_list = 'order_list_'.$statusId;
				 $user_id = Auth::user()->user_id;
				 $table = DB::select('
			SELECT totalAmt,m_id,productCount,maxDelivery , patients.first_name AS pa_first_name  , patients.last_name AS pa_last_name  FROM master_orders
			LEFT JOIN (
			SELECT m_id AS order_m_id,
			COUNT(orders.products_id) AS productCount , 
			MAX(orders.delivery_date) AS maxDelivery 
			/*,SUM(product_price * product_qty) AS totalAmt*/,SUM(accounts_total_transactions.amount) AS totalAmt FROM orders
			LEFT JOIN accounts_total_transactions ON  accounts_total_transactions.order_id = orders.order_id
			AND accounts_total_transactions.type = 3 AND accounts_total_transactions.user_id = (SELECT supplier_id FROM suppliers WHERE user_id = '.$user_id.')
			WHERE orders.products_id IN (SELECT products_id FROM products WHERE supplier_id = (SELECT supplier_id FROM suppliers WHERE user_id = '.$user_id.'))
			AND  order_status IN ('.implode(",",$explodedVal).')
			GROUP BY order_m_id
			) AS orders ON orders.order_m_id = master_orders.m_id
			LEFT JOIN patients ON patients.pa_id = master_orders.m_pa_id
			WHERE productCount IS NOT NULL AND maxDelivery IS NOT NULL
			ORDER BY maxDelivery DESC');
			
				 return view('supplier.product.order-process')->with( $order_list ,'active')->with('orders_main_menu','active')->with('page' , $order_list )
				 ->with('table',$table); 
			 }

			 
		public function updateorderprocessstatus($id)
			{	
					 $orders = DB::select('SELECT patients.first_name, patients.last_name, patients.email, 
					 patients.primary_phone, patients.mailing_street_address, patients.mailing_city, patients.mailing_zip,
					 patients.billing_street_address, patients.billing_city, patients.billing_zip, 
					 products.products_name,orders.*,accounts_total_transactions.amount as transaction_amount from orders
					 LEFT JOIN products on products.products_id = orders.products_id
					 LEFT JOIN accounts_total_transactions on accounts_total_transactions.order_id = orders.order_id
					 AND accounts_total_transactions.type = 3 AND accounts_total_transactions.user_id = '.$this->supplier_info->supplier_id.'
					 LEFT JOIN patients ON patients.pa_id = orders.pa_id  
					 where m_id = '.$id.' AND products.supplier_id = '.$this->supplier_info->supplier_id); 
					 
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
						
							
echo '</div></div>';	echo '<hr><div class="row" > <h4>Shipping Details</h4>';
						echo '<div class="col-md-12">
   <label class="col-md-2 control-label">Shipping Address<span class="text-danger">*</span></label>
   <div class="col-md-9">
      <input type="text" class="form-control required" id="shipping_address" name="shipping_address" placeholder="" value="">
   </div>
</div>
<div class="col-md-12">
   <label class="col-md-2 control-label">Zip Code <span class="text-danger">*</span></label>
   <div class="col-md-9">
      <input type="text" class="form-control required" id="zip_code" name="zip_code" placeholder="" value="">
   </div>
</div>
<div class="col-md-12">
   <label class="col-md-2 control-label">Phone Number <span class="text-danger">*</span></label>
   <div class="col-md-9">
      <input type="text" class="form-control required" id="phone_number" name="phone_number" placeholder="" value="">
   </div>
</div> 
<div class="col-md-12">
   <label class="col-md-2 control-label">Shipping Company<span class="text-danger">*</span></label>
   <div class="col-md-9">
      <input type="text" class="form-control required" id="shipping_compnay" name="shipping_compnay" placeholder="" value="">
   </div>
</div>
<div class="col-md-12">
   <label class="col-md-2 control-label">Email Address <span class="text-danger">*</span></label>
   <div class="col-md-9">
      <input type="email" class="form-control required" id="email_address" name="email_address" placeholder="" value="">
   </div>
</div>
<div class="col-md-12">
   <label class="col-md-2 control-label">Deliver Expected Date <span class="text-danger">*</span></label>
   <div class="col-md-9">
      <input type="date" class="form-control required" id="delivery_exp_date" name="delivery_exp_date" placeholder="" value="">
   </div>
</div>
				   </div>';
					echo	'<hr><div class="row"><h4>Product Details</h4><table id="data-table-ajax" class="table table-hover"><thead><tr><th>Product Name</th><th>Qty * Amount</th></tr></thead><tbody>';
			 foreach($orders as $items){
				echo '<tr>';
				echo '<td>';
				echo $items->products_name;
				echo '</td>';
				echo '<td>';
				echo $items->product_qty .' x ' . ($items->transaction_amount/$items->product_qty);
				echo '</td>';
						
				echo '</tr>';
			 }
			echo '</tbody></table></div>';
		 }
		//return view('supplier.product.order-detail')->with('orders' , $orders );
			}


		public function orderprocesssave(Request $request)
			{
								$id = $request->m_order_id_curr; 
								$shipping_address =	$request->shipping_address; 
								$zip_code = $request->zip_code;
								$phone_number =	$request->phone_number;
								$shipping_compnay =	$request->shipping_compnay;
								$email_address = $request->email_address;
								$delivery_exp_date = $request->delivery_exp_date;
				$supId = $this->supplier_info->supplier_id;
					$sql = "UPDATE orders set 
				order_status = 1 , 
				shipping_address = '$shipping_address', 
				delivery_exp_date = '$delivery_exp_date',
				zip_code  = '$zip_code',
				phone_number = '$phone_number',
				shipping_compnay = '$shipping_compnay', 
				email_address = '$email_address' 
				WHERE m_id = '$id'  AND products_id IN (SELECT products_id from products where supplier_id = '$supId')";
				$result = DB::statement($sql);
				if($result){
					Session::put('success','Success!');
				return Redirect::Back();
				}
				else {
					Session::put('error','Some Error Occoured!');
				return Redirect::Back();
				}
						
			}  



			
}