<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    public function categories(){
        return $this->belongsToMany('App/Category');
    }

    public function user(){
        return $this->belongsTo('App/User');
    }
}
