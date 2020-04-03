<?php

namespace App\Http\Controllers;

use App\Company;
use Validator;
use Auth;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddYourEmployeePost;
use Image;
use Illuminate\Support\Facades\Input;
use App\loguser;


class logUserController extends Controller
{
    //
    public function logUserCompany($company_id)
    {
        $logUserCompany=DB::table('logusers')
                        ->join('users','users.id','=','logusers.log_touserid')
                        ->where([['logusers.log_fromcompanyid','=',$company_id]])
                        ->orderby('logusers.log_id','asc')
                        ->get();

        return view('viewLogUserCompany',['logUserCompany'=>$logUserCompany]);

    }       

}
