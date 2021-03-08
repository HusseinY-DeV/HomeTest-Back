<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = "tests";
    protected $fillable = ['name','price'];
    public $timestamps = false;


    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
