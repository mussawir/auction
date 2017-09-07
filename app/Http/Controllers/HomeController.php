<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == "3")
        {
            return redirect("members");
        }	

        if(Auth::user()->role == "1")
        {
            return redirect("admin");
        }

        if(Auth::user()->role == "2")
        {
            return redirect("superadmin");
        }
    }


    
    
}
