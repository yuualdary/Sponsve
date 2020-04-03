<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    public $timestamps = false;

    protected $primaryKey='company_id';
    protected $fillable = array(
        'admin_userid',
        'member_userid',
        'company_name',
        'company_phone',
        'company_address',
        'website_address',
        'social_media'
);

  
   
    public function user()
    {
        return $this->belongsTo(user::class);

    }
}
