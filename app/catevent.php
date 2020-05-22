<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class catevent extends Model
{
    //


    
    protected $fillable = [
        'catevent_id',
        'catevent_toevent',
        'catevent_tocategory'
    ];
}
