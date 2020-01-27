<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //fillable untuk coloumn pada inputan comment

    protected $fillable = array(
        'name',
        'comment',
        'user_id',
        'item_id'
    );

    public function replies(){
    	return $this->belogsTo(comment::class);
    }

    public function user(){

        return $this->hasMany(user::class,'user_id','cmntid');
    }
    public function insert(){

        return $this ->hasMany(insert::class,'item_id','cmntid');
    }
    
}
