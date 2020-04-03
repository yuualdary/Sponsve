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
use App\MappingRequest;
use App\Mail\appEmail;
use App\sendMakeRequest;
use Illuminate\Support\Facades\Mail;

class proposalController extends Controller
{
    //



    public function addProposal(Request $request)
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


        $proposal=new proposal();
        
        $proposal->userid_proposal=$request->userid_proposal;
        $proposal->ptid_proposal=$request->ptid_proposal;
        $proposal->eventid_proposal=$request->eventid_proposal;

        $proposal->proposal_title=$request->proposal_title;
        $proposal->proposal_description=$request->proposal_description;
        $proposal->proposal_file=$pfile;
        $proposal->statusproposal_id=$request->statusproposal_id;
   
        $proposal->save();
    

        return back()->with('successMsg','Proposal Success Sended .');

    }
    public function viewProposal($event_id, $company_id)
    {
          
            // $getPTName=DB::table('events')
            //             ->join('users','users.id','=','events.user_id')
                      
            //             ->where('events.event_id','=',$event_id)
            //             ->get();

            $getAccept = DB::table('masters')->where([['prefix','=','STATUSREQUEST'],['text1','=','ACCEPT'],])->get();
                      
            foreach ($getAccept as $ga)
            {
                    $AccProposal = $ga->Master_id;
            }

            $getPTName= DB::table ('mapping_requests')
                        ->join ('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                        ->join('users','users.id','=','mapping_requests.req_userid')
                        ->where([['mapping_requests.req_fromcompany','=',$company_id],['mapping_requests.req_status','=',$AccProposal]])
                        ->get();
            

             $status=DB::table('masters')->where([['prefix','=','STATUSPROPOSAL'],['text1','=','SUBMITTED'],])->get();

            
          

            // $kirim = "Text kiriman ";
            
            // dd($getPTName);
            
            return view('ViewAddProposal',['getPTName'=>$getPTName,'status'=>$status,'company_id'=>$company_id,'event_id'=>$event_id]);


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
   
   
            $status=DB::table('masters')->where([['prefix','=','STATUSPROPOSAL'],['text1','=','REJECTED'],])->get();
            $status2=DB::table('masters')->where([['prefix','=','STATUSPROPOSAL'],['text1','=','APPROVED'],])->get();


            $getProposalData=DB::table('proposals')
                    ->join('users','users.id','=','proposals.userid_proposal')
                    ->join('events','events.event_id','=','proposals.ptid_proposal')
                    ->where('proposals.proposal_id','=',$proposal_id)
                     ->Get();

         dd($getProposalData);
            return view('detailofproposal',['getProposalData'=>$getProposalData,'status'=>$status,'status2'=>$status2]);


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
  

         return view('viewRevision',['viewRevision'=>$viewRevision,'status'=>$status]);

    

    }


    public function rejectProposal(Request $request)
    {
        // date_default_timezone_set('Asia/Jakarta');
        // $currtime=date('Y-m-d H:i');
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

                                      
                          foreach($status as $st1)
                          {
  
                              $id_submit = $st1->Master_id;
             
                          }
                            $proposal2=proposal::find($request->proposal_id);

                            $proposal2->statusproposal_id=$id_submit;
                            $proposal2->proposal_modified_at=$currtime;
                            $proposal2->proposal_modified_by=Auth::user()->id;
                            $proposal2->save();
                            return redirect('viewuser');
    
            break;

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
                                  return redirect('viewuser');

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
                                        

                                    $proposal=proposal::find($request->proposal_id);
                                    $proposal->statusproposal_id=$request->statusproposal_id;
                                    $proposal->proposal_file=$pfile;
                                    $proposal->proposal_modified_at=$currtime;
                                    $proposal->proposal_modified_by=Auth::user()->id;

                                    $proposal->save();
                                    return redirect('viewuser');
             break;


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
              
                // $cannotUpload= $currtime;       
                $addDays=date('Y-m-d', strtotime($cannotUpload. ' + 2 days'));


            }
            else{
            
            foreach($ifCurrReject as $r)
            {
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


        

    



}
