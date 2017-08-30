<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\message_header;
use App\Models\Shipping;
use App\Models\CreditCardInfo;
use App\Models\message_history;
use App\Models\ExerciseRequest;
use App\Models\ExerciseRequestDetail;
use App\Models\Exercises;
use App\Models\Nutrition;
use App\Models\NutritionRequest;
use App\Models\NutritionRequestDetail;
use App\Models\Patient; 
use App\Models\SupplementRequest;
use App\Models\SupplementRequestDetail;
use App\Models\SupSuggestionsMaster;
use App\Models\proSuggestionsMaster;
use App\Models\SuggestionsSearch;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\Practitioner;
use App\Models\Supplement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\scheduler;
use App\Models\PraSubscribe;
use App\Models\PractitionerPatient;
use App\Models\adminBlog;
/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class IndexController extends Controller
{
	var $patient_info = null;
	public function __construct()
	{
		$this->patient_info = Patient::where('user_id', '=', Auth::user()->user_id)->first();
	}

	public function index()
	{
		/*$praId = PractitionerPatient::where('pa_id','=',$this->patient_info->pa_id)->first();
		$praSub = PraSubscribe::where('pa_id','=',$this->patient_info->pa_id)
		->where('pra_id','=',$praId->pra_id)->count();
		if($praSub==0)
		{
		PraSubscribe::create([
					'request_msg'		=>	'By default subscribe',
					'isApproved'	=>	'1',
					'pra_id'		=>	$praId->pra_id,
					'pa_id'	=>	$this->patient_info->pa_id
				]);
		} */
		/* Supplement Suggestions from practitioner */
		$sup_sug_master = SuggestionsSearch::where('sug_type', '=', 1)
			->where("pa_ids", "LIKE", "%{$this->patient_info->pa_id}%")->get();
			
		$pro_sug_master = SuggestionsSearch::where('sug_type', '=', 3)
			->where("pa_ids", "LIKE", "%{$this->patient_info->pa_id}%")->get();	

		/* Nutrition Suggestions from practitioner */
		$nut_sug_master = SuggestionsSearch::where('sug_type', '=', 2)
			->where("pa_ids", "LIKE", "%{$this->patient_info->pa_id}%")->get();

		$stores =  DB::table('practitioners')
			->leftJoin('pra_subscribe', 'practitioners.pra_id', '=', 'pra_subscribe.pra_id')
			->leftJoin('settings', 'practitioners.user_id', '=', 'settings.user_id')
			->select('practitioners.*','pra_subscribe.isApproved','settings.*')->where('pra_subscribe.isApproved','1')
			->where('pra_subscribe.pa_id',$this->patient_info->pa_id)
			->orderBy('id', 'asc')->limit(3)
			->get();
		$adminBlog = DB::table('adminBlog')
			->leftJoin('users', 'adminBlog.created_by', '=', 'users.user_id')
			->select('adminBlog.*','users.first_name','users.last_name')
			->where('adminBlog.type','1')
			->orderBy('id', 'asc')->paginate(10);
		return view('patient.index.index')->with('sup_sug_master', $sup_sug_master)
			->with('pro_sug_master', $pro_sug_master)
			->with('nut_sug_master', $nut_sug_master)->with('store',$stores)->with('adminBlog',$adminBlog)
			->with('PDashboard','active')
			;
	}
	
	public function productsSuggestionDetails($id)
	{
		$sup_sug_master = SuggestionsSearch::where('id', $id)->first();
		// $supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image','long_description')
			// ->whereIn('sup_id', json_decode($sup_sug_master->sup_ids))->get();
			
		$products = DB::table('products')
		->leftJoin('Practitioner_product', 'Practitioner_product.product_id', '=', 'products.products_id')
            ->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')
			->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.supplier_id')
			->leftJoin('practitioners', 'Practitioner_product.store_id', '=', 'practitioners.pra_id')
			->leftJoin('settings', 'practitioners.user_id', '=', 'settings.user_id')
            ->select('products.*','categories.*','Practitioner_product.*','suppliers.first_name','suppliers.last_name','settings.value')
			->whereIn('products_id', json_decode($sup_sug_master->products_id))->get();
		
		return view('patient.index.pro-sug-details')->with('sup_sug_master', $sup_sug_master)
			->with('products', $products);
	}

	public function supplementSuggestionDetails($id)
	{
		$sup_sug_master = SuggestionsSearch::where('id', $id)->first();
		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image','long_description')
			->whereIn('sup_id', json_decode($sup_sug_master->sup_ids))->get();
		
		return view('patient.index.sup-sug-details')->with('sup_sug_master', $sup_sug_master)
			->with('supplements', $supplements);
	}

	public function nutritionSuggestionDetails($id)
	{
		$nut_sug_master = SuggestionsSearch::where('id', $id)->first();
		$nutrition = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
			->whereIn('nut_id', json_decode($nut_sug_master->nut_ids))->get();

		return view('patient.index.nut-sug-details')->with('nut_sug_master', $nut_sug_master)
			->with('nutrition', $nutrition);
	}

	public function createSupplementRequest()
	{
		$practitioners = DB::table('practitioners as p')
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('p.pra_id', 'u.first_name', 'u.last_name')
			->where('u.role', '=', 3)
			->get();
		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')->get();

		return view('patient.index.supplement-request')
			->with('practitioners', $practitioners)
			->with('supplements', $supplements);
	}

	public function saveSupplementRequest(Request $request)
	{
		if(isset($request->sup_id)){
			if($request->method('post')){
				$sup_request = SupplementRequest::create([
					'pa_id'		=>	$this->patient_info->pa_id,
					'pra_id'	=>	$request->pra_id,
					'title'		=>	$request->title,
					'message'	=>	$request->message,
					'status' => '0'
				]);

				if(isset($request->sup_id) && (count($request->sup_id)>0)){
					foreach ($request->sup_id as $id) {
						SupplementRequestDetail::create([
							'sr_id' 	=>	$sup_request['sr_id'],
							'sup_id'	=>	$id,
							'status' => '0'
						]);
					}
				}

				Session::put('success', 'Request send successfully!');
			}

			return Redirect::Back();
		}else{
			Session::put('error','Please select one supplement');
			return redirect::back();
		}

	}
	public function supplementRequestList(){
		$request = SupplementRequest::where('pa_id',$this->patient_info->pa_id)->orderBy('sr_id', 'desc')->get();
		return view('patient.index.supplement-requests-list')->with('request', $request);
	}
	public function createNutritionRequest()
	{
		$practitioners = DB::table('practitioners as p')
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('p.pra_id', 'u.first_name', 'u.last_name')
			->where('u.role', '=', 3)
			->get();
		$nutrition = Nutrition::select('nut_id', 'name', 'usability', 'main_image')->get();

		return view('patient.index.nutrition-request')
			->with('practitioners', $practitioners)
			->with('nutrition', $nutrition);
	}
	public function supplementRequestDetails($id){
		$sup_requests = DB::table("supplement_requests AS sr")
			->join("practitioners AS p", "p.pra_id", "=", "sr.pra_id")
			->select('p.*', 'sr.*')->where('sr.sr_id',$id)
			->get();
		$sup_details = DB::table("supplement_request_details AS srd")
			->join("supplements AS s", "s.sup_id", "=", "srd.sup_id")
			->select('s.*', 'srd.*')->where('srd.sr_id',$id)
			->get();
		$supplement = SupplementRequest::find($id);
		return view('patient.index.supplement-request-details')->with('hide_sidebar', 'no-sidebar')
			->with('sup_requests', $sup_requests)
			->with('sup_details', $sup_details)
			->with('supplement', $supplement);
	}
	public function nutritionRequestDetails($id){
		$sup_requests = DB::table("nutrition_requests AS nr")
			->join("practitioners AS p", "p.pra_id", "=", "nr.pra_id")
			->select('p.*', 'nr.*')->where('nr.nr_id',$id)
			->get();
		$sup_details = DB::table("nutrition_request_details AS nrd")
			->join("nutritions AS n", "n.nut_id", "=", "nrd.nut_id")
			->select('n.*', 'nrd.*')->where('nrd.nr_id',$id)
			->get();
		$nutrition = NutritionRequest::find($id);
		return view('patient.index.nutrition-request-details')->with('hide_sidebar', 'no-sidebar')
			->with('sup_requests', $sup_requests)
			->with('sup_details', $sup_details)
			->with('nutrition', $nutrition);
	}
	public function exerciseRequestDetails($id){
		$sup_requests = DB::table("exercise_requests AS nr")
			->join("practitioners AS p", "p.pra_id", "=", "nr.pra_id")
			->select('p.*', 'nr.*')->where('nr.er_id',$id)
			->get();
		$sup_details = DB::table("exercise_request_details AS nrd")
			->join("exercises AS n", "n.exe_id", "=", "nrd.exe_id")
			->select('n.*', 'nrd.*')->where('nrd.er_id',$id)
			->get();
		$exercise = ExerciseRequest::find($id);
		return view('patient.index.exercise-request-details')->with('hide_sidebar', 'no-sidebar')
			->with('sup_requests', $sup_requests)
			->with('sup_details', $sup_details)
			->with('exercise', $exercise);
	}

	public function saveNutritionRequest(Request $request)
	{
		if(isset($request->nut_id)){
			if($request->method('post')){
				$sup_request = NutritionRequest::create([
					'pa_id'		=>	$this->patient_info->pa_id,
					'pra_id'	=>	$request->pra_id,
					'title'		=>	$request->title,
					'message'	=>	$request->message,
					'status' => '0'
				]);

				if(isset($request->nut_id) && (count($request->nut_id)>0)){
					foreach ($request->nut_id as $id) {
						NutritionRequestDetail::create([
							'nr_id' 	=>	$sup_request['nr_id'],
							'nut_id'	=>	$id,
							'status' => '0'
						]);
					}
				}

				Session::put('success', 'Request sent successfully!');
			}

			return Redirect::Back();
		}else{
			Session::put('error', 'Please select atleast one nutrition');
			return Redirect::Back();
		}

	}
	public function nutritionRequestList(){
		$request = NutritionRequest::where('pa_id',$this->patient_info->pa_id)->orderBy('nr_id', 'desc')->get();
		return view('patient.index.nutrition-requests-list')->with('request', $request);
	}
	public function createExerciseRequest()
	{
		$practitioners = DB::table('practitioners as p')
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('p.pra_id', 'u.first_name', 'u.last_name')
			->where('u.role', '=', 3)
			->get();
		$exercise = Exercises::select('exe_id', 'heading', 'description', 'image1')->get();

		return view('patient.index.exercise-request')
			->with('practitioners', $practitioners)
			->with('exercise', $exercise);
	}

	public function saveExerciseRequest(Request $request)
	{
		if(isset($request->exe_id)){
			if($request->method('post')){
				$sup_request = ExerciseRequest::create([
					'pa_id'		=>	$this->patient_info->pa_id,
					'pra_id'	=>	$request->pra_id,
					'title'		=>	$request->title,
					'message'	=>	$request->message,
					'status' => '0'
				]);

				if(isset($request->exe_id) && (count($request->exe_id)>0)){
					foreach ($request->exe_id as $id) {
						ExerciseRequestDetail::create([
							'er_id' 	=>	$sup_request['er_id'],
							'exe_id'	=>	$id,
							'status' => '0'
						]);
					}
				}

				Session::put('success', 'Request sent successfully!');
			}

			return Redirect::Back();
		}else{
			Session::put('error', 'Please select atleast one exercise');
			return Redirect::Back();
		}

	}
	public function exerciseRequestList(){
		$request = ExerciseRequest::where('pa_id',$this->patient_info->pa_id)->orderBy('er_id', 'desc')->get();
		return view('patient.index.exercise-requests-list')->with('request', $request);
	}
	public function suggestionDetails()
	{
		$supplements = Supplement::select('sup_id', 'name', 'main_image')->get();
		return view('patient.index.suggestion-details')->with('supplements', $supplements);
	}

	public function changePassword()
	{
		return view('patient.index.change-password');
	}
	public function requestSchedule(Request $request)
    {
        $scheduler = new scheduler();
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $scheduler->patient_id = $patient->first_name . ' ' . $patient->middle_name.' '.$patient->last_name;
        $scheduler->reason = $request->pDesc;
        $scheduler->pDate = $request->pDate;
        $scheduler->pTime = $request->pTime;
        $scheduler->pDuration = $request->pDuration;
        $scheduler->pstatus = $request->ptype;
        $scheduler->app_desc = $request->pDesc;
        $scheduler->practitioner_id = $request->practitioner_id;
        $scheduler->save();
    }
    public function Fetchschedule(Request $request)
    {
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $scheduler = DB::table('scheduler')
            ->where('practitioner_id', '=', $request->practitionerId)
            ->where('pDate', '<=', $request->reqDate)
            ->where('patient_id','=',$patient->first_name . ' ' . $patient->middle_name.' '.$patient->last_name)
            //->where ('pStatus','<>','13')
            ->get();

        foreach ($scheduler as $schedule)
        {
            echo $schedule->id .' ) '.$schedule->patient_id;
            echo ';';
            echo $schedule->pDate;
            echo ';';
            echo $schedule->pTime;
            echo ';';
            echo $schedule->pDuration;
            echo ';';
            echo $schedule->pColor;
            echo '|';
        }
    }
	public function saveNewPassword(ChangePassFormRequest $request)
	{
		$user = User::find(Auth::user()->user_id);
		$user->password = bcrypt($request['new_password']);
		$user->save();

		Session::put('success', 'Your password has been changed successfully!');
		return Redirect::Back();
	}
    public function appointmentHistory()
    {
        $schedulerTable = scheduler::select('*')->orderBy('pDate', 'asc')->get();
        //$user = User::find(Auth::user()->user_id);
        return view('patient.index.appointmentHistory')->with('schedulerTable', $schedulerTable)
            ->with('meta', array('page_title'=>'Appointment History',isset($schedulerTable)?count($schedulerTable):0));

    }
    public function getAppointment()
    {
        return view('patient.index.getAppointment');
    }
    public function getNotification(Request $request)
    {

        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $scheduler = DB::table('scheduler')
            ->where('pDate', '>=',  date('m/d/Y'))
            ->where('patient_id','=',$patient->first_name . ' ' . $patient->middle_name.' '.$patient->last_name)
            ->where('notify_cancel','=',0)
            ->where ('pStatus','<>','13')
            ->get();
        $notificationDivClose = '</div>';
        foreach ($scheduler as $schedule)
        {
            //Main Div
            echo '<div class="alert alert-success fade in m-b-15" id="notify_'.$schedule->id.'">';
            //Child Divs
            echo '<strong>'.$schedule->pDate.'</strong>';
            echo '. Your Upcomming Appointment. Duration Will be <strong>'.$schedule->pDuration. ' </strong> minutes . Please be there on Time. Thankyou';
            echo '<a href="#">';
            echo '<span id="cancel_'.$schedule->id.'" onclick="hide('.$schedule->id.');" class="close" data-dismiss="alert">×</span>';
            echo '</a>';
            echo $notificationDivClose;
        }
    }
    public function hideNotification(Request $request)
    {
        $myId =  $request->scheduleId;
        $update = scheduler::find($myId);
        $update->notify_cancel = 1;
        $update->save();
    }
    public function MessageHistory()
    {
		$practitioners = Practitioner::select('pra_id', 'first_name', 'last_name','directory AS pra_directory','photo AS pra_photo')
		->where('first_name','<>','""')
		->where('plan_type','=','2')
		->get();
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();
        $msg_from = $patient->pa_id;
		$messageHistory = DB::select('SELECT message_history_counter.message_unseen_counter ,MH.*,pra.first_name,pra.last_name,pra.photo AS pa_photo,pra.directory AS pa_directory
,message_history_created.message_history_created_at
FROM message_header AS MH
LEFT JOIN practitioners AS pra ON pra.pra_id = MH.practitioner_id
LEFT JOIN (SELECT MAX(created_at) AS message_history_created_at ,msg_id AS message_history_id FROM message_history 
GROUP BY msg_id) AS message_history_created
ON message_history_created.message_history_id = MH.id
LEFT JOIN (SELECT COUNT(*) AS message_unseen_counter ,msg_id AS message_counter_id 
FROM message_history WHERE message_history.is_seen = 0 AND sent_by LIKE \'%pra_%\'
GROUP BY msg_id) AS message_history_counter 
ON message_history_counter.message_counter_id = MH.id
WHERE MH.patient_id = '.$msg_from.' AND MH.patient_login_id ='. Auth::USER()->user_id.'
ORDER BY message_history_created_at DESC
');
        return view('patient.index.pa-message-history')->with('meta', array('page_title'=>'Chat with Practitioner'))->with('messageHistory',$messageHistory)->with('practitioners',$practitioners)
		->with('message_menu','active')->with('message_his_menu','active');
    }
    public function DynamicMessages(Request $request)
    {
        $id = $request->pra_id;
        $chatRestrict = isset($request->chatRestrict) ? $request->chatRestrict : '';
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();
        $msg_from = $patient->pa_id;
        $msg_id = message_header::select('*')->where('practitioner_id','=',$id)->where('patient_id','=',$msg_from)->first();
        if(!isset($msg_id)) return '';
        if($chatRestrict=="today") {
            $date = date("Y-m-d");
            $msg_history = message_history::select('*')->where('msg_id', '=', $msg_id->id)
                ->where('created_at','LIKE','%'.$date.'%')
                ->get();
        }
        else {
			$where = '';
			if(isset($request->msg_lastID)) {
				$sign = '<';
				if($request->cNew=='true') {
					$sign = '>';
				}
				$where = $request->msg_lastID!='' ? 'WHERE msg_his_id '.$sign.' '.$request->msg_lastID . ' AND msg_id = '.$msg_id->id : '';
			}
			if($where==''){
				$where = 'WHERE msg_id = '.$msg_id->id;
			}
			$msg_history = DB::select("
			SELECT * FROM (SELECT * FROM message_history $where ORDER BY msg_his_id DESC LIMIT 10) AS t WHERE t.msg_id = $msg_id->id ORDER BY msg_his_id ASC
			");
			DB::UPDATE("UPDATE message_history set is_seen = 1 , is_notified = 1 where msg_id = $msg_id->id AND is_seen = 0 AND sent_by LIKE '%pra_%' ");		 
			if($request->cNew=='true') {
				$msg_history = DB::select("
			SELECT * FROM message_history AS t $where AND t.msg_id = $msg_id->id ORDER BY msg_his_id ASC
			");	
			}
        }
        if(!isset($msg_history)) return '';
        $appender = '';
        $liClass= '';
        foreach ($msg_history as $msgs)
        {
            $picPath = asset('public/img/no-user.jpg');

            $pra_det = Practitioner::where('pra_id', '=', $msg_id->practitioner_id)->first();;
            if(isset($pra_det->photo) && (!empty($pra_det->photo)))
            {$directory = $pra_det->directory;
                if($directory!="") $directory = $directory .'/';
                $picPath = asset('public/practitioners/'.$directory.$pra_det->photo);
                //$picPath = public_path().'\\practitioners\\peter222220\\'.$directory.$patient->photo;
            }
            $liClass = strpos($msgs->sent_by, 'pa') !== false ? 'right' : 'left';
            if($liClass=='left') {
                $appender .= '<li data-id="'.$msgs->msg_his_id.'" class="' . $liClass . '">';
                $formatteddate = date("m/d/Y", strtotime($msgs->created_at));
                $appender .= '<span class="date-time">' .$formatteddate .' '. date("H:i", strtotime($msgs->created_at)) . '</span>';
                $appender .= '<a href="#" class="name">'.$pra_det->first_name . ' '. $pra_det->last_name .'</a>';
                $appender .= '<a href="javascript:;" class="image"><img alt="" src="'.$picPath.'"></a>';
                $appender .= '<div style="word-wrap: break-word;" class="message">';
                $appender .= $msgs->message;
                $appender .= '</div>';
                $appender .= '</li>';
            }
            if($liClass=='right')
            {
                $directory= '';
                $pra_det = Practitioner::where('pra_id', '=', $msg_id->practitioner_id)->first();;
                if(isset($patient->photo) && (!empty($patient->photo)))
                {$directory = $pra_det->directory;
                    if($directory!="") $directory = $directory .'/';
                    $picPath = asset('public/practitioners/profilepicture/'.$patient->photo);
                    //$picPath = public_path().'\\practitioners\\peter222220\\'.$directory.$patient->photo;
                    }
                                    else {$picPath = asset('public/img/no-user.jpg');}
                $appender.='<li data-id="'.$msgs->msg_his_id.'" class="right">';
                $formatteddate = date("m/d/Y", strtotime($msgs->created_at));
                $appender .= '<span class="date-time">' .$formatteddate .' '. date("H:i", strtotime($msgs->created_at)) . '</span>';
            $appender.='<a href="#" class="name"><span class="label label-primary">Me</span> Me</a>';
            $appender.='<a href="javascript:;" class="image"><img alt="" src="'.$picPath.'"></a>';
            $appender.='<div style="word-wrap: break-word;" class="message">';
                $appender .= $msgs->message;
            $appender.='</div>';
            $appender.='</li>';
            }
        }
        echo $appender;
    }
    public function getMessageSerial($msg_id)
    {
        $returnn=1;
        //$msg_header = message_history::where('msg_id', '=',$msg_id)->first();;
        $msg_header = DB::table('message_history')->where('msg_id', '=',$msg_id)->max('serial');
        $returnn = $msg_header;
        return $returnn+1;
    }
    public function viewMessage()
    {
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $msg_from = $patient->pa_id;
        $messageHistory = DB::table("message_header AS MH")
            ->join("practitioners AS pra", "pra.pra_id", "=", "MH.practitioner_id")
            ->select('MH.*','pra.first_name','pra.last_name')
            ->where('MH.patient_id','=',$msg_from)
            ->where('MH.patient_login_id','=',Auth::user()->user_id)
            ->get();
        $practitioners = Practitioner::select('pra_id', 'first_name', 'last_name')
		->where('first_name','<>','""')
		->get();
        return view('patient.index.pa-message')->with('practitioners', $practitioners)->with('messageHistory',$messageHistory)->with('message_menu','active')->with('message_new_menu','active');
    }
	public function MessageNotification()
	{
		$patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $msg_from = $patient->pa_id;
		$counter = DB::select("SELECT msg_id
		,pra.first_name , pra.last_name 
		FROM message_history 
		LEFT JOIN message_header AS MHM 
		ON MHM.id = message_history.msg_id
		LEFT JOIN practitioners AS pra ON pra.pra_id = MHM.practitioner_id
		WHERE msg_id IN (SELECT MH.id
		FROM message_header AS MH
		LEFT JOIN (SELECT MAX(created_at) AS message_history_created_at ,msg_id AS message_history_id FROM message_history 
		GROUP BY msg_id) AS message_history_created
		ON message_history_created.message_history_id = MH.id
		WHERE MH.patient_id = ".$msg_from." AND MH.patient_login_id = ".Auth::user()->user_id."
		ORDER BY message_history_created_at DESC)
		AND sent_by LIKE '%pra_%'
		AND is_seen = 0 AND is_notified = 0 ".
		/*AND created_at BETWEEN '".date('Y-m-d H:i:s', strtotime('-5 minutes'))."' AND '".date('Y-m-d H:i:s',time())."'*/
		"GROUP BY message_history.msg_id ORDER BY message_history.created_at DESC ");
		
		$ordersCounter = 0;
		$notificationString = '';
		$id = '';
		foreach($counter as $counterLoop){
			if($ordersCounter==0){
				$notificationString .= $counterLoop->first_name . ' ' . $counterLoop->last_name;
			}
			$ordersCounter++;
			$id .= $counterLoop->msg_id . ',';
		}
		if($ordersCounter==1){
			$notificationString .= ' have messaged you.';
			
		}else{
			if($ordersCounter>1){
				$ordersCounter--;
				$notificationString .= ' And ' . $ordersCounter . ' others have messaged you ';
			} 
		}
		$id = rtrim($id,',');
		if($id!=''){
			DB::UPDATE("UPDATE message_history set is_notified = 1 WHERE msg_id IN(".$id.") AND sent_by LIKE '%pra_%'");
		}
		$messageHistory = DB::select("SELECT MH.*,pra.first_name,pra.last_name,pra.photo AS pa_photo,pra.directory AS pa_directory
		,message_history_created.message_history_created_at,message_history_counter.message_unseen_counter
		FROM message_header AS MH
		LEFT JOIN practitioners AS pra ON pra.pra_id = MH.practitioner_id
		LEFT JOIN (SELECT MAX(created_at) AS message_history_created_at ,msg_id AS message_history_id FROM message_history 
		GROUP BY msg_id) AS message_history_created
		ON message_history_created.message_history_id = MH.id
		LEFT JOIN (SELECT COUNT(*) AS message_unseen_counter ,msg_id AS message_counter_id 
		FROM message_history WHERE message_history.is_seen = 0		
		GROUP BY msg_id) AS message_history_counter 
		ON message_history_counter.message_counter_id = MH.id
		WHERE MH.patient_id = ".$msg_from." AND MH.patient_login_id =". Auth::USER()->user_id."
		 AND message_history_created_at > '".$_GET['datee']."' ORDER BY message_history_created_at DESC
		");
		$notificationString .= '|'.json_encode($messageHistory);
		echo $notificationString;
	}
    public function sendMessage(Request $request)
    {
        try {
            $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
            $patient_id = $patient->pa_id;
            $patient_login_id = $patient->user_id;
            $practitioner = Practitioner::where('pra_id', '=', $request->pra_id)->first();;
            $practitioner_id = $practitioner->pra_id;
            $practitioner_login_id = $practitioner->user_id;
            $msg_date = $request->msg_date;
            $msg_header = new message_header();
            $msg_header->practitioner_id = $practitioner_id;
            $msg_header->practitioner_login_id = $practitioner_login_id;
            $msg_header->patient_id = $patient_id;
            $msg_header->patient_login_id = $patient_login_id;
            $msg_header->msg_date = $msg_date;
            $headerExist = $this->ifExist($practitioner_id,$practitioner_login_id,$patient_id,$patient_login_id);
            $msg_id = '';
            if($headerExist=="")
            {$msg_header->save();
                $msg_id = $msg_header->id;
            }
            else
            {
                $msg_id = $headerExist;
            }
        }
        catch(Exception $ex)
        {
            return 'Some error occured';
        }
        try {
            $this->saveMessage($msg_id, $request->message,'pa_'.$patient_id,$this->getMessageSerial($msg_id));
        }
        catch (Exception $exx)
        {
            return 'Some error occured';
        }
        return 'Message Sent Successfully';
    }
    public function saveMessage($msg_id,$message,$sent_by='',$serial=1)
    {
        $message_history = new message_history();
        $message_history->msg_id = $msg_id;
        $message_history->message = $message;
        $message_history->sent_by = $sent_by;
        $message_history->serial = $serial;
        $message_history->save();
    }
    public function ifExist($practitioner_id,$practitioner_login_id,$patient_id,$patient_login_id)
    {
        if (message_header::where([
            ['patient_id', '=', $patient_id],
            ['patient_login_id', '=', $patient_login_id],
            ['practitioner_id', '=', $practitioner_id],
            ['practitioner_login_id', '=', $practitioner_login_id]
            ,])->exists()) {
            $msg_id = message_header::where('patient_id', '=', $patient_id)
                ->where('patient_login_id', '=', $patient_login_id)
                ->where('practitioner_id', '=', $practitioner_id)
                ->where('practitioner_login_id', '=', $practitioner_login_id)
                ->first();;

            return  $msg_id->id;
        }
        else
        {
            return '';
        }
    }

	public function shipping($type){
		$active_class = $type == '1' ? 'contact_info' : 'shipping_add';
		if($type == '1'||$type == '2'){
		return view('patient.index.shipping')->with('setting_menu','active')->with( $active_class ,'active')->with('type',$type);
		}
		else{
				return Redirect::Back();
		}
	}

	public function shipping_save(Request $request){
		if(isset($_POST['type']) && $_POST['type']=='delete'){
			$id = isset($_POST['id']) ? $_POST['id'] : '';
			if($id!=''){
				$table1 = Shipping::find($id);
				if(isset($table1)){
					$table1->delete();
					echo 'success';
					return;
				}else{
					echo 'Some Error Occured';
					return;
				}
			}
			else{
				echo 'Some Error Occured';
				return;
			}
		}
		if(isset($request->s_id)){
	$table = Shipping::find($request->s_id);
		}
		else{
			$table = new Shipping();
		}
		
		$table->first_name = $request->first_name;
		$table->last_name = $request->last_name;
		$table->Address = $request->Address;
		$table->zip_code = $request->zip_code;
		$table->Phone = $request->Phone;
		$table->type = $request->type;
		$table->pa_id = Auth::user()->user_id;
        $table->save();
		$msg = $request->type=='2' ? 'Contact Info' : 'Shipping Address';
		if(isset($request->s_id)){
			Session::put('success', $msg.' has been updated successfully!');
			 return Redirect::to('/patient/index/shipping-add-list/'.$request->type);
		}
		else{
			Session::put('success', $msg.' has been saved successfully!');
		return Redirect::Back();
		}

	}
	
	public function shipping_edit($id,$type){
			
		//dd($id,$type);
		
		$active_class = $type == '1' ? 'contact_info' : 'shipping_add';
		$shipping_list = DB::table('shipping_address')->where('s_id','=' , $id )->where('pa_id', '=' , Auth::user()->user_id )->first();
		return view('patient.index.shipping_edit')->with('type' , $type )->with('shipping_list', $shipping_list)->with('setting_menu','active')->with($active_class,'active');
		
	}
	
	
	public function shipping_list($type){
			
		if($type == '1' || $type == '2'){
		$shipping_list = DB::table('shipping_address')->where('pa_id','=' , Auth::user()->user_id)->where('type', '=' , $type )->get();
		if($type == '1'){
			return view('patient.index.shipping_add_list')->with('shipping_list', $shipping_list)->with('setting_menu','active')->with('contact_info','active')->with('type',$type);
		}
		elseif($type == '2')	
					{
			return view('patient.index.shipping_add_list')->with('shipping_list', $shipping_list)->with('setting_menu','active')->with('shipping_add','active')->with('type',$type);
		}
		}
		else
		{
			return Redirect::Back();
		}
	}
	
	public function adminBlog($id){
		//$meta['page_title'] = 'Admin Blog Post';
		//$adminBlog = DB::select('SELECT adminBlog.*,users.first_name,users.last_name FROM adminBlog LEFT JOIN users on users.user_id = adminBlog.created_by where type = 1 AND id = '.$id);
		//return view('patient.index.adminBlog')->with('adminBlog',$adminBlog)->with('meta',$meta);;
		return Redirect::Back();
		
	}
	
	public function suggestionsaction()
	{

		
	$pro_sugest_master = DB::select('select practitioners.first_name,practitioners.last_name,pro_sugest_master.* FROM pro_sugest_master 
LEFT JOIN practitioners ON 
pro_sugest_master.pra_id = practitioners.pra_id
WHERE pro_sugest_master.id IN(
SELECT DISTINCT pro_sugest_details.master_id FROM pro_sugest_details WHERE pro_sugest_details.pa_id = '.$this->patient_info->pa_id.'
) Order by pro_sugest_master.created_at desc');
		
	$pa_message_inbox = DB::select('SELECT 
	(SELECT MAX(created_at) FROM message_history WHERE message_history.msg_id = message_header.id) AS lastMessageDate,
IFNULL(practitioners.first_name,users.first_name) AS first_name 
, IFNULL(practitioners.last_name,users.last_name) AS last_name ,message_header.* FROM message_header
LEFT JOIN practitioners ON practitioners.pra_id = message_header.practitioner_id
AND practitioners.user_id = message_header.practitioner_login_id
LEFT JOIN users AS users ON users.user_id = message_header.practitioner_login_id
WHERE message_header.patient_id = '.$this->patient_info->pa_id.'
AND message_header.patient_login_id = '.$this->patient_info->user_id);

		return view('patient.message.pat-message-history')->with('pro_sugest_master' , $pro_sugest_master)->with('message_menu','active')->with('pa_message_inbox' , $pa_message_inbox);
	}
	public function recommendationaction()
	{
		$pro_sugest_master = DB::select('select practitioners.first_name,practitioners.last_name,pro_sugest_master.* FROM pro_sugest_master 
		LEFT JOIN practitioners ON 
		pro_sugest_master.pra_id = practitioners.pra_id
		WHERE pro_sugest_master.id IN(
		SELECT DISTINCT pro_sugest_details.master_id FROM pro_sugest_details WHERE pro_sugest_details.pa_id = '.$this->patient_info->pa_id.'
		) Order by pro_sugest_master.created_at desc');
		return view('patient.message.pat-message-history')->with('pro_sugest_master' , $pro_sugest_master)->with('rec_menu','active');
	}
	
	public function RecommendDetail($id){
		$master = proSuggestionsMaster::where('id', '=', $id)
                ->first();
		//$practitionerDetail = DB::select('SELECT * from practitioners where pa_id');
		$productDetail = DB::select('SELECT * FROM products WHERE products_id IN(SELECT products_id FROM pro_sugest_details WHERE master_id = '.$id.')');
		return view('patient.index.suggestion-product-detail')->with('master' , $master)->with('productDetail',$productDetail)->with('rec_menu','active');
	}
	
	



	
	public function credit_card(){
		return view('patient.orders.credit_card_info')->with('setting_menu','active')->with( 'credit_card_info' ,'active');
	} 

	
	public function credit_card_save(Request $request){
		if(isset($_POST['type']) && $_POST['type']=='delete'){
			$id = isset($_POST['id']) ? $_POST['id'] : '';
			if($id!=''){
				$table1 = CreditCardInfo::find($id);
				if(isset($table1)){
					$table1->delete();
					echo 'success';
					return;
				}else{
					echo 'Some Error Occured';
					return;
				}
			}
			else{
				echo 'Some Error Occured';
				return;
			}
		}
		if(isset($request->credit_id)){
	$table = CreditCardInfo::find($request->credit_id);
		}
		else{
			$table = new CreditCardInfo(); 
		}
		$table->cardholder_name = $request->card_customer_name;
		$table->card_number = $request->card_number;
		$table->payment_types = $request->card_type;
		$table->expiration_date_mm = $request->card_exp_month;
		$table->expiration_date_yy = $request->card_exp_year;
		$table->cvv = $request->card_cvc;
		$table->address = $request->bill_add;
		$table->user_id = Auth::user()->user_id;
		$table->zip_code = $request->zip_code;
        $table->save();
		
		if(isset($request->credit_id)){
			Session::put('success data has been updated successfully!');
			 return Redirect::to('/patient/index/credit-card-list');
		}
		else{
			Session::put('success data has been saved successfully!');
		return Redirect::Back();
		}

	}
	
	public function credit_card_edit($id){
			
		//dd($id,$type);
		
		$shipping_list = DB::table('credit_card_info')->where('credit_id','=' , $id )->where('user_id', '=' , Auth::user()->user_id )->first();
		return view('patient.orders.credit_card_edit')->with('shipping_list', $shipping_list)->with('setting_menu','active')->with( 'credit_card_info' ,'active');
		
	}
	
	
	public function credit_card_list(){
		$credit_list = DB::table('credit_card_info')->where('user_id','=' , Auth::user()->user_id)->get();
		//dd($credit_list);
			return view('patient.orders.credit_card_list')->with('credit_card_info', 'active')->with('shipping_list', $credit_list)->with('setting_menu','active');
			return Redirect::Back();
	}
	
	
	 public function credit_card_info(){
		 
		 return view('patient.orders.credit_card_info')->with('setting_menu','active')->with('credit_card_info','active');
	 }
	
	
	
	
	
	
	
	
	
	
	
	
	
}
