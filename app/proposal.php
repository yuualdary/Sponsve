<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proposal extends Model


{
    protected $primaryKey = 'proposal_id';
    protected $fillable = array(
        'userid_proposal',
        'ptid_proposal',
        'proposal_title',
        'proposal_description',
        'proposal_file',
        'statusproposal_id'
    );
    


    public function insert(){

        return $this ->hasMany(insert::class,'ptid_proposal','insert_id');
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
