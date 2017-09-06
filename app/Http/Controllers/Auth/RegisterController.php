<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'identity' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   //mainFiles
        //ic_image stand for id card image
        
        if($data['ic_image']) {
       
        $files = $data['ic_image'];
            
        $path = 'public/identity/images';
        $pathUpdate = '';
        $rand_num = rand(11111, 99999);
        $filename = $rand_num .'-'.$files->getClientOriginalName();
        $upload_success = $files->move($path, $filename);
        $pathUpdate= $path.'/'.$filename;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'identity' => $pathUpdate,
            'identity_image' => $data['ic_image'],
            'campus_name' => $data['campus_name'],
            'role' => 3,
            'password' => bcrypt($data['password']),
        ]);
        //	$this->copyFile($pathUpdate);
        $data->save();
               }





      
    }
}
