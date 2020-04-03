<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proposal extends Model


{
    public $timestamps = false;

    protected $primaryKey = 'proposal_id';
    protected $fillable = array(
        'userid_proposal',
        'ptid_proposal',
        'proposal_title',
        'proposal_description',
        'proposal_file',
        'statusproposal_id'
    );
    


    public function event(){

        return $this ->hasMany(event::class,'ptid_proposal','event_id');
    }
    public function Master()
    {
        return $this->belongsTo(master::class);
    }
    public function user()
    {
        return $this->hasMany(user::class,'userid_proposal','id');
    }
}
