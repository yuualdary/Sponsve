<?php

namespace App\Http\Controllers;

use App\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class ChatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
    //  * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {
        // $chat= DB::table('messages')
        //       ->join('users','users.id','=','messages.user_id')
        //     //   ->where([['user_id','=',Auth::user()->id],])
        //       ->get();
   
        // return view('chat',['chat'=>$chat]);

        return view ('chat');
    }
    // public function test()
    // {
    //     // $chat= DB::table('messages')
    //     // // //     //   ->join('users','users.id','=','messages.message_userid')
    //     // // //     //   ->where([['message_userid','=',Auth::user()->id],])
    //     // ->get();

    //     return view('divmessage');
   
    // }
    /**
     * Fetch all messages
     *
    //  * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database
    //  *
    //  * @param  Request $request
    //  * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message =new message();
        $message->user_id=auth::user()->id;
        $message->message=$request->message;
        $message->save();

        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
