<?php

namespace App\Http\Controllers;
use App\course;

use Illuminate\Http\Request;

class latihanController extends Controller
{
    public function index()
    {
        $course = course::paginate(3);
        return view('view',compact('course'));


        
    }

    public function show(Request $request)
    {
        $course=Course::find($request->id);
        return view('index',compact('course'));

    }
}
