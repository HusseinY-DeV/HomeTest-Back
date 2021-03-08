<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "bookings";
    protected $fillable = ['booked_date','date','city','street','building','patient_id','test_id'];
    public $timestamps = false;

    public function tests()
    {
        return $this->belongsTo('App\Test');
    }

    public function patients()
    {
        return $this->belongsTo('App\Patient');
    }

}
