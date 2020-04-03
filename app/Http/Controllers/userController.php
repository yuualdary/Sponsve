<?php

namespace App\Http\Controllers;
use Auth;
use Image;
use App\position;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\user;

class userController extends Controller
{
    public function profile(){
        $position=Position::all();
        

        return view('profile', array('user' => Auth::user()),compact('position') );
    }

    public function update_avatar(Request $request){

            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save( public_path('profile_image/' . $filename ) );

                $user = Auth::user();
                $user->image = $filename;
                $user->save();
        }


        return view('profile', array('user' => Auth::user()) );

    }

    public function userDetail($id){
        
        $userDetail = DB::table('users')
                    ->join('positions','positions.id_position','=','users.position_id')
                    ->join('companies','companies.company_id','=','users.userid_tocompany')
                    ->where([['users.id','=',$id]])
                    ->get();

        return view('userDetail',['userDetail'=>$userDetail]);
    }


}
