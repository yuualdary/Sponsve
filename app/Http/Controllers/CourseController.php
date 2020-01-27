<?php

namespace App\Http\Controllers;
use DB;
use App\datadatas;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $datadatas = DB::table('datadatas')->paginate(3);
        return view('index',compact('datadatas'));



    }

    public function show(Request $request)
    {
        $datadatas=Course::find($request->id);
        return view('index',compact('datadatas'));

    }
}
