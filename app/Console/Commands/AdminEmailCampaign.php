<?php
 
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactGroup;
use App\Models\AdminInGroup;
use App\Models\EmailSentReciptent;
use App\Models\AdminContacts;
use App\Models\AdminCampaign;
use App\Models\AdminEmail;
use App\Models\EmailGroup;
use App\Models\EmailInGroup;
use App\Models\EmailTemplate;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\PractitionerCampaign;
use App\Models\PractitionerEmail;
use Illuminate\Http\Request;

class AdminEmailCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adminemail:campaign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Campaign will be going to send to the whole group on specific time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /** 
     * Execute the console command.
     *
     * @return mixed
     */
	 /*
	 public function handle(){
		 $campaign = DB::select("SELECT cam_id, 
			campaign_name, 
			STR_TO_DATE(start_date,'%m/%d/%Y') AS start_ddate, 
			STR_TO_DATE(end_date,'%m/%d/%Y') AS end_ddate, 
			start_date,end_date,
			sent_to, 
			group_name, 
			message, 
			admin_campaign.status, 
			user_id, 
			created_at, 
			updated_at FROM admin_campaign 
			WHERE STR_TO_DATE(start_date,'%m/%d/%Y') <= DATE_FORMAT(NOW(),'%Y-%m-%d')
			AND STR_TO_DATE(end_date,'%m/%d/%Y') >= DATE_FORMAT(NOW(),'%Y-%m-%d')");
			DB::update("
			UPDATE admin_campaign set status = 1
			WHERE STR_TO_DATE(start_date,'%m/%d/%Y') <= DATE_FORMAT(NOW(),'%Y-%m-%d')
			AND STR_TO_DATE(end_date,'%m/%d/%Y') >= DATE_FORMAT(NOW(),'%Y-%m-%d')
			");
		if(isset($campaign)){
		foreach($campaign as $items){
			$email = AdminInGroup::select('*')->where('ag_id', $items->sent_to)->get();
			foreach($email as $emailItems){
				$placeholders = array('AD.FirstName', 'AD.LastName', 'AD.Email', 'AD.Phone',
                    'CN.FirstName', 'CN.LastName', 'CN.Email', 'CN.Phone');
				
				$contacts = AdminContacts::select('first_name', 'middle_name', 'last_name', 'email', 'primary_phone')
                    ->where('cnt_id', '=', $emailItems->ag_id)->first();
				
				$replace_with = array('Practice Tab', 'Admin', 'admin@practicetab.com', '',
                    $contacts->first_name, $contacts->last_name, $contacts->email, $contacts->primary_phone);
				
				$mail_body = preg_replace('/\{[^}]*\)|[{}]/', '', $items->message);
				$mail_body = str_replace($placeholders, $replace_with, $mail_body);
				$data = [
					'messagebody'=>  $mail_body,
				];
				$subject = "Practice Tab Campaign From :".$contacts->first_name." ".$contacts->last_name;
				Mail::send(['html' => 'admin.emails.emailbody'], $data, function ($message) use ($emailItems , $subject) {
					$message->from('postmaster@practicetabs.com', 'Practice Tabs');
					$message->to($emailItems->email);
					$message->subject($subject);
					});
				DB::table('email_sent_recipent')->insert(
					array('email_address' => $contacts->email , 'created_by' =>  "1"  , 'first_name' => $contacts->first_name , 'last_name' => $contacts->last_name , 'type' =>  "1" , 'phone_number' => $contacts->primary_phone , 'email_id' => $email_id->ae_id  ));
				}
			}
	}  
				//LOG::info("saad hello");
	}
	*/
	
	Public function handle(){
		 $grp_id = DB::select("SELECT cam_id, 
			campaign_name, 
			STR_TO_DATE(start_date,'%m/%d/%Y') AS start_ddate, 
			STR_TO_DATE(end_date,'%m/%d/%Y') AS end_ddate, 
			start_date,end_date,
			sent_to as ag_id, 
			group_name, 
			message, 
			admin_campaign.status, 
			user_id, 
			created_at, 
			updated_at FROM admin_campaign 
			WHERE STR_TO_DATE(start_date,'%m/%d/%Y') <= DATE_FORMAT(NOW(),'%Y-%m-%d')
			AND STR_TO_DATE(end_date,'%m/%d/%Y') >= DATE_FORMAT(NOW(),'%Y-%m-%d')");
			DB::update("
			UPDATE admin_campaign set status = 1
			WHERE STR_TO_DATE(start_date,'%m/%d/%Y') <= DATE_FORMAT(NOW(),'%Y-%m-%d')
			AND STR_TO_DATE(end_date,'%m/%d/%Y') >= DATE_FORMAT(NOW(),'%Y-%m-%d')
			");
			
			DB::update("
			UPDATE admin_campaign set status = 2
			WHERE STR_TO_DATE(end_date,'%m/%d/%Y') < DATE_FORMAT(NOW(),'%Y-%m-%d')
			");	 
		if(isset($grp_id)){
				
            foreach ($grp_id as $items){
				$email = AdminInGroup::select('*')->where('ag_id', $items->ag_id)->get();
				
			foreach($email as $value)
			{ 
				$email_id = AdminEmail::create([
					'user_id'	=>	"1",
					'sent_to' => $value->ag_id,
					'group_name' => $value->group_name,
					'subject' => "Practice Tab Campaign",
					'message'	=>	$items->message
				]);
				
                $placeholders = array('AD.FirstName', 'AD.LastName', 'AD.Email', 'AD.Phone',
                    'CN.FirstName', 'CN.LastName', 'CN.Email', 'CN.Phone');
                
				$contacts = AdminContacts::select('first_name', 'middle_name', 'last_name', 'email', 'primary_phone')
                    ->where('cnt_id', '=', $value->ag_id)->first();
                $replace_with = array("Practice Tab", "Admin" , "syedsaadiqbal1@gamil.com", "03462816962",
                    $contacts->first_name, $contacts->last_name, $contacts->email, $contacts->primary_phone);
                $mail_body = preg_replace('/\{[^}]*\)|[{}]/', '', $items->message);
                $mail_body = str_replace($placeholders, $replace_with, $mail_body);
                $data = [
                    'messagebody'=>  $mail_body, 
                ];
				$subject = "Practice Tab Admin";
                Mail::send(['html' => 'admin.emails.emailbody'], $data, function ($message) use ($contacts , $subject) {
                    $message->from('valeedmahmood@gmail.com', 'Practice Tabs');
                    $message->to($contacts->email);
                    $message->subject($subject);
                }); 
					DB::table('email_sent_recipent')->insert(
					array('email_address' => $contacts->email , 'created_by' =>  '1'  , 'first_name' => $contacts->first_name , 'last_name' => $contacts->last_name , 'type' =>  '1' , 'phone_number' => $contacts->primary_phone , 'email_id' => $email_id->ae_id  ));
				}
			}
		}
	}
}
   