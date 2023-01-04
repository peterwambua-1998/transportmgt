<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public function routes()
    {
        return $this->belongsTo('App\Route');
    }

    public function student()
    {
        return $this->hasOne('App\Student');
    }
}
