<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class master extends Model
{
    //
    protected $fillable = array(
        'prefix',
        'text1'
    );

    public function insert()
    {
        return $this ->hasMany(proposal::class,'statusproposal_id','master_id');
    }

}
