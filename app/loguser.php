<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loguser extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
    	'log_id',	
    	'log_message',
        'log_status',
        'log_touserid',
        'log_fromcompanyid',
        'log_fromproposal',
        'log_createdby',
        'log_createdon',
        'log_modifiedby'
    ];



}
