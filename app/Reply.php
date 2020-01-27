<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
    	'comment_id',	
    	'reply',
    	'user_id'
    ];

    //
    public function user()
    {
        return $this->hasMany(user::class,'user_id','id');

    }
    public function comment()
    {
        return $this->hasMany(comment::class,'comment_id','id');
    }
}
