<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //Fillable untuk coloumn pada inputan

        'name', 'email', 'password','gender','image','title', 'caption,','photo', 'location','category','position','position_id','position_name',
    ];

    public function insert()
    {
        //untuk menyambungkan id user dengan id product dengan menggunakan FK sehingga ketika inputan masuk maka akan mencatat transaksi yang dibuat oleh id dan menginsert produk id sehingga 1 id bisa menginsert berbagai product

        return $this->hasMany(insert::class,'user_id','id');
    }
    public function cart()
    {
        //untuk menyambungkan id user dengan id product dengan menggunakan FK sehingga ketika inputan masuk maka akan mencatat transaksi yang dibuat oleh id dan menginsert produk id sehingga 1 id bisa menginsert berbagai product

        return $this->hasMany(carts::class,'user_id','id');
    }
    
    public function comment()
    {
        return $this->belongsTo(comment::class);
    }
    public function reply()
    {
        return $this->belongsTo(reply::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
