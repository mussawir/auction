<?php

namespace App\Http\Controllers\Practitioner;
use App\Models;
use App\Models\message_header;
use App\Models\message_history;
use App\Models\Patient;
use App\Models\Practitioner;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Dompdf\Exception;

class MessageController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        Session::set('marketing', 'active');
        Session::pull('management');
        Session::pull('dashboard');
    }
	public function MessageDashboard()
	{
		$pa_message_inbox = DB::select('SELECT 
	(SELECT MAX(created_at) FROM message_history WHERE message_history.msg_id = message_header.id) AS lastMessageDate,
IFNULL(practitioners.first_name,users.first_name) AS first_name 
, IFNULL(practitioners.last_name,users.last_name) AS last_name ,message_header.* FROM message_header
LEFT JOIN patient ON patient.pa_id = message_header.patient_id
AND patient.user_id = message_header.patient_login_id
LEFT JOIN users AS users ON users.user_id = message_header.patient_login_id
WHERE message_header.practitioner_id = '.$this->practitioner_info->pra_id.'
AND message_header.practitioner_login_id = '.$this->practitioner_info->user_id);
		return view('practitioner.message.pa-message-dashboard')
            ->with('meta', array('page_title'=>'Message Dashboard'))
            ->with('message','active')
			->with('pa_message_inbox',$pa_message_inbox)
            ;
	}
    public function index()
    {
        $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();;
        $msg_from = $practitioner->pra_id;
        $patient = Patient::select('pa_id', 'first_name', 'last_name')
		->where('first_name','<>','""')
		->get();
        $messageHistory = message_header::select('*')->where('practitioner_id','=',$msg_from)
            ->where('practitioner_login_id','=',Auth::user()->user_id)
            ->get();
        $messageHistory = DB::table("message_header AS MH")
            ->join("patients AS pra", "pra.pa_id", "=", "MH.patient_id")
            ->select('MH.*','pra.first_name','pra.last_name')
            ->where('MH.practitioner_id','=',$msg_from)
            ->where('MH.practitioner_login_id','=',Auth::user()->user_id)
            ->get();
        return view('practitioner.message.pa-message')->with('patient', $patient)->with('messageHistory',$messageHistory)
            ->with('meta', array('page_title'=>'Message'))
            ->with('message','active')
            ->with('send_message','active')
            ;
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
	public function MessageNotification()
	{
		$patient = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();;
        $msg_from = $patient->pra_id;
		$counter = DB::select("SELECT msg_id
		,pra.first_name , pra.last_name 
		FROM message_history 
		LEFT JOIN message_header AS MHM 
		ON MHM.id = message_history.msg_id
		LEFT JOIN patients AS pra ON pra.pa_id = MHM.patient_id
		WHERE msg_id IN (SELECT MH.id
		FROM message_header AS MH
		LEFT JOIN (SELECT MAX(created_at) AS message_history_created_at ,msg_id AS message_history_id FROM message_history 
		GROUP BY msg_id) AS message_history_created
		ON message_history_created.message_history_id = MH.id
		WHERE MH.practitioner_id = ".$msg_from." AND MH.practitioner_login_id = ".Auth::user()->user_id."
		ORDER BY message_history_created_at DESC)
		AND sent_by LIKE '%pa_%'
		AND is_seen = 0 AND is_notified = 0 ".
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
			DB::UPDATE("UPDATE message_history set is_notified = 1 WHERE msg_id IN(".$id.") AND sent_by LIKE '%pa_%'");
		}
		$messageHistory = DB::select("SELECT MH.*,pra.first_name,pra.last_name,pra.photo AS pa_photo,pra.directory AS pa_directory
		,message_history_created.message_history_created_at,message_history_counter.message_unseen_counter
		FROM message_header AS MH
		LEFT JOIN patients AS pra ON pra.pa_id = MH.patient_id
		LEFT JOIN (SELECT MAX(created_at) AS message_history_created_at ,msg_id AS message_history_id FROM message_history 
		GROUP BY msg_id) AS message_history_created
		ON message_history_created.message_history_id = MH.id
		LEFT JOIN (SELECT COUNT(*) AS message_unseen_counter ,msg_id AS message_counter_id 
		FROM message_history WHERE message_history.is_seen = 0		
		GROUP BY msg_id) AS message_history_counter 
		ON message_history_counter.message_counter_id = MH.id
		WHERE MH.practitioner_id = ".$msg_from." AND MH.practitioner_login_id =". Auth::USER()->user_id."
		 AND message_history_created_at > '".$_GET['datee']."' ORDER BY message_history_created_at DESC
		");
		$notificationString .= '|'.json_encode($messageHistory);
		echo $notificationString;
	}
    public function DynamicMessages(Request $request)
    {
        $id = $request->pa_id;
        $chatRestrict = isset($request->chatRestrict) ? $request->chatRestrict : '';
        $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        $msg_from = $practitioner->pra_id;
        $msg_id = message_header::select('*')->where('patient_id','=',$id)->where('practitioner_id','=',$msg_from)->first();
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
			DB::UPDATE("UPDATE message_history set is_seen = 1 , is_notified = 1 where msg_id = $msg_id->id AND is_seen = 0 AND sent_by LIKE '%pa_%' ");		 
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
            $pa_det = Patient::where('pa_id', '=', $msg_id->patient_id)->first();;
            if(isset($pa_det->photo) && (!empty($pa_det->photo)))
            {
                $directory = $practitioner->directory;
                if($directory!="") $directory = $directory .'/';
                $picPath = asset('public/practitioners/profilepicture/'.$pa_det->photo);
            }
            $pa_det = Patient::where('pa_id', '=', $msg_id->patient_id)->first();;
            $liClass = strpos($msgs->sent_by, 'pra') !== false ? 'right' : 'left';
            if($liClass=='left') {
                $appender .= '<li data-id="'.$msgs->msg_his_id.'" class="' . $liClass . '">';
                $formatteddate = date("m/d/Y", strtotime($msgs->created_at));
                $appender .= '<span class="date-time">' .$formatteddate .' '. date("H:i", strtotime($msgs->created_at)) . '</span>';
                $appender .= '<a href="#" class="name">'.$pa_det->first_name . ' '. $pa_det->last_name .'</a>';
                $appender .= '<a href="javascript:;" class="image"><img alt="" src="'.$picPath.'"></a>';
                $appender .= '<div style="word-wrap: break-word;" class="message">';
                $appender .= $msgs->message;
                $appender .= '</div>';
                $appender .= '</li>';
            }
            if($liClass=='right')
            {
                $directory= '';
                if(isset($practitioner->photo) && (!empty($practitioner->photo)))
                {$directory = $practitioner->directory;
                    if($directory!="") $directory = $directory .'/';
                    $picPath = asset('public/images/practitioners/'.$directory.$practitioner->photo);
                    //$picPath = public_path().'\\practitioners\\peter222220\\'.$directory.$patient->photo;
                }
                else {$picPath = asset('public/img/no-user.jpg');}
                $appender.='<li data-id="'.$msgs->msg_his_id.'" class="right">';
                $formatteddate = date("m/d/Y", strtotime($msgs->created_at));
                $appender .= '<span class="date-time">' .$formatteddate .' '.  date("H:i", strtotime($msgs->created_at)) . '</span>';
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
    public function sendMessage(Request $request)
    {
        try {
            $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();;
            $practitioner_id = $practitioner->pra_id;
            $practitioner_login_id = $practitioner->user_id;
            $patient = Patient::where('pa_id', '=', $request->pa_id)->first();;
            $patient_id = $patient->pa_id;
            $patient_login_id = $patient->user_id;
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
            $this->saveMessage($msg_id, $request->message,'pra_'.$practitioner_id,$this->getMessageSerial($msg_id));
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
    public function getMessageSerial($msg_id)
    {
        $returnn=0;
        //$msg_header = message_history::where('msg_id', '=',$msg_id)->first();;
        $msg_header = DB::table('message_history')->where('msg_id', '=',$msg_id)->max('serial');

        $returnn = $msg_header;
        return $returnn+1;
    }
    public function MessageHistory()
    {   $prac = Session::get('practitioner_session');
        $pra = Practitioner::find($prac['pra_id']);
		$patient = Patient::select('pa_id', 'first_name', 'last_name')
		->where('first_name','<>','""')
		->get();
        $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        $msg_from = $practitioner->pra_id;
        /*$messageHistory = DB::table("message_header AS MH")
            ->join("patients AS pra", "pra.pa_id", "=", "MH.patient_id")
            ->select('MH.*','pra.first_name','pra.last_name','pra.photo as pa_photo','pra.directory as pa_directory')
            ->where('MH.practitioner_id','=',$msg_from)
            ->where('MH.practitioner_login_id','=',Auth::user()->user_id)
            ->get();*/
			$messageHistory = DB::select('SELECT message_history_counter.message_unseen_counter ,MH.*,pra.first_name,pra.last_name,pra.photo AS pa_photo,pra.directory AS pa_directory
,message_history_created.message_history_created_at
FROM message_header AS MH
LEFT JOIN patients AS pra ON pra.pa_id = MH.patient_id
LEFT JOIN (SELECT MAX(created_at) AS message_history_created_at ,msg_id AS message_history_id FROM message_history 
GROUP BY msg_id) AS message_history_created
ON message_history_created.message_history_id = MH.id
LEFT JOIN (SELECT COUNT(*) AS message_unseen_counter ,msg_id AS message_counter_id 
FROM message_history WHERE message_history.is_seen = 0		
GROUP BY msg_id) AS message_history_counter 
ON message_history_counter.message_counter_id = MH.id
WHERE MH.practitioner_id = '.$msg_from.' AND MH.practitioner_login_id ='. Auth::USER()->user_id.'
ORDER BY message_history_created_at DESC
');
        return view('practitioner.message.pa-message-history')
		    ->with('practitioner_info',$this->practitioner_info)
		    ->with('messageHistory',$messageHistory)
		    ->with('practitionerDet',$practitioner)->with('patient',$patient)
            ->with('meta', array('page_title'=>'Chat with Patients'))
            ->with('message','active')
			->with('pra',$pra)
            ->with('message_history','active')
            ;
    }
}
