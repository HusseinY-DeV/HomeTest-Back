<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = "tests";
    protected $fillable = ['name','price','quantity'];
    public $timestamps = false;

    public function patient()
    {
        return $this->belongsToMany('App\Patient')->withPivot(["id","booked_date","date","checked_out","delivery_status"]);
    }
}
