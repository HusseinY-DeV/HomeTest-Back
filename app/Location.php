<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = "location";
    protected $fillable = ['city','building','street'];
    public $timestamps = false;


    public function patient()
    {
        return $this->hasMany("App\Patient");
    }
}
