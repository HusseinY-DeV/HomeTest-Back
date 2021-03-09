<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = "tests";
    protected $fillable = ['name','price','quantity'];
    public $timestamps = false;


    public function booking()
    {
        return $this->hasMany('App\Booking');
    }
}
