<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\event;
use Illuminate\Support\Facades\DB;


class commentController extends Controller
{
    //

    public function index()
    {
        $event = event::find($id);
            $comment = DB::table('comments')
                        ->join('events', 'events.id','=','comments.item_id')
                        ->where('comments.item_id','=','events.id')
                        ->get();
    
            
            return view('detailimage',compact('event'));
        
    


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        $event = event::find($id);
        $comment = DB::table('comment')
                    ->join('events', 'events.img_id','=','comment.item_id')
                    ->where('comment.item_id','=','event.img_id')
                    ->get();

        
        return view('detailimage',compact('event'));
    


        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:m');   
        $cobaiditem = $request->input('company_commentid');
        $test=$request->input('proposal_commentid');
       
        // if (Auth::check()) {
        //     Comment::create([
        //         'name' => Auth::user()->name,
        //         'comment' => $request->input('comment'),
        //         'user_commentid' => Auth::user()->id,
        //         'item_id'=>$request->input('item_id'),
        //         'company_commentid'=>Auth::user()->userid_tocompany,
        //         'proposal_commentid'=>$test,


        //     ]);

        //     return back()->with('success','Comment Added successfully..!');
        // }else{
        //     return back()->withInput()->with('error','Something wrong');
        // }
        
                    $comment= new comment();
                    $comment->comment=$request->comment;
                    $comment->user_commentid=Auth::user()->id;
                    $comment->item_id=$request->item_id;
                    $comment->company_commentid=Auth::user()->userid_tocompany;
                    $comment->proposal_commentid=$request->proposal_commentid;
                    $comment->comment_created_at=$currtime;
                    $comment->save();

           return back();
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {   
        $event = event::find($id);
        $comment = DB::table('comment')
                    ->join('event', 'event.id','=','comment.item_id')
                    ->where('comment.item_id','=','event.id')
                    ->get();

        
        return view('detailimage',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
        {    $event = event::find($id);
            $comment = DB::table('comment')
                        ->join('event', 'event.id','=','comment.item_id')
                        ->where('comment.item_id','=','event.id')
                        ->get();
    
            
            return view('detailimage',compact('event'));
        }
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (Auth::check()) {
            // untuk melakukan comment pada view detail image


            $reply = Reply::where(['comment_id'=>$comment->id]);
            $comment = Comment::where(['user_id'=>Auth::user()->id, 'id'=>$comment->id]);
            if ($reply->count() > 0 && $comment->count() > 0) {
                $reply->delete();
                $comment->delete();
                return 1;
            }else if($comment->count() > 0){
                $comment->delete();
                return 2;
            }else{
                return 3;
            }

        }
    }

    public function deleteComment($cmntid)
    {

       
        $deleteReplies=DB::table('replies')
                       ->where([['replies.comment_id','=',$cmntid]])
                       ->delete();

        $deleteComment=DB::table('comments')
                        ->where([['comments.cmntid','=',$cmntid]]) 
                        ->delete();
        return back()->with('successDelComment','success');
        
        

    }

 
}
