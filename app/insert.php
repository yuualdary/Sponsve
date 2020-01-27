<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class insert extends Model

{
    protected $primaryKey = 'insert_id';

  

    public function User()
    {
        return $this->belongsTo(User::class);
    }
 

//    di w ada nya ini

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
