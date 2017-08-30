<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\Supplier;
use App\Models\m_flag;
use App\Models\Brands;
use App\Models\settings;
use App\Models\imageTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Storage;

/**
 * BrandsController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class BrandsController extends Controller
{
	var $supplier_info = null;
	public function __construct()
	{
		$this->supplier_info = Supplier::where('user_id', '=', Auth::user()->user_id)->first();
	}

	public function index()
	{
		return view('supplier.brands.new')
			->with('page_title', 'New Brand')
			->with('brand_main_menu', 'active')
			->with('brand_new', 'active');
	}
	public function brandList()
	{
			$table1 = DB::table('Brands')
            ->leftJoin('imageTable', function ($join) {
                $join->on('Brands.id', '=', 'imageTable.refId')
                    ->where('imageTable.table', '=', 'Brands');
            })
            ->select('Brands.*','imageTable.image_path')->where('Brands.supplier_id',$this->supplier_info->supplier_id)->get();
			/*$table1 =  DB::table('Brands')->select('*')->where('Brands.supplier_id','=',$this->supplier_info->supplier_id)
            ->get();		*/
		return view('supplier.brands.brand-list')
			->with('page_title', 'Brand List')
			->with('brand_main_menu', 'active')
			->with('brand_list', 'active')
			->with('table1',$table1);  
			
			
	}
	public function store(Request $request)
	{
		$supplier_id = $this->supplier_info->supplier_id;
		$brands_id = Brands::create([
                'brandDescriptiion' =>  $request->brandDescriptiion,
                'brandName' =>  $request->brandName,
                'supplier_id' => $supplier_id
            ])->id;
		Session::put('success','Brand Created!');
		$this->uploadImage($request,$brands_id,'Brands');
		return Redirect::Back();
	}
	public static function uploadImage(Request $request,$refId,$table)
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
    //$path = 'public/'.$table.'/'.$refId.'_'.mt_rand();
	$path = 'public/images/brands';
	//$path = 'public/products/'.$productId.'_'.mt_rand();
	//	File::makeDirectory($path, 0777, true, true);
    foreach($files as $file) {
      $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
      //$validator = Validator::make(array('file'=> $file), $rules);
      //if($validator->passes()){
      	$rand_num = rand(11111, 99999);
        $filename = $rand_num .'-'.$file->getClientOriginalName();
        $upload_success = $file->move($path, $filename);

		if($request->update == "update"){
		$images = imageTable::where('refId',$refId)->where('table','=','Brands')->update([
        'image_path' => $path.'/'.$filename
           ]);
		   }	
    $data = new imageTable;
    $data->image_path = $path.'/'.$filename;
    $data->refId = $refId;
    $data->table = $table;
    $data->pixle = '500';
    $data->save();
    $uploadcount ++;
      //}
    }
    if($uploadcount == $file_count){
      echo 'success';
    } 
    else {
      echo 'fail';
    }
	//}
}

public function edit($id)
	{
	
		/*$productSearch = DB::table('Brands')->where('id','=',$id)->first();
			
		$imageTable = DB::table('imageTable')->where('refId','=',$productSearch->id)
		->where('table','=','Brands')
		->get();
			dd($productSearch);*/
			$imageTable = DB::table('imageTable')->select('*')->where('refId','=',$id)->where('table','=','Brands')->first();
		$table1 =  DB::table('Brands')->select('*')->where('Brands.id','=',$id)
            ->first();		
		//dd($imageTable);
	
		return view('supplier.brands.edit')
			->with('page_title', 'Brand List')
			->with('brand_main_menu', 'active')
			->with('brand_list', 'active')
			->with('imageTable',$imageTable)
			->with('table1',$table1);  
	}
	
	
public function update(Request $request)
    {
		$id = $request->brand_id;	
        $club_detail = Brands::findOrfail($id);
        $club_detail->brandName = $request->brands_name;
        $club_detail->brandDescriptiion = $request->brands_description;
		$club_detail->save();
    if($request->hasFile('files')) {
			$this->uploadImage($request,$id,'Brands');	
		}
		return Redirect::to('/supplier/product/brands/list');
	}
}