<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $table = "patient_test";
    protected $fillable = ["id",'patient_id','test_id','date','booked_date','checked_out'];
    public $timestamps = false;
}
