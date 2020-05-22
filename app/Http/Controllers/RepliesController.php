<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    public function RepComment(request $request)
    {   
    
       date_default_timezone_set('Asia/Jakarta');
        $currtime=date('Y-m-d H:i');
        $currDate=date('Y-m-d', strtotime($currtime. ' + 7 days'));
        $reply = new reply();
        $reply->comment_id=$request->comment_id;
        $reply->user_replyid=auth::user()->id;
        $reply->reply=$request->reply;
        $reply->rep_created_at=$currtime;

        $reply->save();
        // return response()->json();
        return \App::make('redirect')->back()->with('flash_success', 'Thank you,!');




    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            Reply::create([
                'comment_id' => $request->input('comment_id'),
                'reply' => $request->input('reply'),
                'user_replyid' => Auth::user()->id
            ]);

            return redirect()->route('home')->with('success','Reply added');
        }

        return back()->withInput()->with('error','Something wronmg');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        if (Auth::check()) {
            $reply = Reply::where(['id'=>$reply->id,'user_id'=>Auth::user()->id]);
            if ($reply->delete()) {
                return 1;
            }else{
                return 2;
            }
        }else{

        }
        return 3;
    }



       
    public function deleteReplies($replies_id)
    {

       
        $deleteReplies=DB::table('replies')
                       ->where([['replies.replies_id','=',$replies_id]])
                       ->delete();

      
        return back()->with('successDelReplies','success');
        
        

    }



}
