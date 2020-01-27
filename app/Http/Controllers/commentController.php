<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\insert;

class commentController extends Controller
{
    //

    public function index()
    {
        {    $insert = insert::find($id);
            $comment = DB::table('comment')
                        ->join('insert', 'insert.id','=','comment.item_id')
                        ->where('comment.item_id','=','insert.id')
                        ->get();
    
            
            return view('detailimage',compact('insert'));
        }
    


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     {    $insert = insert::find($id);
        $comment = DB::table('comment')
                    ->join('inserts', 'inserts.img_id','=','comment.item_id')
                    ->where('comment.item_id','=','insert.img_id')
                    ->get();

        
        return view('detailimage',compact('insert'));
    }


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

        $cobaiditem = $request->input('item_id');
        // dd($cobaiditem);    
        if (Auth::check()) {
            Comment::create([
                'name' => Auth::user()->name,
                'comment' => $request->input('comment'),
                'user_id' => Auth::user()->id,
                'item_id'=>$request->input('item_id'),


            ]);

            return back()->with('success','Comment Added successfully..!');
        }else{
            return back()->withInput()->with('error','Something wrong');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {    $insert = insert::find($id);
        $comment = DB::table('comment')
                    ->join('insert', 'insert.id','=','comment.item_id')
                    ->where('comment.item_id','=','insert.id')
                    ->get();

        
        return view('detailimage',compact('insert'));
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
        {    $insert = insert::find($id);
            $comment = DB::table('comment')
                        ->join('insert', 'insert.id','=','comment.item_id')
                        ->where('comment.item_id','=','insert.id')
                        ->get();
    
            
            return view('detailimage',compact('insert'));
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
}
