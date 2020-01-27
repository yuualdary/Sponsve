<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\insert;
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
        $proposal->proposal_title=$request->proposal_title;
        $proposal->proposal_description=$request->proposal_description;
        $proposal->proposal_file=$pfile;
        $proposal->statusproposal_id=$request->statusproposal_id;
   
        $proposal->save();
    

        return back()->with('successMsg','Proposal Success Sended .');

    }
    public function viewProposal($insert_id)
    {
          
            $getPTName=DB::table('inserts')
                        ->join('users','users.id','=','inserts.user_id')
                        ->where('inserts.insert_id','=',$insert_id)
                        ->get();

             $status=DB::table('masters')->where([['prefix','=','STATUSPROPOSAL'],['text1','=','SUBMITTED'],])->get();

            
          

            // $kirim = "Text kiriman ";
            
            // dd($getPTName);
            
            return view('ViewAddProposal',['getPTName'=>$getPTName,'status'=>$status]);


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
                    ->join('inserts','inserts.insert_id','=','proposals.ptid_proposal')
                    ->join('users','users.id','=','proposals.userid_proposal')
                    ->join('masters','masters.master_id','=','proposals.statusproposal_id')
                    ->where([['proposals.statusproposal_id','=',$id_submit],['proposals.ptid_proposal','=',Auth::user()->id],])
                    ->get();
                    //ini kurangnya check data di screen saat submit proposal
        
        $getAlldataForUser=DB::table('proposals')
                    ->join('inserts','inserts.insert_id','=','proposals.ptid_proposal')
                    ->join('users','users.id','=','proposals.userid_proposal')
                    ->join('masters','masters.master_id','=','proposals.statusproposal_id')
                    ->where([['proposals.statusproposal_id','=',$id_submit2],['proposals.userid_proposal','=',Auth::user()->id],])
                    ->get();

      

        

        // $dummyData=DB::table('proposals')
        //             // ->join('inserts','inserts.insert_id','=','proposals.ptid_proposal')
        //             ->join('inserts','inserts.insert_id','=','proposals.ptid_proposal')

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

    // dd($status);

            $getProposalData=DB::table('proposals')
                    ->join('users','users.id','=','proposals.userid_proposal')
                    ->join('inserts','inserts.insert_id','=','proposals.ptid_proposal')
                    ->where('proposals.proposal_id','=',$proposal_id)
                     ->Get();

        // dd($getProposalData);
            return view('detailofproposal',['getProposalData'=>$getProposalData,'status'=>$status,'status2'=>$status2]);


    }

    public function viewEditProposal($proposal_id)
    {
        $status=DB::table('masters')
                ->where([['prefix','=','STATUSPROPOSAL'],['text1','=','REVISION'],])->get();
        
        $viewRevision=DB::table('proposals')
                        ->join('users','users.id','=','proposals.userid_proposal')
                        ->join('inserts','inserts.insert_id','=','proposals.ptid_proposal')
                        ->where('proposals.proposal_id','=',$proposal_id)
                        ->Get();
  

         return view('viewRevision',['viewRevision'=>$viewRevision,'status'=>$status]);

    

    }


    public function rejectProposal(Request $request)
    {
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

                                    $proposal->save();
                                    return redirect('viewuser');
             break;


        }



    }

    public function RequestSponsor(Request $request)
    {
        $getCurrId=insert::find($request->insert_id);

        $getCurrent = $getCurrId->insert_id;

        // foreach($getCurrId as $get)
        // {
        //     $insertG = $get->insert_id;

        // }

    
        
        $status=DB::table('masters')->where([['prefix','=','STATUSPROPOSAL'],['text1','=','SUBMITTED'],])->get();


        $getSubject=DB::table('inserts')
                    ->join('users','users.id','=','inserts.user_id')
                    ->where('inserts.insert_id','=',$getCurrent)
                    ->get();
        foreach($status as $s) 
        {
                $Submit = $s->Master_id;

        }           

        foreach($getSubject as $g)
        {
                $idSponsor= $g->userid_tocompany;
                

        }
        

        $requestSp=new MappingRequest();

        $requestSp->req_sponsorid=$idSponsor;
        $requestSp->req_userid=Auth::User()->id;
        $requestSp->req_fromcompany=Auth::User()->userid_tocompany;
        $requestSp->req_status=$Submit;
        $requestSp->save();


        return back()->with('successAdd','Success edit company .');
    }


        

    



}
