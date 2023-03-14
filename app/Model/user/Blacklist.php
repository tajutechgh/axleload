<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    public function station()
    {
        return $this->belongsTo('App\Model\user\Station','station_id');  
    }
}
