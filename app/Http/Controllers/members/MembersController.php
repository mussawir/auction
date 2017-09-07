<?php

namespace App\Http\Controllers\members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    //

    public function index()
    {
       return view('members.index');

    }
}
