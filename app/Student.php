<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function parent()
    {
        return $this->belongsTo('App\User');
    }

    public function attendance()
    {
        return $this->hasMany('App\Attendance');
    }

    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }
}
