<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public $timestamps = false;

    protected $fillable = [
    	'comment_id',	
    	'reply',
    	'user_replyid'
    ];

    //
    public function user()
    {
        return $this->hasMany(user::class,'user_replyid','id');

    }
    public function comment()
    {
        return $this->hasMany(comment::class,'comment_id','id');
    }
}
