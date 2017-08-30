<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\ContactGroup;
use App\Models\Practitioner;
use App\Models\Patient;
use App\Models\Products;
use App\Models\ContactInGroup;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ContactGroupController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cg_list = ContactGroup::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
        $meta = array('page_title'=>'Group List', 'cm_main_menu'=>'active', 'cg_sub_menu_list'=>'active');

        return view('practitioner.contact-group.index')->with('meta', $meta)->with('cg_list', $cg_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'Create New Group', 'cm_main_menu'=>'active', 'cg_sub_menu_list'=> 'active');

        return view('practitioner.contact-group.new')->with('meta', $meta);
    }
	public function ecommerceGroup($type)
    {
		$data;
		if($type==1)
		{
			$groupType = 'Create New Product Group';
			$cm_main_menu = 'cm_main_menu_'.$type;
			$data = DB::table('Practitioner_product')
            ->leftJoin('products', 'Practitioner_product.product_id', '=', 'products.products_id')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('Practitioner_product.*','products.*','categories.cat_name',DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier_name"))
            ->where('store_id',$this->practitioner_info->pra_id)
            ->get();
		}
		elseif($type==2)
		{
			$cm_main_menu = 'cm_main_menu_'.$type;
			$groupType = 'Create New Patient Group';
			$data = DB::table('pra_pa')
            ->leftJoin('patients', 'pra_pa.pa_id', '=', 'patients.pa_id')
            ->select('pra_pa.*','patients.*', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
            ->where('pra_id',$this->practitioner_info->pra_id)
            ->get();
		}
        $meta = array('page_title'=>$groupType, $cm_main_menu=>'active','store_main'=>'active');
        return view('practitioner.contact-group.ecommerce-group-new')
		->with('type',$type)
		->with('practitioner_info',$this->practitioner_info)
		->with('directory',$this->practitioner_info->directory)
		->with('meta', $meta)->with('data',$data)
		->with('store_group','active')
		;
    }
	public function EcommerceStore(Request $request)
    {
		//cnt_id = id of product 
		Session::put('pa_eco_list', $request['pa_id']);
		$pro_id = Session::has('pa_eco_list') ? Session::get('pa_eco_list') : array();
		$letItGo = false;
		$sessionshow = '';
		if($request['type']==1)
		{
			$sessionshow = 'Product Group Successfully created!';
			if(count($pro_id)<=3)
			{
				$letItGo=true;
			}
			else{
				Session::put('error','Please select atleast 3 products');
				return Redirect::Back();
			}
		}
		if($request['type']==2)
		{
			$sessionshow = 'Patient Group Successfully created!';
			if(count($pro_id)>0)
			{
				$letItGo=true;
			}
		}
		if($letItGo)
		{
		if(!empty($pro_id)) {
        $validator = \Validator::make($request->toArray(), [
            'name' => 'required|max:50'
        ]);
			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput();
			}
			$input = $request->all();
			$input['pra_id'] = $this->practitioner_info->pra_id;
			$contactGroup = ContactGroup::create($input);
			foreach($pro_id as $item)
			{
				$contactInGroup = new ContactInGroup;
				$contactInGroup->cg_id =$contactGroup->cg_id; 
				$contactInGroup->cnt_id =$item;
				$contactInGroup->save();
			}
			Session::put('success',$sessionshow);
			return Redirect::Back();
			}
		}
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->toArray(), [
            'name' => 'required|max:50'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        $input['pra_id'] = $this->practitioner_info->pra_id;
        ContactGroup::create($input);

        Session::put('success','Contact group saved successfully!');

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
        $cg = ContactGroup::find($id);
        $meta = array('page_title'=>'Edit Group', 'cm_main_menu'=>'active');

        return view('practitioner.contact-group.edit')->with('meta', $meta)->with('cg', $cg);
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
        $validator = \Validator::make($request->toArray(), [
            'name' => 'required|max:50'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $cg = ContactGroup::find($request->cg_id);
        $cg->name = $request->name;
        $cg->description = $request->description;
        $cg->save();

        Session::put('success','Contact group updated successfully!');

        return Redirect::to('/practitioner/contact-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cg = ContactGroup::find($id);
        if(isset($cg)){
            $cg->delete();

            Session::put('success','Contact group deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
