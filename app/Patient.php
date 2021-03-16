<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable implements JWTSubject
{

    protected $table = "patients";
    protected $fillable = ['first_name','last_name','username','phone_number','password'];
    public $timestamps = false;

    public function test()
    {
        return $this->belongsToMany("App\Test")->withPivot(["id","date","booked_date"]);
    }

    public function location()
    {
        return $this->belongsTo("App\Location");
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ['id' => $this->id];
    }

    public function setPasswordAttribute($password)
    {
        if ( !empty($password) ) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}
