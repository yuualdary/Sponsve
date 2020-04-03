<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\appEmail;
use Illuminate\Support\Facades\Mail;

class appEmailController extends Controller
{
    //


    public function index()
    {
        Mail::to("pesulapkata98@gmail.com")->send(new appEmail());
        return "email successfully snd";
    }
}

