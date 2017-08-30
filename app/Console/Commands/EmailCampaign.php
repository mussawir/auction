<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactGroup;
use App\Models\EmailGroup;
use App\Models\EmailInGroup;
use App\Models\EmailTemplate;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\PractitionerCampaign;
use App\Models\PractitionerEmail;
use Illuminate\Http\Request;

class EmailCampaign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:campaign';

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
	 public function handle(){
		 $campaign = DB::select("SELECT cam_id, 
			campaign_name, 
			STR_TO_DATE(start_date,'%m/%d/%Y') AS start_ddate, 
			STR_TO_DATE(end_date,'%m/%d/%Y') AS end_ddate, 
			start_date,end_date,
			sent_to, 
			group_name, 
			message, 
			practitioner_campaign.status, 
			user_id, 
			created_at, 
			updated_at FROM practitioner_campaign 
			WHERE STR_TO_DATE(start_date,'%m/%d/%Y') <= DATE_FORMAT(NOW(),'%Y-%m-%d')
			AND STR_TO_DATE(end_date,'%m/%d/%Y') >= DATE_FORMAT(NOW(),'%Y-%m-%d')");
			DB::update("
			UPDATE practitioner_campaign set status = 1
			WHERE STR_TO_DATE(start_date,'%m/%d/%Y') <= DATE_FORMAT(NOW(),'%Y-%m-%d')
			AND STR_TO_DATE(end_date,'%m/%d/%Y') >= DATE_FORMAT(NOW(),'%Y-%m-%d')
			");
			DB::update("
			UPDATE practitioner_campaign set status = 2
			WHERE STR_TO_DATE(end_date,'%m/%d/%Y') < DATE_FORMAT(NOW(),'%Y-%m-%d')
			");	
			
		if(isset($campaign)){
		foreach($campaign as $items){
			$email = EmailInGroup::select('*')->where('cg_id', $items->sent_to)->get();
			foreach($email as $emailItems){
				$placeholders = array('PR.FirstName', 'PR.MiddleName', 'PR.LastName', 'PR.Email', 'PR.Phone',
					'PA.FirstName', 'PA.MiddleName', 'PA.LastName', 'PA.Email', 'PA.Phone');

				$pr = Practitioner::select('first_name', 'middle_name', 'last_name', 'email', 'primary_phone')
					->where('pra_id', '=', $items->user_id)->first();
				$pa = EmailInGroup::select('first_name', 'middle_name', 'last_name', 'email', 'primary_phone')
					->where('cg_id',$items->sent_to)->where('email', '=', $emailItems->email)->first();
				$replace_with = array($pr->first_name, $pr->middle_name, $pr->last_name, $pr->email, $pr->primary_phone,
					$pa->first_name, $pa->middle_name, $pa->last_name, $pa->email, $pa->primary_phone);
				$mail_body = preg_replace('/\{[^}]*\)|[{}]/', '', $items->message);
				$mail_body = str_replace($placeholders, $replace_with, $mail_body);
				$data = [
					'messagebody'=>  $mail_body,
				];
				$subject = "Practice Tab Campaign From :".$pr->first_name." ".$pr->last_name;
				Mail::send(['html' => 'practitioner.emails.emailbody'], $data, function ($message) use ($emailItems , $subject) {
					$message->from('postmaster@practicetabs.com', 'Practice Tabs');
					$message->to($emailItems->email);
					$message->subject($subject);
					});
				PractitionerEmail::create([
					'pra_id'	=>	$items->user_id,
					'sent_to' => $items->group_name,
					'subject' => $items->campaign_name,
					'message'	=>	$items->message
				]); 
				}
			}
		} 

	}
}
 