<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Practitioner;
use App\Models\PracticeProfile;
use App\Models\Hours;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;

class ProfileController extends Controller
{
    protected $baseUrl;

    public function __construct(UrlGenerator $url)
    {
		$this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        $this->baseUrl = $url;
        Session::pull('management');
        Session::pull('dashboard');
        Session::pull('marketing');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prac = Session::get('practitioner_session');
        $table1 = Practitioner::find($prac['pra_id']);
		$table2 = PracticeProfile::find($prac['pra_id']);
		$table3 = Hours::find($prac['pra_id']);
        return view('practitioner.profile.index')
		->with('practitioner_info',$this->practitioner_info)
            ->with('table1', $table1 ,$table2,$table3)
			->with('table2', $table2)
			->with('table3', $table3)
            ->with('meta', array('page_title'=>'Manage Profile'))
            ->with('profile','active')
            ->with('directory', $prac['directory']);
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
		
        $table1 = Practitioner::find($prac['pra_id']);
		$table2 = PracticeProfile::find($prac['pra_id']);
		$table3 = Hours::find($prac['pra_id']);
		

        $filename = '';
        if($request->hasFile('photo')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($table1->photo) && (!empty($table1->photo))) {

                if(file_exists(public_path() . '/practitioners/'.$prac['directory'].'/' . $table1->photo)){
                    unlink(public_path() . '/practitioners/'.$prac['directory'].'/' . $table1->photo);
                }
                $file->move(public_path().'/practitioners/'.$prac['directory'].'/', $filename);
            }
        } else {
            $filename = $request->photo;
        }
		
		
		 $coverphoto = '';
        if($request->hasFile('cover_photo')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $filee = $request->file('cover_photo');
            $rand_num = rand(11111, 99999);
            $coverphoto = $rand_num. '_' .$filee->getClientOriginalName();

            if (isset($table1->cover_photo) && (!empty($table1->cover_photo))) {

                if(file_exists(public_path() . '/practitioners/'.$prac['directory'].'/' . $table1->cover_photo)){
                    unlink(public_path() . '/practitioners/'.$prac['directory'].'/' . $table1->cover_photo);
                }
                $filee->move(public_path().'/practitioners/'.$prac['directory'].'/', $coverphoto);
            }
        } else {
            $coverphoto = $request->cover_photo; 
        }

        $table1->photo = $filename;
		$table1->cover_photo = $coverphoto;
        $table1->suffix = $request->suffix;
        $table1->first_name = $request->first_name;
        $table1->middle_name = $request->middle_name;
        $table1->last_name = $request->last_name;
        $table1->primary_phone = $request->primary_phone ;
        $table1->secondary_phone = $request->secondary_phone ;
        $table1->mailing_street_address = $request->mailing_street_address ;
        $table1->mailing_city = $request->mailing_city ;
        $table1->mailing_zip = $request->mailing_zip ;
        $table1->mailing_state = $request->mailing_state ;
        $table1->billing_street_address = $request->billing_street_address ;
        $table1->billing_city = $request->billing_city ;
        $table1->billing_zip = $request->billing_zip ;
        $table1->billing_state = $request->billing_state ;
        $table1->cc_type = $request->cc_type ;
        $table1->cc_number = $request->cc_number ;
        $table1->cc_month = $request->cc_month ;
        $table1->cc_year = $request->cc_year ;
        $table1->cc_cvv = $request->cc_cvv ;
		$table1->Gender = $request->Gender ;
		
		
		$table1->clinic_logo = $filename;
        $table1->clinic_doc_head = $request->clinic_doc_head;
        $table1->clinic_doc_footer = $request->clinic_doc_footer;
		$table1->clinic_name = $request->clinic_name;
        $table1->clinic_street_address = $request->clinic_street_address ;
        $table1->clinic_city = $request->clinic_city ;
        $table1->clinic_zip = $request->clinic_zip ;
        $table1->clinic_state = $request->clinic_state ;
        $table1->clinic_phone = $request->clinic_phone ;
        $table1->clinic_fax = $request->clinic_fax ;
        $table1->clinic_email = $request->clinic_email;
		
	

		$table2->about = $request->about;
        $table2->practice_years = $request->practice_years;
        $table2->website_url = $request->website_url;
        $table2->degree = $request->degree ;
        $table2->accepts_new_patients = $request->accepts_new_patients ;
		
		
		$table2->ai_woc = $request->ai_woc;
        $table2->ai_pi = $request->ai_pi;
        $table2->ai_ppo = $request->ai_ppo;
        $table2->ai_hmo = $request->ai_hmo ;
        $table2->ai_medicaid = $request->ai_medicaid ;
	    $table2->ai_medicare = $request->ai_medicare ;
        $table2->languages_spoken = $request->languages_spoken;
        $table2->specialties = $request->specialties;
		$table2->Type = $request->Type;
		$table2->ai_Medical = $request->ai_Medical;
		
		
		
		$table3->monday_open = $request->monday_open;
        $table3->tuesday_open = $request->tuesday_open;
        $table3->wednesday_open = $request->wednesday_open;
        $table3->thursday_open = $request->thursday_open;
        $table3->friday_open = $request->friday_open;
        $table3->saturday_open = $request->saturday_open;
        $table3->sunday_open = $request->sunday_open;
		
        $table3->monday_close = $request->monday_close;
        $table3->tuesday_close = $request->tuesday_close;
        $table3->wednesday_close = $request->wednesday_close;
        $table3->thursday_close = $request->thursday_close;
        $table3->friday_close = $request->friday_close;
        $table3->saturday_close = $request->saturday_close;
        $table3->sunday_close = $request->sunday_close;
		
		
        $table1->save();
		$table2->save();
		$table3->save();
		
		

        Session::put('success','Profile updated successfully!');

        return Redirect::to('/practitioner/profile');
    }

    public function clinic()
    {
        $prac = Session::get('practitioner_session');
        $table1 = Practitioner::find($prac['pra_id']);
        return view('practitioner.profile.clinic')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Manage Clinic Info'))
			->with('practitioner_info',$this->practitioner_info)
            ->with('clinic','active')
            ->with('directory', $prac['directory']);
    }



    public function practice()
    {
        $prac = Session::get('practitioner_session');
        $table1 = PracticeProfile::find($prac['pra_id']);
        return view('practitioner.profile.practice')
		->with('practitioner_info',$this->practitioner_info)
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Manage Clinic Info'))
            ->with('practice','active');

    }



    public function hours()
    {
        $prac = Session::get('practitioner_session');
        $table1 = Hours::find($prac['pra_id']);
        return view('practitioner.profile.hours')
		->with('practitioner_info',$this->practitioner_info)
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Manage Clinic Info'))
            ->with('hours','active');
    }


}