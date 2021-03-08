<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patients";
    protected $fillable = ['first_name','last_name','username','phone_number','password'];
    public $timestamps = false;

    public function bookings()
    {
        return $this->hasMany("App\Booking");
    }
}
