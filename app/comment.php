<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    public $timestamps = false;

    //fillable untuk coloumn pada inputan comment

    protected $fillable = array(
        'name',
        'comment',
        'user_commentid',
        'item_id',
        'company_commentid'
    );

    public function replies(){
    	return $this->belogsTo(comment::class);
    }

    public function user(){

        return $this->hasMany(user::class,'user_id','cmntid');
    }
    public function event(){

        return $this ->hasMany(event::class,'item_id','cmntid');
    }
    
}
