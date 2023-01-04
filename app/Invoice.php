<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function receipt()
    {
        return $this->hasMany('App\Receipt');
    }
}
