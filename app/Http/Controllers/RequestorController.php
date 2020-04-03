<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\company;
use Illuminate\Support\Facades\Input;

use App\review;
use App\MappingRequest;
use App\Mail\mailForRejectRequest;
use App\Mail\mailForAcceptRequest;

use Illuminate\Support\Facades\Mail;

class RequestorController extends Controller
{
    //

    public function requestList()


    {
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');

        $expiredDate=date('Y-m-d', strtotime($currtime. ' + 7 days'));
        // dd($currtime);
        $status=DB::table('masters')->where([['prefix','=','STATUSREQUEST'],['text1','=','SUBMIT'],])->get();

        foreach($status as $s) 
        {
                $Submit = $s->Master_id;
           
        }    
        $getId=Auth::user()->userid_tocompany;
       
         $getAllRequest=DB::table('mapping_requests')
                        ->join('users','users.id','=','mapping_requests.req_userid')
                        ->join('events','events.event_id','=','mapping_requests.req_fromevent')

                        ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                        ->join('masters','masters.Master_id','=','mapping_requests.req_status')

                        ->where([['mapping_requests.req_sponsorid','=',$getId],['mapping_requests.req_status','=',$Submit],])
                        ->get(); 
                        $status1=DB::table('masters')->where([['prefix','=','STATUSPROPOSAL'],['text1','=','SUBMITTED'],])->get();
                        $status2=DB::table('masters')->where([['prefix','=','STATUSPROPOSAL'],['text1','=','REJECTED'],])->get();
                        $status3=DB::table('masters')->where([['prefix','=','STATUSPROPOSAL'],['text1','=','APPROVED'],])->get();
                
                
                        foreach($status1 as $st1){
                        
                            $id_submit = $st1->Master_id;
                        
                        }
                
                        foreach($status2 as $st2){
                        
                            $id_submit2 = $st2->Master_id;
                        
                        }
                
                        $getAlldata=DB::table('proposals')
                                    ->join('events','events.event_id','=','proposals.ptid_proposal')
                                    ->join('users','users.id','=','proposals.userid_proposal')
                                    ->join('masters','masters.master_id','=','proposals.statusproposal_id')
                                    ->where([['proposals.statusproposal_id','=',$id_submit],['proposals.ptid_proposal','=',Auth::user()->id],])
                                    ->get();
                                    //ini kurangnya check data di screen saat submit proposal
                        
                        $getAlldataForUser=DB::table('proposals')
                                    ->join('events','events.event_id','=','proposals.ptid_proposal')
                                    ->join('users','users.id','=','proposals.userid_proposal')
                                    ->join('masters','masters.master_id','=','proposals.statusproposal_id')
                                    ->where([['proposals.statusproposal_id','=',$id_submit2],['proposals.userid_proposal','=',Auth::user()->id],])
                                    ->get();

        return view('RequestList',['getAllRequest'=>$getAllRequest,'getAlldata'=>$getAlldata,'getAlldataForUser'=>$getAlldataForUser,'expiredDate'=>$expiredDate]);

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


    public function approveRequest(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');

        $getStatus= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Accept']])
                    ->get();   
                    
        foreach($getStatus as $s)
        {
                $Acc = $s->Master_id;
        }

        $Approve = MappingRequest::find($request->Mapping_Req_Id);
        
        $Approve->req_status=$Acc;
        $Approve->req_modified_at=$currtime;
        $Approve->req_modified_by=Auth::user()->id;
        $Approve->save();



        
        $getAcceptMailId=$request->Mapping_Req_Id;
     
        $AcceptTo = DB::table('mapping_requests')
                        ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                        ->join('masters','masters.Master_id','=','mapping_requests.req_status')
                        ->where([['mapping_requests.Mapping_Req_Id','=',$getAcceptMailId],])
                        ->get();

        $AcceptFrom = DB::table('companies')
                            ->where([['companies.company_id','=',Auth::user()->userid_tocompany],])
                            ->get();

        $getDefaultStatus= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Submit']])
                            ->get();     
        
        foreach($AcceptTo as $at){
            
            $EmailAddress= $at->website_address;
            
             $To=$at->company_name;
             $StatusRequest=$at->text1;
             $CanRequestAt=$at->req_modified_at;
        }
    

        foreach($AcceptFrom as $af){

            $From=$af->company_name;
        }
        


        foreach($getDefaultStatus as $d)
         {
             $Def = $d->Master_id;
        }

            // Mail::to($EmailAddress)->send(new mailForAcceptRequest($To,$From,$StatusRequest,$CanRequestAt));
            // return back();

        // $MailToUser = DB::table('companies')
        //             ->join('mapping_requests','mapping_requests.req_fromcompany','=','companies.company_id')
        //             ->where([['companies.company_id','=',],])
       //ini tgl 2 april di uncommaent
       
        try{
        
            Mail::to($EmailAddress)->send(new mailForAcceptRequest($To,$From,$StatusRequest,$CanRequestAt));
            
            return back()->with('acceptReqFail','Email Accept .');
        }
        catch(\Exception $e)
        
        {
            // Get error here
            $notUpdate= MappingRequest::find($request->Mapping_Req_Id);
             $notUpdate->req_status=$Def;
             $notUpdate->req_modified_at=$currtime;
             $notUpdate->req_modified_by=Auth::user()->id;
             $notUpdate->save();

             return back()->with('acceptReqFail','Email Accept .');
            

        }
       

    }

    public function rejectRequest(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');

         $currDate=date('Y-m-d', strtotime($currtime. ' + 7 days'));


        $getStatus= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Reject']])
                    ->get();
        $getDefaultStatus= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Submit']])
                         ->get();      
                    
        foreach($getStatus as $r)
        {
                $Rej = $r->Master_id;
        }

        foreach($getDefaultStatus as $d)
        {
                $Def = $d->Master_id;
        }

    
        $Reject = MappingRequest::find($request->Mapping_Req_Id);
        $Reject->req_status=$Rej;
        $Reject->req_modified_at=$currDate;
        $Reject->req_modified_by=Auth::user()->id;
        $Reject->save();

        $getRejectMailId=$request->Mapping_Req_Id;
     
        $RejectTo = DB::table('mapping_requests')
                        ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                        ->join('masters','masters.Master_id','=','mapping_requests.req_status')
                        ->where([['mapping_requests.Mapping_Req_Id','=',$getRejectMailId],])
                        ->get();

        $RejectFrom = DB::table('companies')
                            ->where([['companies.company_id','=',Auth::user()->userid_tocompany],])
                            ->get();
        
        foreach($RejectTo as $rt){
            
            $EmailAddress= $rt->website_address;
            
             $To=$rt->company_name;
             $StatusRequest=$rt->text1;
             $CanRequestAt=$rt->req_modified_at;
        }
    

        foreach($RejectFrom as $rf){

            $From=$rf->company_name;
        }

        // $MailToUser = DB::table('companies')
        //             ->join('mapping_requests','mapping_requests.req_fromcompany','=','companies.company_id')
        //             ->where([['companies.company_id','=',],])
        try{
        
                 Mail::to($EmailAddress)->send(new mailForRejectRequest($To,$From,$StatusRequest,$CanRequestAt));

        
                 return back()->with('rejectReqSuccess','Email Reject.');
        }
        catch(\Exception $e){
            // Get error here

            $test= MappingRequest::find($request->Mapping_Req_Id);
            $test->req_status=$Def;
            $test->req_modified_at=$currtime;
            $test->req_modified_by=Auth::user()->id;
            $test->save();

            return back()->with('rejectReqFail','Email Reject .');;
        }

                       
    }


    public function allRequest()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d');

        // dd($currtime);
        

         $currDate=date('Y-m-d', strtotime($currtime. ' + 1 days'));
        $getStatus= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Accept']])
                    ->get();

        $getStatus2= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Done']])
                    ->get();

        foreach($getStatus as $s){
            $Acc= $s->Master_id;
        }

        foreach($getStatus2 as $d){
            $done= $d->Master_id;
        }


        $trackRequest = DB::table('mapping_requests')
                        ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')//get nama
                        ->join('events','events.event_id','=','mapping_requests.req_fromevent')
                        ->join('users','users.userid_tocompany','=','mapping_requests.req_fromcompany')
                        ->join('masters','masters.Master_id','=','mapping_requests.req_status')
                        ->join('proposals','proposals.userid_proposal','=','mapping_requests.req_fromevent')
                        ->where([['users.id','=',Auth::user()->id],['mapping_requests.req_status','=',$Acc]])
                        ->get();
        
        // dd($trackRequest);
        $allRequest = DB::table('mapping_requests')
                        ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')//get nama
                        ->join('events','events.event_id','=','mapping_requests.req_fromevent')
                        ->join('users','users.userid_tocompany','=','mapping_requests.req_fromcompany')
                        ->join('masters','masters.Master_id','=','mapping_requests.req_status')
                        ->where([['mapping_requests.req_status','=',$Acc],['events.event_date','>',$currtime]])
                        ->get();
        
        


        //  dd($doneRequest);

        foreach($allRequest as $a)
        {
            $updateNew = MappingRequest::find($a->Mapping_Req_Id);
            $updateNew->req_status=$done;
            $updateNew->save(); 
        
        }

        $doneRequest  = DB::table('mapping_requests')
                     ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')//get nama
                     ->join('events','events.event_id','=','mapping_requests.req_fromevent')
                     ->join('users','users.userid_tocompany','=','mapping_requests.req_fromcompany')
                     ->join('masters','masters.Master_id','=','mapping_requests.req_status')
                     ->where([['users.id','=',Auth::user()->id],['mapping_requests.req_status','=',$done],])
                     ->get();
        $isReviewed = DB::table('reviews')
                    ->join('users','users.userid_tocompany','=','reviews.review_companyid')
                    ->join('events','events.event_id','=','reviews.review_event')
                    ->join('companies','companies.company_id','=','reviews.review_companyid')
                    ->join('masters','masters.master_id','=','reviews.review_status')
                    ->where([['users.id','=',Auth::user()->id]])
                    ->get();    
          
        // dd($isReviewed);
        $status = DB::table('masters')
                ->where([['masters.prefix','=','STATUSREVIEW'],])
                ->get();
        
        
        
        if(count($isReviewed) !=  NULL)
        {
          foreach ($isReviewed as $is){

            $review = $is->review_id;
          }
      
        }else{

            $review = 0; 
        }
    
    if(count($isReviewed) == NULL){
         
        return view('allRequest',['trackRequest'=>$trackRequest,'currtime'=>$currtime,'doneRequest'=>$doneRequest,'status'=>$status,'review'=>$review,'isReviewed'=>$isReviewed]);

       }else{
        
        
        return view('allRequest',['trackRequest'=>$trackRequest,'currtime'=>$currtime,'doneRequest'=>$doneRequest,'status'=>$status,'review'=>$review,'isReviewed'=>$isReviewed]);
       }
  
 }


    public function sendReview(Request $request)
    {
       

        $currtime=date('Y-m-d H:i');
        $defineStatus= $request->review_status;
        

        

        
        $statusReview=DB::table('masters')
                    ->where([['masters.prefix','=','STATUSREVIEW'],['masters.text1','=',$defineStatus]])
                    ->get();
        

        $requestReview=DB::table('masters')
                    ->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Reviewed'],])
                    ->get();           
        foreach ($statusReview as $sR){

            $currentStatus = $sR->Master_id;
        }

        foreach ($requestReview as $rR){

            $getReview = $rR->Master_id;
        }
      
      
                    

        $createReview = new review();
        $createReview->review_value= $request->review_value;
        $createReview->review_rating = $request->review_rating;

        $createReview->review_status = $currentStatus;
        $createReview->review_companyid= auth::user()->userid_tocompany;

        $createReview->review_event = $request->review_event;


        $createReview->review_createdby= auth::user()->id;
        $createReview->review_createdat= $currtime;
        $createReview->save();


        $setMaptoReview = mappingrequest::find($request->mappingid);
        $setMaptoReview->req_status = $getReview;
        $setMaptoReview->save();  

        return back();
    }


}
