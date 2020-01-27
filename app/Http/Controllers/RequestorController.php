<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\company;


class RequestorController extends Controller
{
    //

    public function requestList()


    {

        $getId=Auth::user()->userid_tocompany;
      
         $getAllRequest=DB::table('mapping_requests')
                        ->join('users','users.id','=','mapping_requests.req_userid')
                        
                        ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                        ->join('masters','masters.Master_id','=','mapping_requests.req_status')

                        ->where([['mapping_requests.req_sponsorid','=',$getId],])
                        ->get(); 

        return view('RequestList',['getAllRequest'=>$getAllRequest]);

    }


    public function viewDetailRequestor($company_id)
    {
        //To get current company in form
        $companyDetail = company::find($company_id);
       
      $getdata=$companyDetail;
      $adminPos=DB::table('positions')
      ->where([['position','=','Admin']])
      ->get();

        foreach($adminPos as $aP){

            $admin= $aP->id_position;
        }

        $compDet= DB::table('companies')
        ->where([['companies.company_id','=',$getdata]])

        ->get();

        $owner= DB::table('companies')
        ->join('users','users.userid_tocompany','=','companies.company_id')
        ->join('positions','positions.id_position','=','users.position_id')     
        ->where([['positions.position','=','Admin']])
        ->get();

        $getListMember= DB::table('users')
                     ->join('companies','companies.company_id','=','users.userid_tocompany')
                     ->join('positions','positions.id_position','=','users.position_id')
                     ->orderBy('positions.position', 'asc')
                     ->get();
        $getAlluser=DB::table('users')
                     ->where([['users.userid_tocompany','=',null]])
                     ->get();   

        //
        // to get all user to be selected when add member
      
       
        return view('DetailOfProfileCompany',['compDet'=>$compDet,'testVar'=>$company_id,'admin'=>$admin,'owner'=>$owner,'getdata'=>$getdata,'getListMember'=>$getListMember,'getAlluser'=>$getAlluser]);

        
    }
}
