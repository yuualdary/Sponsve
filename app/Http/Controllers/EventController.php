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

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
class EventController extends Controller
{
    //tampilan untuk UI
    

    public function view()
    {
        //view dengan tampilan 8 perhalaman yang menggunakan paginate dan compact yang berfungsi sebagai defined variable agar bisa digunakan pada view
        if($user = Auth::user())
        {
            $ins = event::paginate(8);
            $event=DB::table('events')
                    ->join('users','users.id',"=",'events.user_id')
                    ->join('categories','categories.category_id','=','events.category')
                    ->get();
                    
            return view('shop',compact('event','ins'));
            
        }
        else
        {
        $ins = event::paginate(8);
        $event=DB::table('events')
                ->join('users','users.id',"=",'events.user_id')
                ->join('categories','categories.category_id','=','events.category')
                ->get();
                
        return view('shop',compact('event','ins'));
        }
      
    }

    public function UI()
    {
        return view('UI');

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

        //fungsi detail pada view imagedetail yang mana menggunakan table event,comment,dan replies,user agar variable bisa defined
          $event = event::find($event_id);
          $comments = DB::table('comments')
                        ->join('events', 'events.event_id','=','comments.item_id')
                        ->join('users', 'users.id','=','comments.user_commentid')
                        ->where('comments.item_id','=',$event_id)                    
                        ->get();

            $reply = DB::table('replies')
                        ->join('comments', 'comments.cmntid','=','replies.comment_id')
                        ->join('users', 'users.id','=','replies.user_replyid')
                         ->get();
          
            $getUsers = DB::table('users')
                        ->leftjoin('events','events.user_id','=','users.id')
                        ->join('categories','categories.category_id','=','events.category')
                        ->join('positions','positions.id_position','=','users.position_id')
                        
                        ->where('events.event_id','=',$event_id)
                        ->get();

            $getAssign=DB::table('users')
                        ->where([['users.userid_tocompany','=',Auth::user()->userid_tocompany]])
                        ->get();   
            //

    //jangn lupa isi position id, kalau gada joinnyannya kaga bisa


        $listMember = DB::table('mapping_requests')
                        ->join('users','users.id','=','mapping_requests.req_userid')
                        ->join('events','events.event_id','=','mapping_requests.req_fromevent')

                        ->join('companies','companies.company_id','=','mapping_requests.req_fromcompany')
                        ->join('masters','masters.Master_id','=','mapping_requests.req_status')
                        
                        ->where([['mapping_requests.req_fromevent','=',$event_id],['mapping_requests.req_status','=',$Acc]])
                        ->get();
     

        
        $getChatUser=DB::table('companies')
                    ->join('chats','chats.from_chat_userid','=','companies.company_id')
                    ->join('users','users.userid_tocompany','=','companies.company_id') 
                    
                    ->get();
        $getReview=DB::table('reviews')
                   ->join('events','events.event_id','=','reviews.review_event')
                   ->where([['events.event_id','=',$event_id],])
                  

                   ->get()
                   ->sum('review_rating');

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
                 
                          }               
    if($user = Auth::user()){

        return view('detailimage',['event'=>$event,'comments'=>$comments,'reply'=>$reply,'getUsers'=>$getUsers,'listMember'=>$listMember,'Acc'=>$Acc,'check'=>$check,'Pen'=>$Pen,'getChatUser'=>$getChatUser,'setRating'=>$setRating,'getAssign'=>$getAssign]);
//         return response()->json([
// $tesJson
//                 ]);
    } else{
         return view('detailimage',['event'=>$event,'comments'=>$comments,'reply'=>$reply,'getUsers'=>$getUsers,'listMember'=>$listMember,'Acc'=>$Acc,'Pen'=>$Pen]);
    }
    }

    public function updEvent($event_id)
    {
        //update dengan fungsi find yang mana update yang berdasarkan id

       

       

        $getdataCurrent=DB::table('events')
                        ->join('categories','categories.category_id','=','events.category')
                        ->where([['events.event_id','=',$event_id]])
                        ->get();
                        // dd($getdataCurrent);

        $category = categories::all();

       
        return view('updateEvent',['category'=>$category,'getdataCurrent'=>$getdataCurrent]);
    }

    public function editEvent(Request $request)
    {
             
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');

        $event = event::find($request->event_id);
     
        $event->user_id=$request->user_id;

        $event->title = $request->title;
        $event->caption=$request->caption;
     
        if($request->hasFile('photo'))

        {

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
        $event->event_date=$request->event_date;
        $event->event_modified_at=$currtime;
        $event->event_modified_by=Auth::user()->id;



     
   
        $event->save();

        $id=$request->event_id;

        // return view('detailimage/','$request->event_id',['event'=>$event])->with('successEdit');
   
        return redirect()->action(
            'EventController@detail',['event_id'=>$request->event_id] 
        )->with('successEdit','success');
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





