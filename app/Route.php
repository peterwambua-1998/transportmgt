<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public function vehicle()
    {
        return $this->hasOne('App\Vehicle');
    }

    public function path()
    {
        return $this->hasOne('App\RoutePolyline');
    }


    public function trip()
    {
        return $this->hasMany('App\Trip');
    }
    
}
