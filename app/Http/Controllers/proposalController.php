<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\event;
use App\user;
use Illuminate\Support\Facades\DB;
use App\proposal;
use Validator;
use Redirect;
use Auth;
use App\master;
use Illuminate\Support\Facades\Input;
use Image;
use Storage;
use App\loguser; 
use App\MappingRequest;
use App\Mail\appEmail;
use App\sendMakeRequest;
use Illuminate\Support\Facades\Mail;

class proposalController extends Controller
{
    //



    public function addContract(Request $request)
    {




        $validator = Validator::make($request->all(),
        [
           
           
             'proposal_title' => 'required',
           
             
            'proposal_description'=>'required',
            'proposal_file' => 'required'


        ]);
    if($validator->fails())
    {
        return redirect()->back()->withErrors($validator);
    }

    if($request->hasFile('proposal_file'))
    {

        $profileImage=$request->file('proposal_file');
        $profileImageSaveAsName=time()."-proposal.".
            $profileImage->getClientOriginalExtension();

        $upload_path='aset/';
        $pfile=$profileImageSaveAsName;
        $success=$profileImage->move($upload_path,$profileImageSaveAsName);
    }
    $event_id=$request->eventid_proposal;
    $company_id=$request->ptid_proposal;

    $getAssignData=DB::table('mapping_requests')

                    // ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                    ->where([['mapping_requests.req_fromevent','=',$event_id],['mapping_requests.req_fromcompany','=',$company_id]])
                    ->get();

    // dd($getAssignData);

    foreach($getAssignData as $ga)
    {
        $Assigned=$ga->req_userid;
        
    }


        $proposal=new proposal();
        
        $proposal->userid_proposal=Auth::user()->userid_tocompany;
        $proposal->ptid_proposal=$company_id;
        $proposal->eventid_proposal=$request->eventid_proposal;
        $proposal->assignid_proposal=$Assigned;
        $proposal->proposal_title=$request->proposal_title;
        $proposal->proposal_description=$request->proposal_description;
        $proposal->proposal_file=$pfile;
        $proposal->statusproposal_id=$request->statusproposal_id;
        $proposal->proposal_created_by=Auth::user()->id;
   
        $proposal->save();


        $getProposalid=$proposal->proposal_id;
        
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');

        $logMessage=Auth::user()->name." Submit Proposal at ".$currtime;
        $logCompany= new loguser();
        $logCompany->log_message=$logMessage;
        $logCompany->log_touserid=$Assigned;
        $logCompany->log_createdby=Auth::user()->id;
        $logCompany->log_fromproposal=$getProposalid;

        $logCompany->log_fromcompanyid=Auth::user()->userid_tocompany;
        $logCompany->log_createdon=$currtime;
        $logCompany->save();
    

        return back()->with('successMsg','Proposal Success Sended .');

    }
    public function viewProposal($event_id, $company_id)
    {
          
            // $getPTName=DB::table('events')
            //             ->join('users','users.id','=','events.user_id')
                      
            //             ->where('events.event_id','=',$event_id)
            //             ->get();

            $isProposal=DB::table('proposals')
                    ->where([['proposals.eventid_proposal','=',$event_id],['proposals.ptid_proposal','=',$company_id]])
                    ->get();
        //    dd($isProposal);
            // if(count($isProposal)== NULL){

            //         $propo = 1;
                
            // }
            // else{
            //         $propo = 0;

            // }

            
            
            $getAccept = DB::table('masters')->where([['prefix','=','STATUSREQUEST'],['text1','=','ACCEPT'],])->get();
                      
            foreach ($getAccept as $ga)
            {
                    $AccProposal = $ga->Master_id;
            }

            $getPTName= DB::table ('mapping_requests')
                        ->join ('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                        ->join('users','users.id','=','mapping_requests.req_userid')
                        ->where([['mapping_requests.req_fromcompany','=',$company_id],['mapping_requests.req_status','=',$AccProposal],['mapping_requests.req_fromevent','=',$event_id]])
                        ->get();
            
            $getCurrentName = DB::table('companies')
                            ->where([['companies.company_id','=',$company_id],])
                            ->get();        
             $status=DB::table('masters')->where([['prefix','=','STATUSPROPOSAL'],['text1','=','SUBMITTED'],])->get();

            

            // $kirim = "Text kiriman ";
            
            // dd($getPTName);
            // dd($isProposal);
            
            return view('ViewAddProposal',['isProposal'=>$isProposal,'getPTName'=>$getPTName,'status'=>$status,'company_id'=>$company_id,'event_id'=>$event_id,'getCurrentName'=>$getCurrentName]);


    }

    
     public function viewAllProposal()
    {
        // $user = user::all();

        
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
                    //submit
                    //ini kurangnya check data di screen saat submit proposal
        
        $getAlldataForUser=DB::table('proposals')
                    ->join('events','events.event_id','=','proposals.ptid_proposal')
                    ->join('users','users.id','=','proposals.userid_proposal')
                    ->join('masters','masters.master_id','=','proposals.statusproposal_id')
                    ->where([['proposals.statusproposal_id','=',$id_submit2],['proposals.userid_proposal','=',Auth::user()->id],])
                    ->get();//reject

      

        

        // $dummyData=DB::table('proposals')
        //             // ->join('events','events.event_id','=','proposals.ptid_proposal')
        //             ->join('events','events.event_id','=','proposals.ptid_proposal')

        //             ->join('users','users.id','=','proposals.ptid_proposal')
                    
        //             ->get();
        //             //  dd($dummyData);
        // dd($getAlldataForUser);

       //            return view('viewuser',['getAlldata'=>$getAlldata,'getAlldataForUser'=>$getAlldataForUser,'getAllApprovedPropo'=>$getAllApprovedPropo]);

        // return view('viewuser',compact('getAlldata','getAlldataForUser'));
            return view('viewuser',['getAlldata'=>$getAlldata,'getAlldataForUser'=>$getAlldataForUser]);
    }


    

    public function replyProposal($proposal_id)
    {   
            $getReject=DB::table('masters')
                    ->where([['masters.prefix','=','STATUSPROPOSAL'],['masters.text1','=','Rejected']])
                    ->get();

            $getAccept=DB::table('masters')
                    ->where([['masters.prefix','=','STATUSPROPOSAL'],['masters.text1','=','Approved']])
                    ->get();
            $getSubmit=DB::table('masters')
                    ->where([['masters.prefix','=','STATUSPROPOSAL'],['masters.text1','=','Submitted']])
                    ->get();

            foreach($getReject as $gR)
            {
                $reject = $gR->Master_id;
            
            }
            
            foreach($getAccept as $gA)
            {
                $approve = $gA->Master_id;
            
            }
              
            foreach($getSubmit as $gA)
            {
                $submit = $gA->Master_id;
            
            }
   
      
            $proposal=$proposal_id;
            
            $getProposalData=DB::table('proposals')
                    ->join('companies','companies.company_id','=','proposals.userid_proposal')
                    ->join('events','events.event_id','=','proposals.eventid_proposal')
                    ->where('proposals.proposal_id','=',$proposal_id)
                     ->get();
            // dd($getProposalData);
          $comments = DB::table('comments')
                     ->join('users', 'users.id','=','comments.user_commentid')  
                     ->where('comments.proposal_commentid','=',$proposal_id)                    
                     ->get();

         $reply = DB::table('replies')
                     ->join('comments', 'comments.cmntid','=','replies.comment_id')
                     ->join('users', 'users.id','=','replies.user_replyid')
                      ->get();
                     
        

        foreach($getProposalData as $ck){

            $checkStatus= $ck->statusproposal_id;
            $checkUser=$ck->proposal_created_by;
            $checkId=$ck->proposal_id;
            $checkAssign=$ck->assignid_proposal;
        }


            return view('detailofproposal',['getProposalData'=>$getProposalData,'submit'=>$submit,'approve'=>$approve,'reject'=>$reject,'comments'=>$comments,'reply'=>$reply,'proposal'=>$proposal,'checkUser'=>$checkUser,'checkStatus'=>$checkStatus,'checkId'=>$checkId,'checkAssign'=>$checkAssign]);


    }


    public function viewEditProposal($proposal_id)
    {
        $status=DB::table('masters')
                ->where([['prefix','=','STATUSPROPOSAL'],['text1','=','REVISION'],])->get();
        
        $viewRevision=DB::table('proposals')
                        ->join('users','users.id','=','proposals.userid_proposal')
                        ->join('events','events.event_id','=','proposals.ptid_proposal')
                        ->where('proposals.proposal_id','=',$proposal_id)
                        ->Get();
  

         return view('viewRevision',['viewRevision'=>$viewRevision]);

    

    }
    


    public function approvalProposal(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');
        switch ($request->input('action'))
        {   
            case 'Download': 

                        //masih gajelas
                            $proposal3= proposal::find($request->proposal_id);
                            $headers=[
                                'Content-Type'=>'application/pdf',
                            ];
                            $findPath=public_path()."/aset/".$proposal3->proposal_file;
                                //Mencari file dari model yang sudah dicari
                            return response()->download($findPath,$proposal3->proposal_file,$headers);

            break;

            case'Approve':

                            $status2=DB::table('masters')
                                      ->where([['prefix','=','STATUSPROPOSAL'],['text1','=','APPROVED'],])->get();
 
                          foreach($status2 as $stA)
                          {
  
                              $id_submit = $stA->Master_id;
             

                          }


                            $proposal2=proposal::find($request->proposal_id);

                            $proposal2->statusproposal_id=$id_submit;
                            $proposal2->proposal_modified_at=$currtime;
                            $proposal2->proposal_modified_by=Auth::user()->id;
                            $proposal2->save();


                            $getProposalid = $proposal2->proposal_id;
                            $company=DB::table('companies')
                                    ->where([['companies.company_id','=',Auth::user()->userid_tocompany]])
                                    ->get();
        
        
                             foreach($company as $cid)
                             {
                                 $comname=$cid->company_name;
                             }
        
        
                             date_default_timezone_set('Asia/Jakarta');
                             $currtime=date('Y-m-d H:i');
                     
                             $logMessage=Auth::user()->name."(".$comname.")"." Has Approve Your Document Contract at".$currtime;
                             $logCompany= new loguser();
                             $logCompany->log_message=$logMessage;
                            //  $logCompany->log_touserid=$Assigned;
                             $logCompany->log_createdby=Auth::user()->id;
                             $logCompany->log_fromproposal=$getProposalid;
                     
                                //  $logCompany->log_fromcompanyid=Auth::user()->userid_tocompany;
                             $logCompany->log_createdon=$currtime;
                             $logCompany->save();
                             return redirect()->action(
                                'proposalController@detaiProposalList',['proposal_id'=>$getProposalid])->with('accMsg','acc');                     break;
    
          
            case'Reject':
                        
                        $status=DB::table('masters')
                                 ->where([['prefix','=','STATUSPROPOSAL'],['text1','=','REJECTED'],])->get();

                          foreach($status as $st1)
                                {
        
                                    $id_submit = $st1->Master_id;
                   
                                }


                                 $proposal=proposal::find($request->proposal_id);

                                  $proposal->statusproposal_id=$id_submit;

                                  $proposal->proposal_modified_at=$currtime;
                                  $proposal->proposal_modified_by=Auth::user()->id;
                                  $proposal->save();

                                  $getProposalid = $proposal->proposal_id;
                                  $company=DB::table('companies')
                                          ->where([['companies.company_id','=',Auth::user()->userid_tocompany]])
                                          ->get();
                                    // dd($getProposalid);
              
                                   foreach($company as $cid)
                                   {
                                       $comname=$cid->company_name;
                                   }
              
              
                                   date_default_timezone_set('Asia/Jakarta');
                                   $currtime=date('Y-m-d H:i');
                           
                                   $logMessage=Auth::user()->name."(".$comname.")"." Has Rejected Your Document Contract at ".$currtime;
                                   $logCompany= new loguser();
                                   $logCompany->log_message=$logMessage;
                                //    $logCompany->log_touserid=Auth::user()->id;
                                   $logCompany->log_createdby=Auth::user()->id;
                                   $logCompany->log_fromproposal=$getProposalid;
                           
                                //    $logCompany->log_fromcompanyid=Auth::user()->userid_tocompany;
                                   $logCompany->log_createdon=$currtime;
                                   $logCompany->save();
                                   return redirect()->action(
                                    'proposalController@detaiProposalList',['proposal_id'=>$getProposalid])->with('rejMsg','R'); 
                                    
                                    
                                    
                                    break;


            case 'Revision':
                                 
                              $validator = Validator::make($request->all(),
                                    [
                                    
                                    
                                        'proposal_file' => 'required'


                                    ]);
                                if($validator->fails())
                                {
                                    return redirect()->back()->withErrors($validator);
                                }


                                if($request->hasFile('proposal_file'))
                                {
                            
                                    $profileImage=$request->file('proposal_file');
                                    $profileImageSaveAsName=time()."-proposal.".
                                    $profileImage->getClientOriginalExtension();
                            
                                    $upload_path='aset/';
                                    $pfile=$upload_path . $profileImageSaveAsName;
                                    $success=$profileImage->move($upload_path,$profileImageSaveAsName);
                               }
                                    $status=DB::table('masters')
                                             ->where([['prefix','=','STATUSPROPOSAL'],['text1','=','REVISION'],])
                                             ->get();


                                             foreach($status as $st1)
                                             {
                     
                                                 $id_submit = $st1->Master_id;
                                
                                             }
                                    $proposal=proposal::find($request->proposal_id);
                                    $proposal->statusproposal_id=$id_submit;
                                    // $proposal->proposal_file=$pfile;
                                    $proposal->proposal_modified_at=$currtime;
                                    $proposal->proposal_modified_by=Auth::user()->id;

                                    $proposal->save();
                                    return redirect('viewuser');
             break;


             case 'Submitted':
                                 
               $validator = Validator::make($request->all(),
                     [
                     
                     
                         'proposal_file' => 'required'


                     ]);
                 if($validator->fails())
                 {
                     return redirect()->back()->withErrors($validator);
                 }


                 if($request->hasFile('proposal_file'))
                 {
             
                     $profileImage=$request->file('proposal_file');
                     $profileImageSaveAsName=time()."-proposal.".
                     $profileImage->getClientOriginalExtension();
             
                     $upload_path='aset/';
                     $pfile=$profileImageSaveAsName;
                     $success=$profileImage->move($upload_path,$profileImageSaveAsName);
                }
                     $status=DB::table('masters')
                              ->where([['prefix','=','STATUSPROPOSAL'],['text1','=','SUBMITTED'],])
                              ->get();


                              foreach($status as $st1)
                              {
      
                                  $id_submit = $st1->Master_id;
                 
                              }
                     $proposal=proposal::find($request->proposal_id);
                     $proposal->statusproposal_id=$id_submit;
                     $proposal->proposal_file=$pfile;
                     $proposal->proposal_title=$request->proposal_title;
                     $proposal->proposal_description=$request->proposal_description;
                     $proposal->proposal_modified_at=$currtime;
                     $proposal->proposal_modified_by=Auth::user()->id;

                     $proposal->save();

                    $getProposalid = $proposal->proposal_id;
                    $company=DB::table('companies')
                            ->where([['companies.company_id','=',Auth::user()->userid_tocompany]])
                            ->get();


                     foreach($company as $cid)
                     {
                         $comname=$cid->company_name;
                     }


                     date_default_timezone_set('Asia/Jakarta');
                     $currtime=date('Y-m-d H:i');
             
                     $logMessage=Auth::user()->name."(".$comname.")"." Has Make Revision for Your Document Contract at ".$currtime;
                     $logCompany= new loguser();
                     $logCompany->log_message=$logMessage;
                    //  $logCompany->log_touserid=$Assigned;
                     $logCompany->log_createdby=Auth::user()->id;
                     $logCompany->log_fromproposal=$getProposalid;
             
                    //  $logCompany->log_fromcompanyid=Auth::user()->userid_tocompany;
                     $logCompany->log_createdon=$currtime;
                     $logCompany->save();
                     return redirect()->action(
                        'proposalController@detaiProposalList',['proposal_id'=>$getProposalid])->with('revMsg','rev');             break;


        }



    }

    public function RequestSponsor(Request $request)
        
        {
            date_default_timezone_set('Asia/Jakarta');
            $currtime=date('Y-m-d H:i');

           
             $getCurrId=event::find($request->event_id);
            
             $getCurrent = $getCurrId->event_id;
    

            
             // foreach($getCurrId as $get)
             // {
             //     $eventG = $get->event_id;
                
             // }

                
                
             $statusSubmit=DB::table('masters')->where([['prefix','=','STATUSREQUEST'],['text1','=','SUBMIT'],])->get();
             $statusRejected=DB::table('masters')->where([['prefix','=','STATUSREQUEST'],['text1','=','REJECT'],])->get();

                
                
             $getSubject=DB::table('events')
                         ->join('users','users.id','=','events.user_id')
                         
                         ->where('events.event_id','=',$getCurrent)
                         ->get();

          
            




             foreach($statusSubmit as $s) 
             { 
                     $Submit = $s->Master_id;
                
             }   
             foreach($statusRejected as $rej) 
             {
                     $reject = $rej->Master_id;
                
             }           

            
             foreach($getSubject as $g)
             {
                     $idSponsor= $g->userid_tocompany;
                        
             }

            




             $ifCurrReject=DB::table('mapping_requests')
                            ->where([['mapping_requests.req_status','=',$reject],['mapping_requests.req_fromcompany','=',Auth::User()->userid_tocompany]])
                            ->get();
            // dd($ifCurrReject);

            // $addDays=date('Y-m-d', strtotime($cannotUpload. ' + 2 days'));


            if(count($ifCurrReject)==NULL)
            {
              
                $cannotUpload=$currtime;

            }
            else{
            
            foreach($ifCurrReject as $r)
            {
                // $cannotUpload=date('Y-m-d', strtotime($currtime. ' + 2 days'));

                    $cannotUpload= $r->req_modified_at;       
            }
        }
           


            $addDays=date('Y-m-d', strtotime($cannotUpload. ' + 2 days'));
             
            if($currtime >= $cannotUpload)
            {   
                // session()->put('error', 'Please wait until '.$cannotUpload);
                // return redirect()
                //     ->back()
                //     ->withInput();

                //setNew Mapping Request

                $requestSp=new MappingRequest();
            
                $requestSp->req_sponsorid=$idSponsor;
                $requestSp->req_userid=$request->req_userid;
                $requestSp->req_fromcompany=Auth::User()->userid_tocompany;
                $requestSp->req_fromevent=$getCurrent;
                $requestSp->req_status=$Submit;
                $requestSp->req_created_at=$currtime;
                $requestSp->req_modified_by=Auth::user()->id;
                $requestSp->save();

                //set Assign User

              



            // $getEmail=DB::table('mapping_requests')
            //             ->join('companies','companies.company_id','=','mapping_requests.req_sponsorid')
            //             ->where([[''],])

            $getCurrMail = DB::table('companies')
                        ->where([['companies.company_id','=',$idSponsor],])
                        ->get();
              

            foreach($getCurrMail as $gcm)
            {
                $mailForCompany = $gcm->website_address;
            }

            foreach ($requestSp as $r)
            {
                $thisOurId=$requestSp->Mapping_Req_Id;
            }
            $getMakeRequest = DB::table('mapping_requests')
                            ->join('companies','companies.company_id','=','mapping_requests.req_sponsorid')
                            ->where([['mapping_requests.Mapping_Req_Id','=',$thisOurId],])
                            ->get();

            $getMakeRequestFrom = DB::table('companies')
                             
                                 ->where([['companies.company_id','=',Auth::user()->userid_tocompany],])
                                 ->get();


            foreach ($getMakeRequest as $Mr)    
            {
                $req=$Mr->company_name;
                
            }

            foreach ($getMakeRequestFrom as $Fr)
            {
                $From=$Fr->company_name;
                
            }
           

               Mail::to($mailForCompany)->send(new appEmail($req,$From));
                
               
                return back()->with('successAdd','Success edit company .');
   
            }else{
            
            
             return redirect()->back()->with(['CannotAdd'=>'You can request at '.$cannotUpload]);

            }
        }



        
    public function viewOurAssign()
    {
       
            $listMyPropo= DB::table('proposals')
                        ->join('companies','companies.company_id','=','proposals.ptid_proposal')
                        ->join('events','events.event_id','=','proposals.eventid_proposal')
                        ->join('users','users.id','=','proposals.assignid_proposal')
                        ->join('masters','masters.master_id','=','proposals.statusproposal_id')
                        ->where([['proposals.ptid_proposal','=',auth::user()->userid_tocompany]])
                        ->orwhere([['proposals.userid_proposal','=',auth::user()->userid_tocompany]])
                        ->paginate(8);
            


            
           

                    
            
            return view('ourAssign',['listMyPropo'=>$listMyPropo]);
    
}

    public function detailOurAssign($proposal_id)
    
     {   

         $detailProposal= DB::table('proposals')
                        ->join('companies','companies.company_id','=','proposals.ptid_proposal')
                        ->join('events','events.event_id','=','proposals.eventid_proposal')
                        ->join('users','users.id','=','proposals.assignid_proposal')
                        ->join('masters','masters.master_id','=','proposals.statusproposal_id')
                        ->join('positions','positions.id_position','=','users.position_id')
                        ->where([['proposals.proposal_id','=',$proposal_id]])
                        ->get();
        $logProposal = DB::table('logusers')
                       ->join('users','users.id','=','logusers.log_touserid')
                       ->join('proposals','proposals.proposal_id','=','logusers.log_fromproposal')
                       ->where([['proposals.proposal_id','=',$proposal_id]])
                        ->get();
        //  $getAvailable=DB::table('proposals')
        //                 ->join('users','users.id','=','proposals.assignid_proposal')
        //                 ->where([['proposals.proposal_isend','=',TRUE]])
        //                 ->groupBy('assignid_proposal')
        //                 ->get();
            // dd($getAvailable);
        $getAssign=DB::table('users')
                    ->join('positions','positions.id_position','=','users.position_id')
                    ->where([['users.userid_tocompany','=',Auth::user()->userid_tocompany],['positions.position','!=','admin']])
                    ->get();
        $getPosition=DB::table('positions')
                    ->where([['positions.position','=','admin']])
                    ->get();
                    

        foreach($getPosition as $gp)
        {
            $admin= $gp->id_position;
        }



                        return view('detailOurAssign',['detailProposal'=>$detailProposal,'logProposal'=>$logProposal,'getAssign'=>$getAssign,'admin'=>$admin]);
     }



     public function viewMyAssignList(){


           

            $myAssignList= DB::table('proposals')
                        ->join('companies','companies.company_id','=','proposals.ptid_proposal')
                        ->join('events','events.event_id','=','proposals.eventid_proposal')
                        ->join('users','users.id','=','proposals.assignid_proposal')
                        ->join('masters','masters.master_id','=','proposals.statusproposal_id')
                        ->where([['proposals.assignid_proposal','=',auth::user()->id]])
                        ->orwhere([['proposals.userid_proposal','=',auth::user()->userid_tocompany]])
                        ->paginate(8);
       

            

                    
            
            return view('viewMyAssignList',['myAssignList'=>$myAssignList]);

     }

     
    public function detaiProposalList($proposal_id)
    
    {   

        $getStatusReject=DB::table('masters')
                    ->where([['masters.text1','=','REJECTED'],['masters.prefix','=','STATUSPROPOSAL']])
                    ->get();
        $getStatusRevision=DB::table('masters')
                    ->where([['masters.text1','=','REVISION'],['masters.prefix','=','STATUSPROPOSAL']])
                    ->get();

        $detailProposal= DB::table('proposals')
                       ->join('companies','companies.company_id','=','proposals.ptid_proposal')
                       ->join('events','events.event_id','=','proposals.eventid_proposal')
                       ->join('users','users.id','=','proposals.proposal_created_by')
                       ->join('masters','masters.master_id','=','proposals.statusproposal_id')
                       ->join('positions','positions.id_position','=','users.position_id')
                       ->where([['proposals.proposal_id','=',$proposal_id]])
                       ->get();
       $logProposal = DB::table('logusers')
                      ->join('users','users.id','=','logusers.log_createdby')
                      ->where([['logusers.log_fromproposal','=',$proposal_id]])
                       ->get();
         $getAssign=DB::table('users')
                       ->join('positions','positions.id_position','=','users.position_id')
                       ->where([['users.userid_tocompany','=',Auth::user()->userid_tocompany],['positions.position','!=','admin']])
                       ->get();
       //  $getAvailable=DB::table('proposals')
       //                 ->join('users','users.id','=','proposals.assignid_proposal')
       //                 ->where([['proposals.proposal_isend','=',TRUE]])
       //                 ->groupBy('assignid_proposal')
       //                 ->get();
           // dd($getAvailable);
    //    $getAssign=DB::table('users')
    //                ->where([['users.userid_tocompany','=',Auth::user()->userid_tocompany]])
    //                ->get();

         $getPosition=DB::table('positions')
                 ->where([['positions.position','=','admin']])
                 ->get();

      foreach($getPosition as $gp)
      {
             $admin= $gp->id_position;
      }

      foreach($getStatusReject as  $gj){
            $reject=$gj->Master_id;
      }


      foreach($getStatusRevision as  $gr){
        $revision=$gr->Master_id;
    }

        return view('detailMyAssignList',['detailProposal'=>$detailProposal,'logProposal'=>$logProposal,'getAssign'=>$getAssign,'admin'=>$admin,'revision'=>$revision,'reject'=>$reject]);
    }




     public function changePIC(Request $request)
     {
          $currentId = $request->proposal_id;

                         
        // $getAvailable=DB::table('proposals')
        //             -join('users','users.id','=','proposals.assignid_proposal')
        //             ->where([['proposals.poposal_isend','=',TRUE]])
        //             ->groupBy('users.id')
        
        $changePIC= proposal::find($request->proposal_id);

        $changePIC->assignid_proposal=$request->assignid_proposal;

        $changePIC->save();

        return back()->with('successAdd','Proposal Success Sended .');
        
        


     }


        

    



}
