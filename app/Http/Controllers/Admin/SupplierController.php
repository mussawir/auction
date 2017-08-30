<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Products;
use App\Models\imageTable;
use App\Models\Practitioner_product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

class SupplierController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->user_id = Auth::user()->user_id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Supplier::get();
        $meta = array('page_title'=>'Suppliers', 'supp_main_menu'=>'active', 'supp_sub_menu_list'=> 'active');
        return view('admin.supplier.index')->with('meta',$meta)->with('items',$item);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pra_profit(Request $request)
    {
        $praProfit = $_POST['profitz'];
        $product_id = $_POST['pro_id'];
        $profit = Products::find($product_id);
        $profit->profitP = $praProfit;
        $profit->save();
        Session::put('success','Profit has been set on product!');
        echo 'success';
    }  

    public function products_list(){
        $sups = Supplier::get();
        $meta = array('page_title'=>'Products List', 'pro_list'=>'active');
        $products = DB::table('products')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('products.*','categories.cat_name',DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier_name"))->get();    
	   return view('admin.supplier.products_list')->with('meta',$meta)->with('products',$products)->with('items',$sups);
    }
	
    public function prac_profit(Request $request){

        $profit = $request->profitP;
		$pra_cut = $request->pra_cut;
		$pt_cut = $request->pt_cut;
        $products = Products::find($request->id);
        $products->profitP = $profit;
		$products->praProfit = $pra_cut;
		$products->ptProfit = $pt_cut;
        $products->save();
		$productCommision = Practitioner_product::where('product_id',$request->id)->get();
		foreach($productCommision as $items){
			if($items->discountP>0){
				//$pra_cut = ($products['map']/100)*$profit;;
				$discountedCal = ($pra_cut/100)*$items->discountP;
				$discountedPrice = $products['map'] - $discountedCal;
				$profitUpdate = Practitioner_product::find($items->id);
				$profitUpdate->discountAmount = $discountedPrice;
				$profitUpdate->pra_price = $discountedPrice;
				$profitUpdate->save();
			}
		}
        echo 'success';
    }
    public function create()
    {

        $meta = array('page_title'=>'Create Suppliers', 'supp_main_menu'=>'active', 'supp_sub_menu_new'=> 'active');
        return view('admin.supplier.new')->with('meta', $meta);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $pass = Str::quickRandom(8);
        $input['password'] = bcrypt($pass);
        $input['role'] = '6';
        User::create($input);
        $search = User::where('email',$request->email)->first();
        $subject = 'Welcome To Practice Tabs';
        $contacts = $request->email;
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $pass
        ];
        Mail::send(['html' => 'admin.supplier.emailbody'], $data, function ($message) use ($contacts , $subject) {
            $message->from('valeedmahmood@gmail.com', 'Practice Tabs');
            $message->to($contacts);
            $message->subject($subject);
        });

        $supplier = $request->all();
        $supplier['user_id'] = $search->user_id;
        Supplier::create($supplier);

        Session::put('success','Supplier saved successfully!');

        return Redirect::Back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Supplier::where('supplier_id',$id)->first();
        $meta = array('page_title'=>'Edit Supplier', 'cat_main_menu'=>'active');
        return view('admin.supplier.edit')->with('meta', $meta)->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        $validator = \Validator::make($request->toArray(), [
//            'name' => 'required|max:100'
//        ]);
//
//        if ($validator->fails()) {
//            return Redirect::back()->withErrors($validator)->withInput();
//        }

        $manufacturer = Supplier::find($request->supplier_id);
        $manufacturer->first_name = $request->first_name;
        $manufacturer->last_name = $request->last_name;
        $manufacturer->email = $request->email;
        $manufacturer->phone = $request->phone;
        $manufacturer->address = $request->address;
        $manufacturer->supplierDescription = $request->supplierDescription;
        $manufacturer->save();

        Session::put('success','Supplier updated successfully!');

        return Redirect::to('/admin/supplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function products($id){

//        $products =  DB::table('products')
//            ->join('categories', 'products.cat_id', '=', 'categories.cat_id')
//            ->select('products.*', 'categories.*')
//            ->where('supplier_id',$id)
//            ->get();
//
//        $image = DB::table('products')
//            ->join('imageTable', 'products.products_id', '=', 'imageTable.refId')
//            ->select('products.*', 'imageTable.*')
//            ->where('imageTable.refId','6')
//            ->where('table','products')
//            ->first();
        $products = DB::table('products')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->leftJoin('imageTable', 'imageTable.refId', '=', 'products.products_id')
            ->select('categories.*','products.*','imageTable.*')->where('supplier_id',$id)->groupBy('products_id')
            ->get();
        $supplier = Supplier::where('supplier_id',$id)->first();
        $meta = array('page_title'=>'Suppliers Products', 'supp_main_menu'=>'active');
        return view('admin/supplier/products')->with('items',$products)->with('supplier',$supplier)->with('meta',$meta);
    }

    public function product_details($id){

        $image = DB::table('imageTable')
            ->where('refId',$id)
            ->get();

        $products =  DB::table('products')
            //->join('categories', 'products.cat_id', '=', 'categories.cat_id')
//            ->select('products.*', 'categories.*')
			->select('products.*')
            ->where('products_id',$id)
            ->first();

        $meta = array('page_title'=>'Suppliers Product Details', 'supp_main_menu'=>'active');
        return view('admin/supplier/product_details')->with('meta',$meta)->with('images',$image)->with('product',$products);
    }

    public function destroy($id)
    {
        $category = Supplier::find($id);
        if(isset($category)){

            $category->delete();

            Session::put('success','Category deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
	public function SupplierDetail($id)
    {
		$suppProducts = Products::select('*')->where('supplier_id','=',$id)->get();
		$orders = DB::table('orders')
            ->leftJoin('products', 'products.products_id', '=', 'orders.products_id')
            ->select('orders.*','products.products_name')->where('products.supplier_id',$id)
            ->get();
        $meta = array('page_title'=>'Supplier Detail', 'supp_main_menu'=>'active', 'supp_sub_menu_new'=> 'active');
        return view('admin.supplier.detail')->with('meta', $meta)
		->with('suppProducts',$suppProducts)
		->with('orders',$orders);
    }
}
