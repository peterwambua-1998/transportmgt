<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Vehicle extends Model
{
    public function driver()
    {
        return $this->belongsTo('App\User');
    }


    public function route()
    {
        return $this->belongsTo('App\Route');
    }

    public function student()
    {
        return $this->hasMany('App\Student');
    }
}
