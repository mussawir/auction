<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\PatientFile;
use App\Models\PractitionerPatient;
use App\Models\notes;
use App\Models\message_header;
use App\Models\message_history;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image as InterventionImage;
use File;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PraSubscribe;
use DB;

class PatientController extends Controller
{
    protected $baseUrl;
	var $practitioner_info = null;

    public function __construct(UrlGenerator $url)
    {
        $this->baseUrl = $url;
        Session::set('management', 'active');//set header button
		$this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$prac = Session::get('practitioner_session');
         $pra = Practitioner::find($prac['pra_id']);
	  $meta = array('cm_main_menu'=>'active');
        //$prac = Session::get('practitioner_session');
		$prac = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
		//var_dump($prac);
		//return;
        $table1 = Patient::select('*')
		->whereIn('pa_id',function($query)use ($prac){
   $query->select('pa_id')
     ->from('pra_pa')
     ->where('pra_id', $prac['pra_id']);
	 })
		->orderBy('first_name', 'asc')->get();
        return view('practitioner.patient.index')
		    ->with('practitioner_info', $this->practitioner_info)
			->with('table1', $table1)
            ->with('meta', array('page_title'=>'Patients List',isset($table1)?count($table1):0))
            ->with('patients_list','active')
			->with('meta', $meta)
			->with('pra',$pra)
            ->with('directory', $prac['directory']);
    }
    public function profile($id)
    {
        $prac = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        $message_header = message_header::where('practitioner_id','=',$prac['pra_id'])->where('patient_id','=',$id)->first();
        $pa_id = 'pa_'.$id;
        $message_history = message_history::where('msg_id','=',$message_header['id'])->where('sent_by','=',$pa_id)
            ->orderBy('created_at','desc')
            ->first();
        $notes = notes::select('*')->where('pra_id','=',$prac['pra_id'])->where('pa_id','=',$id)
            ->orderBy('created_at','desc')->first();
        $table1 = Patient::select('*')
            ->where('pa_id','=',$id)->get();
        return view('practitioner.patient.profile')->with('table1', $table1)
            ->with('notes',$notes)
			->with('practitioner_info', $this->practitioner_info)
            ->with('message_history',$message_history)
            ->with('message_header',$message_header)
            ->with('prac',$prac)
            ->with('meta', array('page_title'=>'Patients List',isset($table1)?count($table1):0))
            ->with('patients_list','active')
            ->with('directory', $prac['directory']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Redirect::to('/practitioner/patient/new-wizzard');
        return view('practitioner.patient.new')
            ->with('meta', array('page_title'=>'Patient'))
            ->with('new_patient','active');;
    }
 public function createWizzard()
    {
		$meta = array('cm_main_menu'=>'active');
        return view('practitioner.patient.new-wizzard')
            ->with('meta', array('page_title'=>'Patient'))
			->with('practitioner_info', $this->practitioner_info)
			->with('meta' , $meta )
            ->with('patients_list','active');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
                $validator = \Validator::make($request->toArray(), [
                    'category' => 'required|max:100'
                ]);
                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */
        $input = $request->all();
        $prac = Session::get('practitioner_session');

        //create directory
        $directory = uniqid(strtolower($request->get('first_name')),false);
        //$path = public_path().'/practitioners/'.$prac['directory'].'/'.$directory;
        $path = public_path().'/images/practitioners/'.$this->practitioner_info->url .'/';
		//File::makeDirectory($path, 0777, true, true);

        $filename = '';
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '-' .$file->getClientOriginalName();
            $file->move($path, $filename);
        }

        $input['photo'] = $filename;
        $input['pra_id'] = $prac['pra_id'];
        $input['directory'] = $directory;
        $patient = Patient::create($input);

        PractitionerPatient::create([
            'pra_id'    =>  $prac['pra_id'],
            'pa_id'     =>  $patient['pa_id']
        ]);
        
        Session::put('success','Patient is created successfully!');
        return Redirect::to('/practitioner/patient/index');
    }
public function createUser($email,$firstName,$lastName)
{
    $password = Str::quickRandom(8);
    $prac = Session::get('practitioner_session');
        $data = [
            'name' => ucwords($firstName) .' '. ucwords($lastName),
            'email' => $email,
            'password'  => $password,
'pra_name' => ucwords($prac['first_name']) . ' ' . ucwords($prac['last_name'])
            ];
            $subject = 'Patient Registration Email';
            Mail::send(['html' => 'practitioner.emails.practitioner-email-template'], $data, function ($message) use ($email , $subject) {
                $message->from('postmaster@practicetabs.com', 'Practice Tabs');
                $message->to($email);
                $message->subject($subject);
                });
             $user = User::create([
            'role'  => 4,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password'  => bcrypt($password)
        ]);
             return $user['user_id'];
}
public function storeWizzard(Request $request)
    {
        $input = $request->all();
        $prac = Session::get('practitioner_session');
        //create directory
        $directory = uniqid(strtolower($request->get('first_name')),false);
       // $path = public_path().'/practitioners/'.$prac['directory'].'/'.$directory;
		$path = public_path().'/images/practitioners/'.$this->practitioner_info->url .'/';
       // File::makeDirectory($path, 0777, true, true);

        $filename = '';
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '-' .$file->getClientOriginalName();
            $file->move($path, $filename);
			//if(FILE::move($path)){	
			
			//}
        }
        $input['photo'] = $filename;
        $input['pra_id'] = $prac['pra_id'];
      //$input['directory'] = $directory;
		$input['directory'] = $path;
        $input['user_id'] = $this->createUser($request->email,$request->first_name,$request->lasT_name);
        $patient = Patient::create($input);

        PractitionerPatient::create([
            'pra_id'    =>  $prac['pra_id'],
            'pa_id'     =>  $patient['pa_id']
        ]);
        PraSubscribe::create([
					'request_msg'		=>	'By default subscribe',
					'isApproved'	=>	'1',
					'pra_id'		=>	$prac['pra_id'],
					'pa_id'	=>	$patient['pa_id']
				]);
        Session::put('success','Patient is created successfully!');
        $this->uploadFilesAjax($request,$patient['pa_id']);
		
         return Redirect::to('/practitioner/patient/profile/'.$patient['pa_id']);
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
        $table1 = Patient::find($id);
        $prac = Session::get('practitioner_session');
        return view('practitioner.patient.edit')
		->with('practitioner_info', $this->practitioner_info)
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Edit Patient Record'))
            ->with('patients_list','active')
            ->with('directory', $prac['directory']);
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
        /*
                $validator = \Validator::make($request->toArray(), [
                    'name' => 'required|max:100'
                ]);

                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */
        $prac = Session::get('practitioner_session');
        $table1 = Patient::find($request->pa_id);
        $filename = '';
        if($request->hasFile('photo')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($table1->photo) && (!empty($table1->photo))) {

			 /*if(file_exists(public_path() . '/practitioners/'.$prac['directory'].'/'.$table1->directory.'/' . $table1->photo)){
                    unlink(public_path() . '/practitioners/'.$prac['directory'].'/'.$table1->directory.'/' . $table1->photo);
                }
                $file->move(public_path().'/practitioners/'.$prac['directory'].'/'.$table1->directory.'/', $filename);*/
			
                if(file_exists(public_path() . '/images/practitioners/'.$this->practitioner_info->url.'/'. $table1->photo)){
                    unlink(public_path() . '/images/practitioners/'.$this->practitioner_info->url.'/'. $table1->photo);
                }
                //$file->move(public_path().'/practitioners/'.$prac['directory'].'/'.$table1->directory.'/', $filename);
				 $file->move(public_path() . '/images/practitioners/'.$this->practitioner_info->url .'/', $filename);
            }
        } else {
            $filename = $request->photo;
        }

        $table1->photo = $filename;
        $table1->first_name = $request->first_name;
        $table1->middle_name = $request->middle_name;
        $table1->last_name = $request->last_name;
        $table1->email = $request->email;
        $table1->date_of_birth = $request->date_of_birth;
        $table1->age = $request->age ;
        $table1->primary_phone = $request->primary_phone ;
        $table1->secondary_phone = $request->secondary_phone ;
        $table1->mailing_street_address = $request->mailing_street_address ;
        $table1->mailing_city = $request->mailing_city ;
        $table1->mailing_zip = $request->mailing_zip ;
        $table1->billing_street_address = $request->billing_street_address ;
        $table1->billing_city = $request->billing_city ;
        $table1->billing_zip = $request->billing_zip ;
        $table1->mailing_state = $request->mailing_state ;
        $table1->billing_state = $request->billing_state ;
        $table1->notes = $request->notes ;
        $table1->cc_type = $request->cc_type ;
        $table1->cc_number = $request->cc_number ;
        $table1->cc_month = $request->cc_month ;
        $table1->cc_year = $request->cc_year ;
        $table1->cc_cvv = $request->cc_cvv ;
        $table1->save();

        Session::put('success','Patient record is updated successfully!');

        return Redirect::to('/practitioner/patient/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prac = Session::get('practitioner_session');
        $table1 = Patient::find($id);
		$users = DB::DELETE('DELETE FROM users where user_id = '.$table1->user_id);
        if(isset($table1)){
            if (isset($table1->photo) && (!empty($table1->photo))) {
                if(file_exists(public_path() . 'iamges//practitioners/' .$this->practitioner_info->url .'/' . $table1->photo)){
                    unlink(public_path() . 'images/practitioners/'.$this->practitioner_info->url .'/' . $table1->photo);
                }
            }
            $table1->delete();

            Session::put('success','Patient is deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }


    /**
     * Show the form for files the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function files($id)
    {
        $prac = Session::get('practitioner_session');
        $table1 = Patient::find($id);
        $table2 = PatientFile::select('*')->where('pa_id', $id)->where('pra_id', $prac['pra_id'])->get();
        return view('practitioner.patient.files')
		->with('practitioner_info', $this->practitioner_info)
            ->with('table1', $table1)
            ->with('table2', $table2)
            ->with('meta', array('page_title'=>'Patient Files'))
            ->with('patients_list','active')
            ->with('directory', $prac['directory']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadFiles(Request $request)
    {
        $prac = Session::get('practitioner_session');
        $table1 = Patient::find($request->pa_id);

        // getting all of the post data
        $files = $request->file('files');
        $input = $request->all();
        // Making counting of uploaded files
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach($files as $file) {
            $filename = $file->getClientOriginalName();
            //$upload_success = $file->move($destinationPath, $filename);
            $file->move(public_path().'images/practitioners/'.$this->practitioner_info->url .'/', $filename);
            $input['pa_id'] = $request->pa_id;
            $input['pra_id'] = $prac['pra_id'];
            $input['file_name'] = $filename;
            PatientFile::create($input);
        }

        Session::put('success','Files uploaded successfully!');
        return Redirect::to('/practitioner/patient/files/'.$request->pa_id);
    }

    public function uploadFilesAjax(Request $request,$pa_id)
    {
        $prac = Session::get('practitioner_session');
        $table1 = Patient::find($pa_id);
        // getting all of the post data
        $files = $request->file('files');
        $input = $request->all();
        // Making counting of uploaded files
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach($files as $file) {
            $filename = $file->getClientOriginalName();
            //$upload_success = $file->move($destinationPath, $filename);
            $file->move(public_path().'images/practitioners/'.$this->practitioner_info->url .'/', $filename);
            $input['pa_id'] = $pa_id;
            $input['pra_id'] = $prac['pra_id'];
            $input['file_name'] = $filename;
            PatientFile::create($input);

        }
    //    Session::put('success','Files uploaded successfully!');
        
    }


    public function destroyFile($id)
    {
        $prac = Session::get('practitioner_session');
        $table1 = PatientFile::find($id);
        $table2 = Patient::select('directory')->where('pa_id', '=', $table1->pa_id)->first();
        if(isset($table1)){
            if (isset($table1->file_name) && (!empty($table1->file_name))) {
                if(file_exists(public_path() . 'images/practitioners/'.$this->practitioner_info->url .'/'. $table1->file_name)){
                    unlink(public_path() . 'images/practitioners/'.$this->practitioner_info->url .'/'. $table1->file_name);
                }
            }
            $table1->delete();
            //Session::put('success','Patient is deleted successfully!');
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    public function downloadFile($id)
    {
        $prac = Session::get('practitioner_session');
        $table1 = PatientFile::find($id);
        $table2 = Patient::select('directory')->where('pa_id', '=', $table1->pa_id)->first();

        $file = public_path() . 'images/practitioners/'.$this->practitioner_info->url .'/' . $table1->file_name;

        /*$headers = array(
            'Content-Type: '.$table1->mime_type
        );*/
        return response()->download($file);
        //return response()->download($file, $table1->file_name, $headers);
    }
}
/*
public function destroyFile($pa_id, $pf_id)
{
    $prac = Session::get('practitioner_session');
    $table1 = PatientFile::select('*')->where('pa_id', $pa_id)->where('pf_id', $pf_id)->get();
    $table2 = Patient::find($pa_id);
    if(isset($table1)){
        if(file_exists(public_path() .'/practitioners/'.$prac['directory'].'/' .$table2->directory .'/'. $table1->file_name)){
            unlink(public_path() .'/practitioners/'.$prac['directory'].'/' .$table2->directory .'/'. $table1->file_name);
        }
        $table1->delete();
        Session::put('success','File is deleted successfully!');
        return Redirect::to('/practitioner/patient/files/'.$pa_id);
    }
    return response()->json(['status' => 'error']);
}
}
 */