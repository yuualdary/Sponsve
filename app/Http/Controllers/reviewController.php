<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class reviewController extends Controller
{
    //

    public function sendReview(){

        $status = DB::table('masters')
                ->where([['masters.prefix','=','STATUSREVIEW'],])
                ->get();
                dd($status);

        return view('reviewForm',['status'=>$status]);
    }
}
