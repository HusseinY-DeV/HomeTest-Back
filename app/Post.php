<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = ['title','description','image','user_id','posted_date'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
