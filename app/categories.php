<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    public function Products()
    {
        //penggunaan penghubung antara category dengan id user
        return $this->hasMany(event::class,'category_id','id');
    }
}
