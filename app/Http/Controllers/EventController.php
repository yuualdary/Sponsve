<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\event;
use App\User;
use App\comment;
use App\reply;
use App\categories;
use Validator;
use Redirect;
use Auth;
use File;
use App\catevent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Rules\dateValidation;


class EventController extends Controller
{
    //tampilan untuk UI
    

    public function toFormEvent()
    {
        $category = categories::all();
        return view('input',['category'=>$category]);
    }


    public function viewMyEvent()
    {
       
            $ins = event::paginate(8);
            $event=DB::table('events')
                    ->join('users','users.id',"=",'events.user_id')
                    ->where([['users.id','=',Auth::user()->id]])
                    ->paginate(9);
                    $categoryForEvent = DB::table('catevents')
                    ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
                    ->get();
                    
            
                    return view('myEvent',['event'=>$event,'ins'=>$ins,'categoryForEvent'=>$categoryForEvent]);
    
    }

    public function searchEvent(Request $request){

        switch ($request->input('action'))
            {
                case'name':
                    $ins = event::paginate(8);

                    $search = $request->search;
                    $data=$request->all();
                    $event=DB::table('events')
                            ->join('users','users.id',"=",'events.user_id')
                            ->where([['events.title','LIKE',"%".$search."%"]])
                            ->paginate(9);
                    $categoryForEvent = DB::table('catevents')
                            ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
                            ->get();
                
                    
                    return view('shop',['data'=>$data,'event'=>$event,'ins'=>$ins,'categoryForEvent'=>$categoryForEvent]);
                break;


                case'month':
                     $ins = event::paginate(8);
                    
                     $search = $request->search;
                     $data=$request->all();

                     $event=DB::table('events')
                             ->join('users','users.id',"=",'events.user_id')
                             ->whereMonth('events.event_end','=',$search)
                             ->paginate(9);
                     $categoryForEvent = DB::table('catevents')
                             ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
                             ->get();
                    
                    
                        return view('shop',['data'=>$data,'event'=>$event,'ins'=>$ins,'categoryForEvent'=>$categoryForEvent]);
                 break;
            }   
    }


    

    public function view(Request $request)
    {
        $ins = event::paginate(8);


        //view dengan tampilan 8 perhalaman yang menggunakan paginate dan compact yang berfungsi sebagai defined variable agar bisa digunakan pada view
        if($user = Auth::user())
        {
            $ins = event::paginate(8);
            $event=DB::table('events')
                    ->join('users','users.id',"=",'events.user_id')
                    ->orderBy('events.event_start','ASC')
                    ->paginate(9);
            $categoryForEvent = DB::table('catevents')
                    ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
                    ->get();
                    
            $data=$request->all();

                    return view('shop',['data'=>$data,'event'=>$event,'ins'=>$ins,'categoryForEvent'=>$categoryForEvent]);
            
        }
        else
        {
        $ins = event::paginate(8);
        $event=DB::table('events')
                ->join('users','users.id',"=",'events.user_id')
                ->join('categories','categories.category_id','=','events.category')
                ->orderBy('events.event_start','ASC')

                ->paginate(9);
        $categoryForEvent = DB::table('catevents')
                ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
                ->get();
               
        $data=$request->all();


                 return view('shop',['data'=>$data,'event'=>$event,'ins'=>$ins,'categoryForEvent'=>$categoryForEvent]);
        }
      
    }


    public function companyEvent(Request $request){


        $data=$request->all();
        $event=DB::table('events')
                ->join('users','users.id',"=",'events.user_id')
                ->where([['events.event_company','=',Auth::user()->userid_tocompany]])
                ->paginate(9);
        $categoryForEvent = DB::table('catevents')
                ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
                ->get();
                
        
                return view('shop',['event'=>$event,'data'=>$data,'categoryForEvent'=>$categoryForEvent]);

    }
    public function UI()
    {
        
    date_default_timezone_set('Asia/Jakarta');
    $currtime=date('Y-m-d');

    // $upcomingDate=date('Y-m-d', strtotime($currtime. ' + 30 days')); 

        if($user = Auth::user())
        {
            $event=DB::table('events')
                    ->join('users','users.id',"=",'events.user_id')
                    ->where([['events.event_end','>=',$currtime],])
                    ->orderBy('events.event_end','ASC')
                    ->take(3)
                    ->get();
              $categoryForEvent = DB::table('catevents')
                    ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
                    ->get();
                    
            
                    return view('UI',['event'=>$event,'categoryForEvent'=>$categoryForEvent]);
         
            }
        else
        {
        
            $event=DB::table('events')
            ->join('users','users.id',"=",'events.user_id')
            ->where([['events.event_end','>=',$currtime],])
            ->orderBy('events.event_end','ASC')

            ->take(3)
            ->get();
      $categoryForEvent = DB::table('catevents')
            ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
            ->get();



                
        return view('UI',['event'=>$event,'categoryForEvent'=>$categoryForEvent]);
        }

    }
  
    
    public function downloadFile(Request $request)
    {
        $propoFile= event::find($request->event_id);
       
        $fileType=[
            'Content-Type'=>'application/pdf',
        ];
        $findPath=public_path()."/aset/".$propoFile->propo;
            //Mencari file dari model yang sudah dicari
        return response()->download($findPath,$propoFile->propo,$fileType);
        
    }

    public function search(Request $request)
    {
        //fungsi search
        $event = event::where('title','LIKE','%'.$request->search.'%')->paginate(1);
        return view('shop',compact('event'));
    }

    public function detail($event_id)
    {
        $getStatus= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Accept']])
                    ->get();   
                    
        foreach($getStatus as $s)
        {
                $Acc = $s->Master_id;
        }

        $getStatus2= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Submit']])
                     ->get();   
        
        foreach($getStatus2 as $s2)
        {
            $Pen = $s2->Master_id;
        }
        
        $getStatus3= DB::table('masters')->where([['masters.prefix','=','STATUSREQUEST'],['masters.text1','=','Done']])
                     ->get();
        foreach($getStatus3 as $s3)
         {
             $Done = $s3->Master_id;
         }
                     
        //  dd($Done);

        //fungsi detail pada view imagedetail yang mana menggunakan table event,comment,dan replies,user agar variable bisa defined
          $event = event::find($event_id);
          $comments = DB::table('comments')
                        ->join('events', 'events.event_id','=','comments.item_id')
                        ->join('users', 'users.id','=','comments.user_commentid')
                        ->join('positions','positions.id_position','=','users.position_id')
                        ->join('companies','companies.company_id','=','users.userid_tocompany')
                        ->where('comments.item_id','=',$event_id)                    
                        ->paginate(10);

            $reply = DB::table('replies')
                        ->join('comments', 'comments.cmntid','=','replies.comment_id')
                        ->join('users', 'users.id','=','replies.user_replyid')
                        ->join('positions','positions.id_position','=','users.position_id')
                        ->join('companies','companies.company_id','=','users.userid_tocompany')
                         ->get();
          
            $getUsers = DB::table('users')
                        ->leftjoin('events','events.user_id','=','users.id')
                        ->join('positions','positions.id_position','=','users.position_id')
                        ->join('companies','companies.company_id','=','users.userid_tocompany')
                        ->where('events.event_id','=',$event_id)
                        ->get();
            $categoryForEvent = DB::table('catevents')
                                ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
                                ->where([['catevents.catevent_toevent','=',$event_id],])
                                ->get();
                            
 
            //

    //jangn lupa isi position id, kalau gada joinnyannya kaga bisa


        $listMember = DB::table('mapping_requests')
                        ->join('users','users.id','=','mapping_requests.req_userid')
                        ->join('events','events.event_id','=','mapping_requests.req_fromevent')

                        ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                        ->join('masters','masters.Master_id','=','mapping_requests.req_status')
                        
                        ->where([['mapping_requests.req_fromevent','=',$event_id],['mapping_requests.req_status','=',$Acc],])
                        ->orwhere([['mapping_requests.req_fromevent','=',$event_id],['mapping_requests.req_status','=',$Done],])
                        ->get();
     

        // dd($listMember);
        
        $getChatUser=DB::table('companies')
                    ->join('chats','chats.from_chat_userid','=','companies.company_id')
                    ->join('users','users.userid_tocompany','=','companies.company_id') 
                    
                    ->get();
        $getReview=DB::table('reviews')
                   ->join('events','events.event_id','=','reviews.review_event')
                   ->where([['events.event_id','=',$event_id],])
                  

                   ->get()
                   ->sum('review_rating');
        $viewReview=DB::table('reviews')
                    ->join('events','events.event_id','=','reviews.review_event')
                    ->join('companies','companies.company_id','=','reviews.review_companyid')
                    ->join('users','users.id','=','reviews.review_createdby')
                    ->where([['reviews.review_event','=',$event_id]])
                    ->paginate(5);

     $getCount=DB::table('reviews')
                   ->join('events','events.event_id','=','reviews.review_event')
                   ->where([['events.event_id','=',$event_id],])
                   ->get();
    //  $setRating = substr($getReview/count($getCount)/2/10,0,3);

    if($getReview == NULL){
        $setRating = 0;
    }
    else{
      
        $setRating = substr($getReview/count($getCount)/2/10,0,3);
   
    }



    date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d');

    //  dd($setRating);

        if($user = Auth::user()){
                
                 $checkCurrent = DB::table('mapping_requests')
                                ->join('users','users.id','=','mapping_requests.req_userid')
                                ->join('events','events.event_id','=','mapping_requests.req_fromevent')
                
                                ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                                ->join('masters','masters.Master_id','=','mapping_requests.req_status')
                
                                ->where([['mapping_requests.req_fromevent','=',$event_id],['mapping_requests.req_fromcompany','=',Auth::user()->userid_tocompany]])
                
                                ->get(); 
                // foreach($comments as $cmmt){
                //     $tesJson = $cmmt;
                // }
                    
        $getAssign=DB::table('users')
                  ->join('positions','positions.id_position','=','users.position_id')
                  ->where([['users.userid_tocompany','=',Auth::user()->userid_tocompany],['positions.position','!=','admin']])
                  ->get();  

        $viewReview=DB::table('reviews')
                  ->join('events','events.event_id','=','reviews.review_event')
                  ->join('companies','companies.company_id','=','reviews.review_companyid')
                  ->join('users','users.id','=','reviews.review_createdby')
                  ->where([['reviews.review_event','=',$event_id]])
                  ->paginate(5);
                
                
                if(count($checkCurrent) !=NULL){
                             foreach($checkCurrent as $c)
                             {
                                 $check = $c->req_status;
                             }
                                }                
                             else
                             {
                                 $check = 0;
                             }
                 
                          } else {


                                $getAssign=NULL;

                          }              
    if($user = Auth::user()){

        return view('detailimage',['currtime'=>$currtime,'event'=>$event,'comments'=>$comments,'reply'=>$reply,'getUsers'=>$getUsers,'listMember'=>$listMember,'Acc'=>$Acc,'check'=>$check,'Pen'=>$Pen,'getChatUser'=>$getChatUser,'setRating'=>$setRating,'getAssign'=>$getAssign,'categoryForEvent'=>$categoryForEvent,'viewReview'=>$viewReview]);
//         return response()->json([
// $tesJson
//                 ]);
    } else{
        
         return view('detailimage',['event'=>$event,'comments'=>$comments,'reply'=>$reply,'getUsers'=>$getUsers,'listMember'=>$listMember,'Acc'=>$Acc,'Pen'=>$Pen,'setRating'=>$setRating,'getAssign'=>$getAssign,'categoryForEvent'=>$categoryForEvent,'viewReview'=>$viewReview]);
    }
    }

    public function formEditEvent($event_id)
    {
        //update dengan fungsi find yang mana update yang berdasarkan id

       

   

        $getdataCurrent=DB::table('events')
                        ->where([['events.event_id','=',$event_id]])
                        ->get();
                        // dd($getdataCurrent);

         $category= DB::table('catevents')
                        ->join('categories','categories.category_id','=','catevents.catevent_tocategory')
                        ->where([['catevents.catevent_toevent','=',$event_id],])
                        ->get();


        $list = DB::table('categories')
                ->get();
        // $test=explode(",",$category->catevent_tocategory);
        // $test=json_decode($category->catevent_tocategory);
        // dd($category);

        foreach($category as $cat){

            $id[]=$cat->catevent_tocategory;        
        }
        $list2 = DB::table('categories')
              ->whereIn('categories.category_id',$id)
              ->get();
        $cat=categories::all();
               
        return view('updateEvent',['getdataCurrent'=>$getdataCurrent,'category'=>$category,'cat'=>$cat,'list2'=>$list2]);
    }

    public function editEvent(Request $request)
    {
             
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');

        $event = event::find($request->event_id);

        $start=$request->event_start;
        $end=$request->event_end;

        $validator = $request->validate(
            [
                'event_start'=>['required', new dateValidation($start,$end)],
                'event_end'=>['required', new dateValidation($start,$end)],


               

            
            ]);
    
        $event->user_id=$request->user_id;

        $event->title = $request->title;
        $event->caption=$request->caption;
        $event->location=$request->location;

     
        if($request->hasFile('photo'))

        {



            $deleteImage = DB::table('events')
            ->where([['events.event_id','=',$request->event_id]])
            ->get();

            foreach($deleteImage as $dI){
            
            $path = $dI->photo;
            
            }


            file::delete($path);



            $profileImage=$request->file('photo');
            $profileImageSaveAsName=time()."-event.".
            $profileImage->getClientOriginalExtension();

            $upload_path='aset/';
            $filename=$upload_path . $profileImageSaveAsName;
            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
            $event->photo = $filename;

        }


        if($request->hasFile('propo'))
        {

            $profileImage=$request->file('propo');
            $profileImageSaveAsName=time()."-propoevent.".
                $profileImage->getClientOriginalExtension();

            $upload_path='aset/';
            $filepropo=$profileImageSaveAsName;
            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
            $event->propo = $filepropo;
            //ada error ketika upload file, kudu buat animasi saat upload agar memberi tahu kalau file sedang diupload, karena tidak kelihatan uploadnya jadi bisa error ketika upload file
            
        }
  


        $event->category=$request->category;
        $event->event_start=$request->event_start;

        $event->event_end=$request->event_end;
        $event->event_modified_at=$currtime;
        $event->event_modified_by=Auth::user()->id;


        $category = DB::table('catevents')
        ->where([['catevents.catevent_toevent','=',$request->event_id],])
        ->delete();
        
     

        $checklist = $_POST['catevent_tocategory'];
        $countcheck = count($checklist);

        // foreach($category as $currCat){


        //         $currentCheck[]=$currCat->catevent_tocategory;

        // }


        // $list = DB::table('catevents')
        //       ->where([['catevents.catevent_toevent','=',$request->event_id],])

        //       ->whereIn('catevents.catevent_tocategory',$currentCheck)
        //       ->get();

        // dd($list);
        
        foreach ($request->catevent_tocategory as $cat){


            $catevent = new catevent();
            $catevent->catevent_toevent = $request->event_id;
        
      

            $catevent->catevent_tocategory = $cat;


            $catevent->save();  

        }


        $event->save();

     
   

             $id=$request->event_id;

        // return view('detailimage/','$request->event_id',['event'=>$event])->with('successEdit');
   
        return redirect()->action(
            'EventController@detail',['event_id'=>$id] 
        )->with('successEdit','success');
    }


    public function createEvent(Request $request)
    {
        //event product yang ingin dimasukkin
        // $validator = Validator::make($request->all(),
        //     [
        //         'title' => 'required',
        //         'caption' => 'required',
        //         'photo' => 'required|mimes:jpeg,bmp,png',
        //         'location'=>'required',
        //         'event_end'=>'required',
        //         'category'=>'required'

        //     ]);
        // if($validator->fails())
        // {
        //     return redirect()->back()->withErrors($validator);
        // }

        $start=$request->event_start;
        $end=$request->event_end;

        $validator = $request->validate(
            [
                'event_start'=>['required', new dateValidation($start,$end)],
                'event_end'=>['required', new dateValidation($start,$end)],


               

            
            ]);
     


        if($request->hasFile('photo'))
        {

            $profileImage=$request->file('photo');
            $profileImageSaveAsName=time()."-event.".
                $profileImage->getClientOriginalExtension();

            $upload_path='aset/';
            $filename=$upload_path . $profileImageSaveAsName;
            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
        }
        
        if($request->hasFile('propo'))
        {

            $profileImage=$request->file('propo');
            $profileImageSaveAsName=time()."-propoevent.".
                $profileImage->getClientOriginalExtension();

            $upload_path='aset/';
            $filepropo=$profileImageSaveAsName;
            $success=$profileImage->move($upload_path,$profileImageSaveAsName);
        }

        $event = new event();
        $event->user_id = Auth::user()->id;
        $event->title = $request->title;
        $event->caption = $request->caption;
        $event->photo = $filename;
        $event->event_start=$request->event_start;

        $event->event_end=$request->event_end;
        $event->event_company=Auth::user()->userid_tocompany;

        $event->location=$request->location;
        $event->category=$request->category;
        $event->propo = $filepropo;

       
        $event->save();

        $coba=$event->event_id;
     
        $checklist = $_POST['catevent_tocategory'];
        
        $countcheck = count($checklist);

    foreach ($request->catevent_tocategory as $cat)
    {

        $catevent = new catevent();
        $catevent->catevent_toevent = $coba;
       
  
        
        $catevent->catevent_tocategory = $cat;
        
        
        $catevent->save();  

    }

        // $check=0;
        // for ($check=0; $check<$countcheck;$check++){

            
        // $data= array($checklist);
        // list($checklist) = $data;
        //     $cb=$request->catevent_tocategory;
        //     // $test=implode(",",$data);
        //     dd($cb);
        //     $catevent = new catevent();
        //     $catevent->catevent_toevent = $coba;
           
      
            
        //     $catevent->catevent_tocategory = $test;
            
            
        //     $catevent->save();  

        
        // dd($countcheck);

        // $catevent = new catevent();
        // $catevent->catevent_event = $event;
        // $catevent->catevent_category = $request->catevent_category;
        // $catevent->save();  

        return redirect('/view');
    }


    public function deleteEvent($event_id){


        $deleteReplies=DB::table('replies')
                    ->join('comments','comments.cmntid','=','replies.comment_id')
                    ->where([['comments.item_id','=',$event_id]]) 
                    ->delete();

        $deleteComment=DB::table('comments')
                    ->where([['comments.item_id','=',$event_id]]) 
                    ->delete();           
        $deleteReview=DB::table('reviews')
                    ->where([['reviews.review_event','=',$event_id]])
                    ->delete();
                        
        $deleteMapping=DB::table('mapping_requests')
                        ->where([['mapping_requests.req_fromevent','=',$event_id]])
                        ->delete();
        
        $deleteProposal = DB::table('proposals')
                            ->where([['proposals.eventid_proposal','=',$event_id]])
                            ->delete();
        
        $deleteCategory = DB::table('catevents')
                            ->where([['catevents.catevent_toevent','=',$event_id]])
                            ->delete();
        $deleteImage = DB::table('events')
                        ->where([['events.event_id','=',$event_id]])
                        ->get();
        
        foreach($deleteImage as $dI){

            $path = $dI->photo;

        }

        file::delete($path);


        $deleteEvent = DB::table('events')
                     ->where([['events.event_id','=',$event_id]])
                     ->delete();
                     return redirect('/view');


    }
}

    
// public function AjaxCoba()


// {

//      echo "halo";
//     echo $_GET["testid"];
//     $test=$_REQUEST["testid"];
//     $getChatUser=DB::table('companies')
//     // ->join('chats','chats.from_chat_userid','=','companies.company_id')
//     // ->join('users','users.userid_tocompany','=','companies.company_id') 
//     ->where(['companies.company_id','=',$test])
    
//     ->get();

   


//     return back()->with(['getChatUser'=>$getChatUser]);
    



// }





