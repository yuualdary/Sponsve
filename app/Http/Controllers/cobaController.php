<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\insert;
use App\User;
use App\comment;
use App\reply;
use Validator;
use Redirect;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
class cobaController extends Controller
{
    //tampilan untuk UI
    public function UI()
    {
        return view ('/UI');

    }

    public function view()
    {
        //view untuk shop dan menggunakan table insert untuk mendefiniskan $insert agar bisa digunakan
        $insert = insert::paginate(8);
        return view('shop',compact('insert'));
    }

    public function search(Request $request)
    {
        //fungsi search
        $insert = insert::where('title','LIKE','%'.$request->search.'%')->paginate(1);
        return view('shop',compact('insert'));
    }

    public function detail($id)
    {
        //fungsi detail pada view imagedetail yang mana menggunakan table insert,comment,dan replies,user agar variable bisa defined
          $insert = insert::find($id);
          $comments = DB::table('comments')
                        ->join('inserts', 'inserts.img_id','=','comments.item_id')
                        ->join('users', 'users.id','=','comments.user_id')
                         

                        ->where('comments.item_id','=',$id)
                       
                        ->get();
            $reply = DB::table('replies')
                        ->join('comments', 'comments.cmntid','=','replies.comment_id')
                        ->join('users', 'users.id','=','replies.user_id')
                         ->get();
                     
        return view('detailimage',compact('insert','comments','reply'));
    }
}

