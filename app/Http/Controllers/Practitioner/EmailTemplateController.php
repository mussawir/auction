<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Models\Practitioner;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class EmailTemplateController extends Controller
{
    public function __construct()
    {
		$this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        Session::set('marketing', 'active');
        Session::pull('management');
        Session::pull('dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$pracp = Session::get('practitioner_session');
         $pra = Practitioner::find($pracp['pra_id']);
       // $prac = Session::get('practitioner_session');
        $prac = Auth::user()->user_id;
		
        $list = EmailTemplate::select('*')->where('user_id',$prac)->whereIn('user_type', [2])->orderBy('name', 'asc')->get();
        return view('practitioner.email-template.list')->with('list', $list)
            ->with('meta', array('page_title'=>'Email Template List',isset($list)?count($list):0))
            ->with('marketing_main','active')
			->with('pra',$pra)
			->with('practitioner_info',$this->practitioner_info)
            ->with('template_body','active')
            ->with('template_list','active');
    }
    public function templates()
    {
        $prac = Session::get('practitioner_session');
        $list = EmailTemplate::select('*')->where('user_id',$prac['pra_id'])->whereIn('user_type', [1, 2])->orderBy('name', 'asc')->get();
        return view('practitioner.email-template.index')->with('list', $list)
            ->with('meta', array('page_title'=>'Email Template List',isset($list)?count($list):0))
            ->with('marketing_main','active')
			->with('practitioner_info',$this->practitioner_info)
            ->with('eg_sub_menu_new','active');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('practitioner.email-template.new')
            ->with('meta', array('page_title'=>'New Email Template'))
            ->with('marketing_main','active')
			->with('practitioner_info', $this->practitioner_info)
            ->with('template_body','active');
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
		$user_id = Auth::user()->user_id;
	
        $data = EmailTemplate::where('name', '=', Input::get('name'))->first();
        if ($data === null) {
//            $input = $request->all();
//            $prac = Session::get('practitioner_session');
//            $input['pra_id'] = $prac['pra_id'];
//            EmailTemplate::create($input);
            $template = new EmailTemplate; 
            $template->name = $request->name;
            $template->template = $request->template;
            $template->user_id = $user_id;
            $template->user_type = '2'; // 2 defined "practitioner", and 1 defined "admin"
            $template->save();
            Session::put('success','New Email Template is created successfully!');
            return Redirect::to('/practitioner/email-templates');
        }else{
            Session::put('error','Email Template Already Found!');
            return Redirect::back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = EmailTemplate::find($id);
        return view('practitioner.email-template.view')
            ->with('data', $data)
            ->with('meta', array('page_title'=>'View Email Template','item_counter'=>0))
            ->with('marketing_main','active')
			->with('practitioner_info',$this->practitioner_info)
            ->with('template_body','active');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = EmailTemplate::find($id);
        return view('practitioner.email-template.edit')
            ->with('data', $data)
            ->with('practitioner_info',$this->practitioner_info)
            ->with('meta', array('page_title'=>'Edit Email Template'))
                      ->with('marketing_main','active')
            ->with('template_body','active');
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

        $table1 = EmailTemplate::find($request->et_id);
        $table1->name = $request->name;
        $table1->template = $request->template;
        $table1->save();

        Session::put('success','Email template updated successfully!');
        return Redirect::to('/practitioner/email-templates/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table1 = EmailTemplate::find($id);
        if(isset($table1)){
            $table1->delete();
            
            Session::put('success','Email template is deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
