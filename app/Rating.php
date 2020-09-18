<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }
    public function author(){
        return $this->belongsTo('App\Author','user_id','id');
    }
}
