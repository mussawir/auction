<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperadminController extends Controller
{
    //

    public function index()
    {
       return view('superadmin.index');

    }
}
