<?php
namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Models\Nutrition;
use App\Models\NutSuggestionsDetails;
use App\Models\NutSuggestionsMaster;
use App\Models\Patient;
use App\Models\proSuggestionsMaster;
use App\Models\proSuggestionsDetails;
use App\Models\Practitioner;
use App\Models\Products;
use App\Models\Supplier;
use App\Models\Practitioner_product;
use App\Models\Supplement;
use App\Models\SupSuggestionsDetails;
use App\Models\SupSuggestionsMaster;
use App\Models\SuggestionsSearch;
use App\Models\ContactGroup;
use App\Models\ContactInGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use File;

/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class SuggestionController extends Controller
{
	var $practitioner_info = null;
	var $destPath = null;
	public function __construct()
	{
		$this->practitioner_info = Session::get('practitioner_session');
		Session::set('marketing', 'active');
		Session::pull('management');
		Session::pull('dashboard');
		$this->destPath = 'public/Supplier/'.Auth::user()->user_id;
		// $pathIsset = Session::get('setPath');
		// if($pathIsset==""||$pathIsset!=$this->destPath)
		// {
			// $path = 'public/Supplier/'.Auth::user()->user_id;
			// File::makeDirectory($path, 0777, true, true);
			// $url = url('/').'/public/dashboard/plugins/fileman_lastest/php/setSession.php';
			// header('Location: '.$url.'?path='.Auth::user()->user_id);
			// Session::put('setPath',$path);
		// }
	}

	public function showSupplementSuggestions()
	{
		$list = SuggestionsSearch::where('sug_type', '=', 1)
			->where("pra_id", "=", $this->practitioner_info->pra_id)
			->orderBy('created_at', 'desc')->get();

		return view('practitioner.suggestion.sup-suggestions')
		     ->with('list', $list)
			 ->with('sug_menu', 'active')
			 ->with('sup_sug_list', 'active')
			 ->with('practitioner_info',$this->practitioner_info);
	}

	public function supplementSuggestionDetails($id)
	{
		$list = SuggestionsSearch::where('id', $id)->first();
		$supplements = Supplement::select('name', 'used_for', 'main_image', 'short_description')
			->whereIn('sup_id', json_decode($list->sup_ids))->orderBy('name', 'asc')->get();

		$patients = Patient::select('photo', 'email', 'primary_phone', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			->whereIn('pa_id', json_decode($list->pa_ids))->orderBy('full_name', 'asc')->get();

		return view('practitioner.suggestion.sup-sug-details')->with('list', $list)
			->with('supplements', $supplements)->with('patients', $patients)
			->with('directory', $this->practitioner_info['directory'])->with('sug_menu', 'active');
	}
	public function newSupplementSuggestions()
	{
		return Redirect::to('/practitioner/suggestion/supplement-suggestions-wizzard');
		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
			->orderBy('name', 'asc')->get();

		$sup_ids = Session::has('sup_list') ? Session::get('sup_list') : array();
		$selected_sup = array();
		if(!empty($sup_ids)) {
			$selected_sup = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
				->whereIn('sup_id', $sup_ids)->get();
		}
		return view('practitioner.suggestion.new-sup-sug')
		->with('practitioner_info',$this->practitioner_info)
			->with('selected_sup', $selected_sup)->with('sup_ids', $sup_ids)
			->with('supplements', $supplements)->with('sug_menu', 'active')->with('sup_sug', 'active');
	}
	public function newSupplementSuggestionsWizzard()
    {
        $supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
            ->orderBy('name', 'asc')->get();

        $sup_ids = Session::has('sup_list') ? Session::get('sup_list') : array();
        $selected_sup = array();
        if(!empty($sup_ids)) {
            $selected_sup = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
                ->whereIn('sup_id', $sup_ids)->get();
        }

        //Patients 
        //SELECT
        $patients = Patient::select('mailing_city','billing_city',
'mailing_state','billing_state','billing_street_address','mailing_street_address',
        	'primary_phone','age','email','date_of_birth','pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name', 'asc')->get();

		$patient_ids = Session::has('sup_pa_list') ? Session::get('sup_pa_list') : array();
		$selected_patients = array();
		if(!empty($patient_ids)) {
			$selected_patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('pa_id', $patient_ids)->get();
		}
        //END
        return view('practitioner.suggestion.new-sup-sug-wizzard')
            ->with('selected_sup', $selected_sup)->with('sup_ids', $sup_ids)
            ->with('supplements', $supplements)->with('sug_menu', 'active')->with('sup_sug', 'active')
->with('selected_patients', $selected_patients)->with('patient_ids', $patient_ids)
			->with('patients', $patients)
            ;
    }
	public function returnDataInGroup(Request $request)
	{
		$cg_id = $_POST['cg_id'];
		$type = $_POST['type'];
		
		$CG = DB::table('contacts_in_groups');//->where('cg_id',$cg_id)->get();
		if($type==1){
			$CG=$CG->leftJoin('products as p1','p1.products_id','=','contacts_in_groups.cnt_id');
			$CG=$CG->leftJoin('categories', 'p1.cat_id', '=', 'categories.cat_id');
			$CG=$CG->leftJoin('suppliers', 'p1.supplier_id', '=', 'suppliers.supplier_id');
			$CG=$CG->join('contact_groups', function ($join) {
            $join->on('contacts_in_groups.cg_id', '=', 'contact_groups.cg_id')
                 ->where('contact_groups.type', '=', 1);
			});
			$CG=$CG->select('contacts_in_groups.*','p1.*','categories.cat_name',DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier_name"))->where('contacts_in_groups.cg_id','=',$cg_id)->get();
		}
		if($type==2){
			$CG=$CG->leftJoin('patients as p1','p1.pa_id','=','contacts_in_groups.cnt_id');
			$CG=$CG->join('contact_groups', function ($join) {
            $join->on('contacts_in_groups.cg_id', '=', 'contact_groups.cg_id')
                 ->where('contact_groups.type', '=', 2)->where('contact_groups.cg_id', '=', $_POST['cg_id']);
			});
			$CG=$CG->select('contacts_in_groups.*','p1.*')->where('contacts_in_groups.cg_id','=',$_POST['cg_id'])->get();
		}
		//dd($CG);return;
		$returnn='';
		foreach($CG as $items){
		if($type==2){
				$returnn.=$items->first_name .' '.$items->last_name;
				$returnn.=',';
				$returnn.=$items->pa_id;
				$returnn.=',';
				$returnn.=$items->email;
				$returnn.=',';
				$returnn.=$items->date_of_birth;
				$returnn.=',';
				$returnn.=$items->primary_phone;
				$returnn.=',';
				$returnn.=$items->mailing_street_address;
				$returnn.=',';
				$returnn.=$items->billing_street_address;
				$returnn.='|';
			}
		if($type==1){
				if(isset($items->mainImage) && (!empty($items->mainImage))){
					$returnn.= $items->mainImage;
				}
				else
				{
					$returnn.='public/dashboard/img/no_image_64x64.jpg';
				}
				$returnn.=',';
				$returnn.=$items->products_name;
				$returnn.=',';
				$returnn.=$items->supplier_name;
				$returnn.=',';
				$returnn.=$items->products_id;
				$returnn.=',';
				$returnn.=$items->cat_name;
				$returnn.='|';
			}
		}
		$returnn = rtrim($returnn, "|");
		echo $returnn;
		
	}
	public function newProductSuggestionsWizzard()
    {
		$productGroup = DB::table('contact_groups')->where('type','1')->get();
		$patientGroup = DB::table('contact_groups')->where('type','2')->get();
        $products = DB::table('Practitioner_product')
            ->leftJoin('products', 'Practitioner_product.product_id', '=', 'products.products_id')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('Practitioner_product.*','products.*','categories.cat_name',DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier_name"))
            ->where('store_id',$this->practitioner_info->pra_id)
            ->get();

        $pro_ids = Session::has('pro_list') ? Session::get('pro_list') : array();
        $selected_pro = array();
		
        if(!empty($pro_ids)) {
            // $selected_pro = Products::whereIn('products_id', $pro_ids)->get();
			$selected_pro = DB::table('products')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('products.*','categories.cat_name',DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier_name"))
            ->whereIn('products.products_id', $pro_ids)
            ->get();
        }

        //Patients 
        //SELECT
        $patients = DB::table('pra_pa')
            ->leftJoin('patients', 'pra_pa.pa_id', '=', 'patients.pa_id')
            ->select('pra_pa.*','patients.*', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
            ->where('pra_id',$this->practitioner_info->pra_id)
            ->get();

		$patient_ids = Session::has('pro_pa_list') ? Session::get('pro_pa_list') : array();
		$selected_patients = array();
		if(!empty($patient_ids)) {
			$selected_patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('pa_id', $patient_ids)->get();
		}
        //END
		$meta = array('store_main'=>'active');
        return view('practitioner.suggestion.new-pro-sug-wizzard') 
		->with('practitioner_info',$this->practitioner_info)
            ->with('selected_pro', $selected_pro)->with('pro_ids', $pro_ids)
            ->with('products', $products)->with('sug_menu', 'active')->with('pro_sug', 'active')
->with('selected_patients', $selected_patients)->with('patient_ids', $patient_ids)
			->with('patients', $patients)
			->with('productGroup',$productGroup)
			->with('patientGroup',$patientGroup)->with('meta',$meta)
            ;
    }
	public function addProductWizzard(Request $request)
    {
    	Session::put('pro_list', $request['pro_id']);
    	// $supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
			// ->orderBy('name', 'asc')->get();
		
		$pro_id = Session::has('pro_list') ? Session::get('pro_list') : array();
		$selected_pro = array();
		if(!empty($pro_id)) {
			$selected_pro = DB::table('products')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
            ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
            ->select('products.*','categories.cat_name',DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier_name"))
            ->whereIn('products.products_id', $pro_id)
            ->get();
			//$selected_pro = Products::whereIn('products_id', $pro_id)->get();
		}
		$returnn = '';
		$image = '';
		foreach ($selected_pro as $item)
        {
        	if(isset($item->mainImage) && (!empty($item->mainImage))){
        	$returnn.= $item->mainImage;
			}
			else
			{
				$returnn.='public/dashboard/img/no_image_64x64.jpg';
			}
			$returnn.= ',';
        	$returnn.=$item->products_name;
        	$returnn.= ',';
            $returnn.=$item->cat_name;
            $returnn.=',';
            $returnn.=$item->products_id;
            $returnn.='|';
        }
        $returnn = rtrim($returnn, "|");
        echo $returnn;
    }
	public function addProPatientsWizzard(Request $request)
	{
		Session::put('pro_pa_list', $_POST['pa_id']);
		$patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name', 'asc')->get();

		$patient_ids = Session::has('pro_pa_list') ? Session::get('pro_pa_list') : array();
		$selected_patients = array();
		if(!empty($patient_ids)) {
			$selected_patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('pa_id', $patient_ids)->get();
		}
		$returnn='';
		foreach ($selected_patients as $item)
        {
            $returnn.=$item->full_name;
            $returnn.=',';
            $returnn.=$item->pa_id;
            $returnn.='|';
        }
        $returnn = rtrim($returnn, "|");
        echo $returnn;
	}
	
	public function saveProductSuggestionsWizz()
	{
		$master = proSuggestionsMaster::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'message'	=>	$_POST['ourTest']
		]);

		foreach ($_POST['pa_id'] as $pa_id){
			foreach ($_POST['pro_id'] as $pro_id){
				proSuggestionsDetails::create([
					'master_id'	=>	$master['id'],
					'pa_id'		=>	$pa_id,
					'products_id'	=>	$pro_id
				]);
			}
		}

		SuggestionsSearch::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'pra_fullname' => ($this->practitioner_info->first_name . ' ' .$this->practitioner_info->middle_name . ' ' .$this->practitioner_info->last_name),
			'message'	=>	$_POST['ourTest'],
			'master_id'	=>	$master['id'],
			'pa_ids'		=>	json_encode($_POST['pa_id']),
			'products_id'	=>	json_encode($_POST['pro_id']),
			'created_at' =>	date('Y/m/d'),
			'sug_type'	=>	3	// 3=products
		]);
		
		// remove by key
		Session::forget('pro_pa_list');
		Session::forget('pro_list');

		Session::put('success','Products suggestions sent to patient(s) successfully!');
		echo 'success';
	}

    public function addSupplementsWizzard(Request $request)
    {
    	Session::put('sup_list', $_POST['sup_id']);
    	$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
			->orderBy('name', 'asc')->get();

		$sup_ids = Session::has('sup_list') ? Session::get('sup_list') : array();
		$selected_sup = array();
		if(!empty($sup_ids)) {
			$selected_sup = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
				->whereIn('sup_id', $sup_ids)->get();
		}
		$returnn = '';
		$image = '';
		foreach ($selected_sup as $item)
        {
        	if(isset($item->main_image) && (!empty($item->main_image))){
        	$returnn.= $item->main_image;
        }
        else
        {
        	$returnn.='public/dashboard/img/no_image_64x64.jpg';
        }
        $returnn.= ',';
        	$returnn.=$item->name;
        	$returnn.= ',';
            $returnn.=$item->used_for;
            $returnn.=',';
            $returnn.=$item->sup_id;
            $returnn.='|';
        }
        $returnn = rtrim($returnn, "|");
        echo $returnn;
    }
	
	public function addSupplements(Request $request)
	{
		Session::put('sup_list', $request['sup_id']);

		return Redirect::Back();
	}
	public function newSupSugPatients()
	{
		$patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name', 'asc')->get();

		$patient_ids = Session::has('sup_pa_list') ? Session::get('sup_pa_list') : array();
		$selected_patients = array();
		if(!empty($patient_ids)) {
			$selected_patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('pa_id', $patient_ids)->get();
		}

		return view('practitioner.suggestion.newSupSugPatient')
			->with('selected_patients', $selected_patients)->with('patient_ids', $patient_ids)
			->with('patients', $patients)->with('sug_menu', 'active')->with('sup_sug', 'active');
	}

	public function addSugPatients(Request $request)
	{
		Session::put('sup_pa_list', $request['pa_id']);

		return Redirect::Back();
	}
	public function addPatientsWizzard(Request $request)
	{
		Session::put('sup_pa_list', $_POST['pa_id']);
		$patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name', 'asc')->get();

		$patient_ids = Session::has('sup_pa_list') ? Session::get('sup_pa_list') : array();
		$selected_patients = array();
		if(!empty($patient_ids)) {
			$selected_patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('pa_id', $patient_ids)->get();
		}
		$returnn='';
		foreach ($selected_patients as $item)
        {
            $returnn.=$item->full_name;
            $returnn.=',';
            $returnn.=$item->pa_id;
            $returnn.='|';
        }
        $returnn = rtrim($returnn, "|");
        echo $returnn;
	}

	public function confirmSupplementSuggestions()
	{
		$sup_ids = Session::get('sup_list');
		$patient_ids = Session::get('sup_pa_list');

		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
			->whereIn('sup_id', $sup_ids)->get();

		$patients = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			->whereIn('pa_id', $patient_ids)->get();

		return view('practitioner.suggestion.confirm-sup-suggestions')
			->with('patients', $patients)
			->with('supplements', $supplements)->with('sug_menu', 'active');
	}

	public function saveSupplementSuggestions(Request $request)
	{
		$master = SupSuggestionsMaster::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'message'	=>	$request['message']
		]);

		foreach ($request['pa_id'] as $pa_id){
			foreach ($request['sup_id'] as $sup_id){
				SupSuggestionsDetails::create([
					'master_id'	=>	$master['id'],
					'pa_id'		=>	$pa_id,
					'sup_id'	=>	$sup_id
				]);
			}
		}

		SuggestionsSearch::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'pra_fullname' => ($this->practitioner_info->first_name . ' ' .$this->practitioner_info->middle_name . ' ' .$this->practitioner_info->last_name),
			'message'	=>	$request['message'],
			'master_id'	=>	$master['id'],
			'pa_ids'		=>	json_encode($request['pa_id']),
			'sup_ids'	=>	json_encode($request['sup_id']),
			'created_at' =>	date('Y/m/d'),
			'sug_type'	=>	1	// 1=supplement
		]);
		
		// remove by key
		Session::forget('sup_pa_list');
		Session::forget('sup_list');

		Session::put('success','Supplements suggestions sent to patient(s) successfully!');
		return Redirect::to('/practitioner/suggestion/supplement-suggestions');
	}
	public function saveSuggestionsWizzard()
	{
		$master = SupSuggestionsMaster::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'message'	=>	$_POST['message']
		]);

		foreach ($_POST['pa_id'] as $pa_id){
			foreach ($_POST['sup_id'] as $sup_id){
				SupSuggestionsDetails::create([
					'master_id'	=>	$master['id'],
					'pa_id'		=>	$pa_id,
					'sup_id'	=>	$sup_id
				]);
			}
		}

		SuggestionsSearch::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'pra_fullname' => ($this->practitioner_info->first_name . ' ' .$this->practitioner_info->middle_name . ' ' .$this->practitioner_info->last_name),
			'message'	=>	$_POST['message'],
			'master_id'	=>	$master['id'],
			'pa_ids'		=>	json_encode($_POST['pa_id']),
			'sup_ids'	=>	json_encode($_POST['sup_id']),
			'created_at' =>	date('Y/m/d'),
			'sug_type'	=>	1	// 1=supplement
		]);
		
		// remove by key
		Session::forget('sup_pa_list');
		Session::forget('sup_list');

		Session::put('success','Supplements suggestions sent to patient(s) successfully!');
		echo 'success';
	}

	public function getSelectedPatient()
	{
		if(!Session::has('patient_list')){
			Session::put('patient_list', array());
		}
		Session::push('patient_list', Input::get('id'));

		$unique_ids = array_unique(Session::get('patient_list'));

		$patient = Patient::select('pa_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			->whereIn('pa_id', $unique_ids)->get();

		return Datatables::of($patient)
			->addColumn('Remove', function ($p) {
				return '<input type="hidden" name="pa_id[]" value="'.$p->pa_id.'" />'.
					'<a href="javascript:void(0);" class="text-danger" onclick="removeRow(this, '.$p->pa_id.')"><i class="fa fa-times"></i> Remove</a>';
			})
			->removeColumn('pa_id')
			->make();
	}

	public function removeSelectedPatient()
	{
		$patient_ids = Session::get('sup_pa_list');
		foreach ($patient_ids as $index => $val) {
			if ($val == Input::get('s_pa_id')) {
				unset($patient_ids[$index]);
			}
		}

		Session::put('sup_pa_list', $patient_ids);
		echo 'success';
	}

	public function removeSelectedSupplements()
	{
		$sup_ids = Session::get('sup_list');
		foreach ($sup_ids as $index => $val) {
			if ($val == Input::get('sup_id')) {
				unset($sup_ids[$index]);
			}
		}
		Session::put('sup_list', $sup_ids);
		echo 'success';
	}

	public function clearSupSugSessions()
	{
		Session::forget('sup_pa_list');
		Session::forget('sup_list');
		return Redirect::to('/practitioner/suggestion/supplement-suggestions');
	}

	/* NUTRITION CODE START */
	public function showNutritionSuggestions()
	{
		$list = SuggestionsSearch::where('sug_type', '=', 2)
			->where("pra_id", "=", $this->practitioner_info->pra_id)
			->orderBy('created_at', 'desc')->get();

		return view('practitioner.suggestion.nut-suggestions')->with('list', $list)
			->with('sug_menu', 'active')->with('nut_sug_list', 'active');
	}

	public function nutritionSuggestionDetails($id)
	{
		$list = SuggestionsSearch::where('id', $id)->first();
		$nutrition = Nutrition::select('name', 'usability', 'main_image', 'short_description')
			->whereIn('nut_id', json_decode($list->nut_ids))->orderBy('name', 'asc')->get();

		$patients = Patient::select('photo', 'email', 'primary_phone', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			->whereIn('pa_id', json_decode($list->pa_ids))->orderBy('full_name', 'asc')->get();

		return view('practitioner.suggestion.nut-sug-details')->with('list', $list)
			->with('nutrition', $nutrition)->with('patients', $patients)
			->with('directory', $this->practitioner_info['directory'])->with('sug_menu', 'active');
	}

	public function newNutritionSuggestions()
	{
		return Redirect::to('/practitioner/suggestion/nutrition-suggestions-wizzard');
		$nutrition = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
			->orderBy('name', 'asc')->get();

		$nut_ids = Session::has('nut_selected_list') ? Session::get('nut_selected_list') : array();
		$selected_nut = array();
		if(!empty($nut_ids)) {
			$selected_nut = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
				->whereIn('nut_id', $nut_ids)->get();
		}

		return view('practitioner.suggestion.new-nut-suggestions')
			->with('selected_nut', $selected_nut)->with('nut_ids', $nut_ids)
			->with('nutrition', $nutrition)->with('sug_menu', 'active')->with('nut_sug', 'active');
	}
	public function newNutritionSuggestionsWizzard()
	{
		$nutrition = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
			->orderBy('name', 'asc')->get();

		$nut_ids = Session::has('nut_selected_list') ? Session::get('nut_selected_list') : array();
		$selected_nut = array();
		if(!empty($nut_ids)) {
			$selected_nut = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
				->whereIn('nut_id', $nut_ids)->get();
		}

		//PATIENT SELECT 
		//START
	/*	$patients = Patient::select('user_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name', 'asc')->get();*/
			$patients = Patient::select('mailing_city','billing_city',
'mailing_state','billing_state','billing_street_address','mailing_street_address',
        	'primary_phone','age','email','date_of_birth','user_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name', 'asc')->get();

		$patient_ids = Session::has('selected_nut_patients') ? Session::get('selected_nut_patients') : array();
		$selected_patients = array();
		if(!empty($patient_ids)) {
			$selected_patients = Patient::select('user_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('user_id', $patient_ids)->get();
		}
		//END

		return view('practitioner.suggestion.new-nut-sug-wizzard')
			->with('selected_nut', $selected_nut)->with('nut_ids', $nut_ids)
			->with('nutrition', $nutrition)->with('sug_menu', 'active')->with('nut_sug', 'active')
->with('selected_patients', $selected_patients)->with('patient_ids', $patient_ids)
			->with('patients', $patients)
			;
	}
	public function addNutrition(Request $request)
	{
		Session::put('nut_selected_list', $request['nut_id']);

		return Redirect::Back();
	}
	public function addNutritionWizzard()
	{
		Session::put('nut_selected_list', $_POST['nut_id']);
		$nutrition = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
			->orderBy('name', 'asc')->get();

		$nut_ids = Session::has('nut_selected_list') ? Session::get('nut_selected_list') : array();
		$selected_nut = array();
		if(!empty($nut_ids)) {
			$selected_nut = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
				->whereIn('nut_id', $nut_ids)->get();
		}
		$returnn = '';
		$image = '';

		foreach ($selected_nut as $item)
        {
        	if(isset($item->main_image) && (!empty($item->main_image))){
        	$returnn.= $item->main_image;
        }
        else
        {
        	$returnn.='public/dashboard/img/no_image_64x64.jpg';
        }
        $returnn.= ',';
        	$returnn.=$item->name;
        	$returnn.= ',';
            $returnn.=$item->usability;
            $returnn.=',';
            $returnn.=$item->nut_id;
            $returnn.='|';
        }
        $returnn = rtrim($returnn, "|");
        echo $returnn;
        echo ',';
		echo 'success';
	}
	public function removeSelectedNut()
	{
		$nut_ids = Session::get('nut_selected_list');
		foreach ($nut_ids as $index => $val) {
			if ($val == Input::get('nut_id')) {
				unset($nut_ids[$index]);
			}
		}
		Session::put('nut_selected_list', $nut_ids);
		echo 'success';
	}
	public function newNutSugPatients()
	{
		$patients = Patient::select('user_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name', 'asc')->get();

		$patient_ids = Session::has('selected_nut_patients') ? Session::get('selected_nut_patients') : array();
		$selected_patients = array();
		if(!empty($patient_ids)) {
			$selected_patients = Patient::select('user_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('user_id', $patient_ids)->get();
		}

		return view('practitioner.suggestion.newNutSugPatients')
			->with('selected_patients', $selected_patients)->with('patient_ids', $patient_ids)
			->with('patients', $patients)->with('sug_menu', 'active')->with('sup_sug', 'active');
	}
	public function addNutPatients(Request $request)
	{
		Session::put('selected_nut_patients', $request['pa_id']);

		return Redirect::Back();
	}
	public function addNutPatientsWizzard()
	{
		Session::put('selected_nut_patients', $_POST['pa_id']);
		$patients = Patient::select('user_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			//->where('pra_id', '=', $this->practitioner_info->pra_id)
			->orderBy('first_name', 'asc')->get();

		$patient_ids = Session::has('selected_nut_patients') ? Session::get('selected_nut_patients') : array();
		$selected_patients = array();
		if(!empty($patient_ids)) {
			$selected_patients = Patient::select('user_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
				->whereIn('user_id', $patient_ids)->get();
		}
		$returnn='';
		foreach ($selected_patients as $item)
        {
            $returnn.=$item->full_name;
            $returnn.=',';
            $returnn.=$item->user_id;
            $returnn.='|';
        }
        $returnn = rtrim($returnn, "|");
        echo $returnn;
	}
	public function removeNutPatient()
	{
		$patient_ids = Session::get('selected_nut_patients');
		foreach ($patient_ids as $index => $val) {
			if ($val == Input::get('nut_pat_id')) {
				unset($patient_ids[$index]);
			}
		}

		Session::put('selected_nut_patients', $patient_ids);
		echo 'success';
	}
	public function confirmNutritionSuggestions(Request $request)
	{
		$nuts_ids = Session::get('nut_selected_list');
		$patient_ids = Session::get('selected_nut_patients');

		$nutritions = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
			->whereIn('nut_id', $nuts_ids)->get();

		$patients = Patient::select('user_id', DB::raw('CONCAT(first_name, " ", middle_Name, " ", last_Name) AS full_name'))
			->whereIn('user_id', $patient_ids)->get();

		return view('practitioner.suggestion.confirm-nut-suggestions')
			->with('patients', $patients)
			->with('nutritions', $nutritions)->with('sug_menu', 'active');
	}

	public function saveNutritionSuggestions(Request $request)
	{
		$master = NutSuggestionsMaster::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'message'	=>	$request['message']
		]);

		foreach ($request['pa_id'] as $pa_id){
			foreach ($request['nut_id'] as $nut_id){
				NutSuggestionsDetails::create([
					'master_id'	=>	$master['id'],
					'pa_id'		=>	$pa_id,
					'nut_id'	=>	$nut_id
				]);
			}
		}

		SuggestionsSearch::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'pra_fullname' => ($this->practitioner_info->first_name . ' ' .$this->practitioner_info->middle_name . ' ' .$this->practitioner_info->last_name),
			'message'	=>	$request['message'],
			'master_id'	=>	$master['id'],
			'pa_ids'	=>	json_encode($request['pa_id']),
			'nut_ids'	=>	json_encode($request['nut_id']),
			'created_at' =>	date('Y/m/d'),
			'sug_type'	=>	2	// 2=nutrition
		]);
		Session::forget('selected_nut_patients');
		Session::forget('nut_selected_list');
		Session::put('success','Nutrition suggestions sent to patient(s) successfully!');
		return Redirect::to('/practitioner/suggestion/nutrition-suggestions');
	}

	public function saveNutritionSuggestionsWizz()
	{
		$master = NutSuggestionsMaster::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'message'	=>	$_POST['message']
		]);

		foreach ($_POST['pa_id'] as $pa_id){
			foreach ($_POST['nut_id'] as $nut_id){
				NutSuggestionsDetails::create([
					'master_id'	=>	$master['id'],
					'pa_id'		=>	$pa_id,
					'nut_id'	=>	$nut_id
				]);
			}
		}

		SuggestionsSearch::create([
			'pra_id'	=>	$this->practitioner_info->pra_id,
			'pra_fullname' => ($this->practitioner_info->first_name . ' ' .$this->practitioner_info->middle_name . ' ' .$this->practitioner_info->last_name),
			'message'	=>	$_POST['message'],
			'master_id'	=>	$master['id'],
			'pa_ids'	=>	json_encode($_POST['pa_id']),
			'nut_ids'	=>	json_encode($_POST['nut_id']),
			'created_at' =>	date('Y/m/d'),
			'sug_type'	=>	2	// 2=nutrition
		]);
		Session::forget('selected_nut_patients');
		Session::forget('nut_selected_list');
		Session::put('success',' Nutrition suggestions sent to patient(s) successfully!');
		echo 'success';
	}
}
