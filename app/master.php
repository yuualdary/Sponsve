<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class master extends Model
{
    // protected $primaryKey = 'Master_id';

    //
    protected $fillable = array(
        'prefix',
        'text1'
    );

    public function event()
    {
        return $this ->hasMany(proposal::class,'statusproposal_id','master_id');
    }

}
