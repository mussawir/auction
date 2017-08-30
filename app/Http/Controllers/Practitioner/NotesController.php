<?php

namespace App\Http\Controllers\Practitioner;
use App\Models;
use App\Models\notes;
use App\Models\Practitioner;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Dompdf\Exception;

class NotesController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
       // Session::pull('marketing');
        //Session::set('management','active');
        //Session::pull('dashboard');
    }
    public function index()
    {

        $table1 = notes::select('*')->orderBy('created_at', 'asc')->get();
        return view('practitioner.message.pa-message')
            ->with('notes',$table1)
            ->with('meta', array('page_title'=>'Notes'))
            //->with('message','active')
            //->with('send_message','active')
            ;
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $notes = new notes;
        $notes->pra_id = $this->practitioner_info->pra_id;
        $notes->pa_id = $input['pa_id'];
        $notes->note_text = $input['mail_body'];
        $notes->save();
        return Redirect::back();
    }


}
