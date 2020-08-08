<?php

namespace App\Http\Controllers;

use App\company;
use Validator;
use Auth;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddYourEmployeePost;
use Image;
use Illuminate\Support\Facades\Input;
use App\loguser;
use App\Rules\validMail;
use App\Mail\mailForCompany;
use Illuminate\Support\Facades\Mail;


class CompanyController extends Controller
{
    //

    public function createCompany(Request $request)
    {
        // $validatedData = $request->validated();

        // if($validatedData->fails())
        // {
                    //     return redirect()->back()->withErrors($validator);
                    // }

             if(Auth::user()->userid_tocompany == NULL){


                
                // $companyEmail=DB::table('companies')
                // ->where([['companies.website_address','=',$request->website_address]])
                // ->get();
                $mail=$request->website_address;
                    
                // if(count($companyEmail)!=NULL){


                //     return response()->json(['fail'=>'This email already taken']);

                // }
                    $validator = $request->validate(
                        [
                            'website_address'=>['required', new validMail($mail)],

                             'company_phone' => 'required|unique:companies',

                        
                        ]);
                 
                
                    if($request->hasFile('company_photo'))
                        {
                        
                        
                            $profileImage=$request->file('company_photo');
                            $profileImageSaveAsName=time()."-proposal.".$profileImage->getClientOriginalExtension();
                            $upload_path='aset/';
                            $Companyfile=$upload_path . $profileImageSaveAsName;
                            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
                        }
                        $adminPos=DB::table('positions')
                        ->where([['position','=','Admin']])
                        ->get();
                    
                        foreach($adminPos as $aP){
                        
                             $admin= $aP->id_position;
                        }
                    
                    //Company Create New
                    
                            $User=Auth::user()->name;
                           
                            $company =new Company();
                            $company->company_name = $request->company_name;
                            $company->company_address=$request->company_address;
                            $company->status_company=$request->status_company;
                            $company->company_phone=$request->company_phone;
                            $company->website_address=$request->website_address;
                            $company->social_media=$request->social_media;
                            $company->company_photo=$Companyfile;
                            $company->save();
                    
                    $currUser= user::find(Auth::user()->id);
                    $currUser->userid_tocompany=$company->company_id;
                    $currUser->position_id=$admin;
                    $currUser->save();
                    //Dipisah karna getclientoriginalextension() tidak bisa menerima data kosong. Next time coba dibuat nullable()
                    if($request->hasFile('company_photo'))
                    {
                        $company->company_photo=$Companyfile;
                    
                    }
                    
                    
                    $EmailAddress= $request->website_address;
                    $To=$EmailAddress;

                    Mail::to($EmailAddress)->send(new mailForCompany($To,$User));
                
                    return redirect()->action(
                        'CompanyController@viewDetailCompany',['company_id'=>$company->company_id] 
                    )->with('successEdit','success');
                    
         }
         else{

            return redirect()->action(
                'CompanyController@viewDetailCompany',['company_id'=>Auth::user()->userid_tocompany]); 
         }
         
    }

    public function viewDetailCompany($company_id)
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
        ->join('users','users.userid_tocompany','=','companies.company_id')
        ->join('positions','positions.id_position','=','users.position_id')     
        ->where([['users.id','=',Auth::user()->id]])
        ->get();

        $reqDet= DB::table('companies')  
                 ->where([['companies.company_id','=',$company_id]])
                 ->get();
       
         
        $owner= DB::table('companies')
                 ->join('users','users.userid_tocompany','=','companies.company_id')
                 ->join('positions','positions.id_position','=','users.position_id')     
                 ->where([['positions.position','=','Admin'],['companies.company_id','=',$company_id]])
                 ->get();

        //
        // to get all user to be selected when add member
        $getAlluser=DB::table('users')
                    ->where([['users.userid_tocompany','=',null]])
                    ->get();   
        //

        $getListMember= DB::table('users')
                     ->join('companies','companies.company_id','=','users.userid_tocompany')
                     ->join('positions','positions.id_position','=','users.position_id')
                     ->where([['users.userid_tocompany','=',$company_id]])
                     ->orderBy('positions.position', 'asc')
                     ->get();
        $checkCurrId= DB::table('users')
                     ->join('companies','companies.company_id','=','users.userid_tocompany')
                     ->join('positions','positions.id_position','=','users.position_id')
                     ->where([['users.userid_tocompany','=',$company_id],['users.id','=',Auth::user()->id]])
                     ->get();
        $adminCheck= DB::table('users')
                     ->join('companies','companies.company_id','=','users.userid_tocompany')
                     ->join('positions','positions.id_position','=','users.position_id')
                     ->where([['users.userid_tocompany','=',$company_id],['users.id','=',Auth::user()->id],['positions.position','=','Admin']])
                     ->get();
        foreach($checkCurrId as $cId)
        {   
            $checkCurrIdExistInRecord=$cId->id;
            

        }

        if(count($adminCheck) != NULL){
        
        foreach($adminCheck as $aC)
        {   
            $isAdmin=$aC->id;
        }
    }
         else {

            $isAdmin=0;


         }


      
            $logUserCompany=DB::table('logusers')
                            ->join('users','users.id','=','logusers.log_touserid')
                            ->where([['logusers.log_fromcompanyid','=',$company_id]])
                            ->orderby('logusers.log_id','asc')
                            ->get();  
            
            $comments = DB::table('comments')
                        ->join('users', 'users.id','=','comments.user_commentid')
                        ->where([['comments.company_commentid','=',$company_id],['comments.proposal_commentid','=',NULL],['comments.item_id','=',NULL]])                    
                        ->get();

            $reply = DB::table('replies')
                        ->join('comments', 'comments.cmntid','=','replies.comment_id')
                        ->join('users', 'users.id','=','replies.user_replyid')
                         ->get();
       
        return view('DetailOfProfileCompany',['compDet'=>$compDet,'getAlluser'=>$getAlluser,'testVar'=>$company_id,'getListMember'=>$getListMember,'admin'=>$admin,'owner'=>$owner,'getdata'=>$getdata,'reqDet'=>$reqDet,'checkCurrIdExistInRecord'=>$checkCurrIdExistInRecord,'logUserCompany'=>$logUserCompany,'comments'=>$comments,'reply'=>$reply,'isAdmin'=>$isAdmin]);

        
    }

    public function companyList(Request $request){
            $data=$request->all();

            $companyList = DB::table('companies')

                        ->paginate(9);
        

        
                return view('companyList',['companyList'=>$companyList,'data'=>$data]);

        }   


        public function chooseCompanies($event_id){

            date_default_timezone_set('Asia/Jakarta');
            $currtime=date('Y-m-d H:i');    
            
            $expiredDate=date('Y-m-d', strtotime($currtime. ' + 7 days'));
            $status = DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','REJECT']])->get();
            $status2 = DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','SUBMIT']])->get();
            $status3= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','INVITED']])->get();


            foreach($status as $st){


                $reject= $st->Master_id;
            }

            foreach($status2 as $st2){
        
        
                $submit= $st2->Master_id;
            }

            
            foreach($status3 as $st3){
        
        
                $invited= $st3->Master_id;
            }

            $companyList = DB::table('companies')
                             ->where([['companies.company_id','!=',Auth::user()->userid_tocompany]])
                            ->get();
            $invitedMember = DB::table('mapping_requests')
                            ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                            ->join('masters','masters.master_id','=','mapping_requests.req_status')
                            ->where([['mapping_requests.req_status','=',$invited],['mapping_requests.req_fromevent','=',$event_id]])
                            ->get();
                           
                           
            $yourMember = DB::table('mapping_requests')
                            ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                            ->join('masters','masters.master_id','=','mapping_requests.req_status')
                            ->where([['mapping_requests.req_status','!=',$reject],['mapping_requests.req_status','!=',$invited],['mapping_requests.req_fromevent','=',$event_id]])
                            ->get();


        

            
        
                return view('InviteMember',['companyList'=>$companyList,'event_id'=>$event_id,'invitedMember'=>$invitedMember,'submit'=>$submit,'yourMember'=>$yourMember]);

        } 

    public function viewDetailCompanyFromListRequest($company_id)
    {
        
        $compDet= DB::table('companies')
                
                ->where([['companies.company_id','=',$company_id]])
                ->get();

        
        $owner= DB::table('companies')
                ->join('users','users.userid_tocompany','=','companies.company_id')
                ->join('positions','positions.id_position','=','users.position_id')     
                ->where([['positions.position','=','Admin'],['companies.company_id','=',$company_id]])
                ->get();


        return view('DetailCompanyFromList',['compDet'=>$compDet,'owner'=>$owner]);
    }
    public function AddYourEmployee()
    {

    }

    public function viewNewCompany()
    {   
        return view('ProfileCompany');
    }

    public function viewListOfCompany()   
    {
        $getPosition=DB::table('positions')
                    ->where([['position','=','Admin'],])
                    ->get();
        foreach($getPosition as $p)
        {
            $pos = $p->id_position;

        }
        $getListOfCompany= DB::table('companies')
                        ->join('users','users.userid_tocompany','=','companies.company_id')
                        ->where([['users.position_id','=',$pos],['users.userid_tocompany','=',Auth::user()->userid_tocompany]])
                        ->get();
        
       

        return view('ViewListCompany',['getListOfCompany'=>$getListOfCompany]);

    }

    public function EditCompanyData(request $request)
    {

       
        switch($request->input('action'))
        {
        
            case 'Edit':
                            if($request->hasFile('company_photo'))
                                {
                                    $profileImage=$request->file('company_photo');
                                    $profileImageSaveAsName=time()."-company.".$profileImage->getClientOriginalExtension();
                                    $upload_path='aset/';
                                    $Cfile=$upload_path . $profileImageSaveAsName;
                                    $success=$profileImage->move($upload_path,$profileImageSaveAsName);
                                
                                }
                            //Company Edit 
                                $company =company::find($request->company_id);

                                $company->company_name = $request->company_name;
                            

                                $company->company_address=$request->company_address;
                                $company->status_company=$request->status_company;
                                $company->company_phone=$request->company_phone;
                                $company->website_address=$request->website_address;
                                $company->social_media=$request->social_media;
                            if($request->hasFile('company_photo'))
                            {
                                $company->company_photo=$Cfile;
                            
                            }
                        
                        
                                $company->save();
                        
                                 return back()->with('successMsg','Success edit company .');
        break;

        // case 'Delete':
        
        //               $listUser=user::find($request->id);
        //               dd($listUser);
        //               $listUser->userid_tocompany=null;
                    
        //               $listUser->save();

        //               return back()->with('successDel','Success delete member .');
                        

        // break;
         }
    }

    public function setPosition(Request $request)
    {
        $adminPos=DB::table('positions')
                    ->where([['position','=','Admin']])
                    ->get();

        $staffPos=DB::table('positions')
                    ->where([['position','=','Staff']])
                    ->get();

        foreach($staffPos as $sP){

            $staff= $sP->id_position;
        }

        foreach($adminPos as $aP){

            $admin= $aP->id_position;
        }
        $upAdmin=user::find($request->id);       
        $upAdmin->position_id=$admin;
        $upAdmin->save();

        $upStaff=Auth::user();
        $upStaff->position_id=$staff;
        $upStaff->save();

        return back()->with('successDel','Success delete member .');          
    }

    public function deleteUser(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');

    

        $listUser=user::find($request->id);
        $getCurrentCompanyID=$request->userid_tocompany;
        
        $listUser->userid_tocompany=null;
      
        $listUser->save();
        $logMessage=Auth::user()->name." Remove ".$listUser->name." From Company";
        $logCompany= new loguser();
        $logCompany->log_message=$logMessage;
        $logCompany->log_touserid=Auth::user()->id;
        $logCompany->log_createdby=Auth::user()->id;
        $logCompany->log_createdon=$currtime;
        $logCompany->log_fromcompanyid=Auth::user()->userid_tocompany;

       

        $logCompany->save();

        return back()->with('successDel','Success delete member .');


    }
//buat form baru dibawah company detail, dimana mendapatkan current company id dan masukkan id user baru 
    public function listCompanyMember(Request $request)
    {   

        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');
        $staffPos=DB::table('positions')
        ->where([['position','=','Staff']])
        ->get();

        foreach($staffPos as $sP){
        
            $staff= $sP->id_position;
        }
        $company=company::find($request->company_id);
        $getCurrentCompanyID=$request->company_id;
        
        $user=user::find($request->id);
        $user->position_id=$staff;
        $user->userid_tocompany=$getCurrentCompanyID;
        

        $user->save();  
        $logMessage=Auth::user()->name." Added ".$user->name." To Company";
        $logCompany= new loguser();
        $logCompany->log_message=$logMessage;
        $logCompany->log_touserid=Auth::user()->id;
        $logCompany->log_createdby=Auth::user()->id;
        $logCompany->log_fromcompanyid=$getCurrentCompanyID;
        $logCompany->log_createdon=$currtime;
        $logCompany->save();

        $logCompany2= new loguser();
        $logMessage2=$user->name." Joined To Company";
        $logCompany2->log_message=$logMessage2;
        $logCompany2->log_touserid=$user->id;
        $logCompany2->log_createdby=Auth::user()->id;
        $logCompany2->log_fromcompanyid=$getCurrentCompanyID;

        $logCompany2->log_createdon=$currtime;
        $logCompany2->save();

        return back()->with('successAdd','Success edit company .');
        

    }


  
}
