<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class insert extends Model
{
  

    public function User()
    {
        return $this->belongsTo(User::class);
    }

//    di w ada nya ini

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
