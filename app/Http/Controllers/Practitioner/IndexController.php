<?php
namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaRegFormRequest;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\ContactGroup;
use App\Models\ExerciseRequestDetail;
use App\Models\NutritionRequestDetail;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\Supplement;
use App\Models\SupplementRequest;
use App\Models\NutritionRequest;
use App\Models\ExerciseRequest;
use App\Models\SupplementRequestDetail;
use App\Models\User;
use App\Models\SuggestionsSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\adminBlog;
use File;

class IndexController extends Controller
{
	var $practitioner_info = null;
	public function __construct()
	{	
		$this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
		//$this->destPath = 'public/images/practitioners/'.Auth::user()->user_id;
		$this->destPath = 'public/images/practitioners/'.$this->practitioner_info->url;
		Session::put('practitioner_session', $this->practitioner_info);
		Session::set('dashboard', 'active');
		Session::pull('management');
		Session::pull('marketing');
		$pathIsset = Session::get('setPath');
		if($pathIsset==""||$pathIsset!=$this->destPath)
		{
			//$path = 'public/images/practitioners/'.Auth::user()->user_id;
			$path = 'public/images/practitioners/'.$this->practitioner_info->url;
			File::makeDirectory($path, 0777, true, true);
		//	$url = url('/').'/public/plugins/fileman_lastest/php/setSessionPublic.php';
		//	header('Location: '.$url.'?path='.$this->practitioner_info-url.'&role=practitioner');
			Session::put('setPath',$path);
		}
		
	}

	public function index()
	{
		/// module:patient
		// view folder name: index
		// file: index
         $prac = Session::get('practitioner_session');
         $pra = Practitioner::find($prac['pra_id']);
		$sup_requests = DB::table("supplement_requests AS sr")
		->join("patients AS p", "p.pa_id", "=", "sr.pa_id")
		->join("users AS u", "u.user_id", "=", "p.user_id") 
		->select('u.first_name', 'u.last_name', 'sr.*',
			'u.cell', 'u.gender', 'u.address')
		->where('sr.pra_id', '=', $this->practitioner_info->pra_id)->where('sr.status', '=', '0')
			->orderBy('sr.sr_id', 'desc')
		->get();
		$nut_requests = DB::table("nutrition_requests AS nr")
			->join("patients AS p", "p.pa_id", "=", "nr.pa_id")
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('u.first_name', 'u.last_name', 'nr.*',
				'u.cell', 'u.gender', 'u.address')
			->where('nr.pra_id', '=', $this->practitioner_info->pra_id)
			->where('nr.status', '=', '0')->orderBy('nr.nr_id', 'desc')
			->get();
		$exe_requests = DB::table("exercise_requests AS er")
			->join("patients AS p", "p.pa_id", "=", "er.pa_id")
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('u.first_name', 'u.last_name', 'er.*',
				'u.cell', 'u.gender', 'u.address')
			->where('er.pra_id', '=', $this->practitioner_info->pra_id)
			->where('er.status', '=', '0')->orderBy('er.er_id', 'desc')
			->get();
			$suggestion = SuggestionsSearch::where('sug_type', '=', 1)
            ->where("pra_id", "=", $this->practitioner_info->pra_id)->where('created_at', date('Y-m-d'))
            ->orderBy('created_at', 'desc')->get();
        $list_nut = SuggestionsSearch::where('sug_type', '=', 2)
            ->where("pra_id", "=", $this->practitioner_info->pra_id)->where('created_at', date('Y-m-d'))
            ->orderBy('created_at', 'desc')->get();
			$adminBlog = DB::table('adminBlog')
			->leftJoin('users', 'adminBlog.created_by', '=', 'users.user_id')
			->select('adminBlog.*','users.first_name','users.last_name')
			->where('adminBlog.type','2')
			->orderBy('id', 'desc')->paginate(10);
		return view('practitioner.index.index')->with('hide_sidebar', 'no-sidebar')
		->with('practitioner_info', $this->practitioner_info)
			->with('supplement_requests', $sup_requests)
			->with('nutrition_requests', $nut_requests)
			->with('exercise_requests', $exe_requests)
			->with('suggestion',$suggestion)
			->with('pra',$pra)
			->with('list_nut',$list_nut)
			->with('adminBlog',$adminBlog)
			;
	}
	
	public function supplementRequestDetails($id){
		$sup_requests = DB::table("supplement_requests AS sr")
			->join("patients AS p", "p.pa_id", "=", "sr.pa_id")
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('u.*', 'sr.*')->where('sr.sr_id',$id)
			->get();
		$sup_details = DB::table("supplement_request_details AS srd")
			->join("supplements AS s", "s.sup_id", "=", "srd.sup_id")
			->select('s.*', 'srd.*')->where('srd.sr_id',$id)
			->get();
		$supplement = SupplementRequest::find($id);
		return view('practitioner.index.supplement-request-details')->with('hide_sidebar', 'no-sidebar')
			->with('sup_requests', $sup_requests)
			->with('sup_details', $sup_details)
			->with('supplement', $supplement);
	}
	public function nutritionRequestDetails($id){
		$sup_requests = DB::table("nutrition_requests AS nr")
			->join("patients AS p", "p.pa_id", "=", "nr.pa_id")
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('u.*', 'nr.*')->where('nr.nr_id',$id)
			->get();
		$sup_details = DB::table("nutrition_request_details AS nrd")
			->join("nutritions AS n", "n.nut_id", "=", "nrd.nut_id")
			->select('n.*', 'nrd.*')->where('nrd.nr_id',$id)
			->get();
		$nutrition = NutritionRequest::find($id);
		return view('practitioner.index.nutrition-request-details')->with('hide_sidebar', 'no-sidebar')
			->with('sup_requests', $sup_requests)
			->with('sup_details', $sup_details)
			->with('nutrition', $nutrition);
	}
	public function exerciseRequestDetails($id){
		$sup_requests = DB::table("exercise_requests AS nr")
			->join("patients AS p", "p.pa_id", "=", "nr.pa_id")
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('u.*', 'nr.*')->where('nr.er_id',$id)
			->get();
		$sup_details = DB::table("exercise_request_details AS nrd")
			->join("exercises AS n", "n.exe_id", "=", "nrd.exe_id")
			->select('n.*', 'nrd.*')->where('nrd.er_id',$id)
			->get();
		$exercise = ExerciseRequest::find($id);
		return view('practitioner.index.exercise-request-details')->with('hide_sidebar', 'no-sidebar')
			->with('sup_requests', $sup_requests)
			->with('sup_details', $sup_details)
			->with('exercise', $exercise);
	}
	public function exerciseApproved($id){

		$exercise = ExerciseRequestDetail::find($id);
		$exercise->status = '1';
		$exercise->save();
		return Redirect::back();
	}
	public function exerciseReject($id){

		$exercise = ExerciseRequestDetail::find($id);
		$exercise->status = '2';
		$exercise->save();
		return Redirect::back();
	}
	public function supplementApproved($id){

	$exercise = SupplementRequestDetail::find($id);
	$exercise->status = '1';
	$exercise->save();
	return Redirect::back();
}
	public function supplementReject($id){

		$exercise = SupplementRequestDetail::find($id);
		$exercise->status = '2';
		$exercise->save();
		return Redirect::back();
	}
	public function nutritionApproved($id){

		$exercise = NutritionRequestDetail::find($id);
		$exercise->status = '1';
		$exercise->save();
		return Redirect::back();
	}
	public function nutritionReject($id){

		$exercise = NutritionRequestDetail::find($id);
		$exercise->status = '2';
		$exercise->save();
		return Redirect::back();
	}
	public function createPatient()
	{
		return view('practitioner.index.new-patient');
	}

	public function savePatient(PaRegFormRequest $request)
	{
		$password = Str::quickRandom(8);
		$user = User::create([
			'role'  => 4,
			'first_name' => $request->get('first_name'),
			'last_name' => $request->get('last_name'),
			'email' => $request->get('email'),
			'password'  => bcrypt($password),
			'phone' => $request->get('phone'),
			'cell' => $request->get('cell'),
			'gender' => $request->get('gender'),
			'address' => $request->get('address')
		]);

		$patient = Patient::create([
			'user_id'  => $user->user_id,
			'pra_id' => Auth::user()->user_id
		]);

		$this->sendEmail(array(
			'created_by' => ucwords(Auth::user()->first_name) .' '. ucwords(Auth::user()->last_name),
			'name' => ucwords($request->get('first_name')) .' '. ucwords($request->get('last_name')),
			'email' => $request->get('email'),
			'password'  => $password
		));

		Session::put('success', 'Patient created successfully!');
		return Redirect::to('practitioner/index/patient-list');
	}

	public function patientList()
	{
		$patients = DB::table("users AS u")
			->join("patients AS p", "p.user_id", "=", "u.user_id")
			->select('u.user_id', 'pa_id', 'u.first_name', 'u.last_name', 'u.email', 'u.phone',
				'u.cell', 'u.gender', 'u.address')
			->where('p.pra_id', '=', Auth::user()->user_id)
			->get();

		return view('practitioner.index.patient-list')
		->with('patients', $patients)
		->with('practitioner_info', $this->practitioner_info);
	}

	private function sendEmail($data)
	{
		Mail::send('practitioner.index.patient-email-template', $data, function ($message) use ($data) {

			$message->from('noreply@practicetabs.com', 'practicetabs.com');
			$message->to(trim($data['email']));
			$message->subject('Patient Registration');
		});
	}

	public function newSuggestions()
	{
		$contact_groups = ContactGroup::select('name', 'cg_id')
			->where('pra_id', '=', $this->practitioner_info->pra_id)
			->get();

		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')->get();

		return view('practitioner.index.new-suggestions')
		->with('practitioner_info',$this->practitioner_info)->with('hide_sidebar', 'no-sidebar')
			->with('contact_groups', $contact_groups)->with('supplements', $supplements);
	}

	public function saveSuggestions(Request $request)
	{
		return Redirect::Back();
	}

	public function changePassword()
	{
		return view('practitioner.index.change-password')
		->with('practitioner_info',$this->practitioner_info)
		;
	}

	public function saveNewPassword(ChangePassFormRequest $request)
	{
		$user = User::find(Auth::user()->user_id);
		$user->password = bcrypt($request['new_password']);
		$user->save();

		Session::put('success', 'Your password has been changed successfully!');
		return Redirect::Back();
	}
}
