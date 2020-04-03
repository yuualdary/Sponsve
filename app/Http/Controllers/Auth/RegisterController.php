<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;

use App\User;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Auth\nullable;
use Illuminate\Support\Facades\Input;





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
            'password' => 'required|string|min:6|confirmed',
            'gender'=>'required',
            'image'=>'required|mimes:jpeg,bmp,png'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if (User::where('email', '=', Input::get('email'))->exists()) {
            // user found
            return back();
         }else{

        $request = request();

        $currName=$data['name'];

        $profileImage = $request->file('image');
        //-profile nama belakang dari file tsb
        $profileImageSaveAsName = time(). "-profile." .
            $profileImage->getClientOriginalExtension();

        $upload_path = 'profile_image/';
        $profile_image_url = $upload_path . $profileImageSaveAsName;
        //logic = sukses berati profileImage(image) dipindahkan ke path atau folder yg ditentukan, simpan sbg nama dengan infix -profile
        $success = $profileImage->move($upload_path, $profileImageSaveAsName);
        //get Initial from name
        $getInitial=Str::substr($currName, 0, 2);
        $getUpperInitial=strtoupper($getInitial);
        //
        //get rand 4 number
        $fourdigitrandom = mt_rand(1000,9999);
        //
        // initial + rand number
        $getUserCode=$getUpperInitial.$fourdigitrandom; 
        //
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'gender'=>$data['gender'],
            'image'=>$profile_image_url,
            'user_code'=>$getUserCode
            
        ]);
        }



    }


}