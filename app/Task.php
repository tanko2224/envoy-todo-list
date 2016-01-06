<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = ['title','description'];

    public function categories(){
        return $this->belongsToMany('App/Category');
    }

    public function user(){
        return $this->belongsTo('App/User');
    }
}
