<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public function region()
    {
        return $this->belongsTo('App\Model\user\Region','region_id'); 
    }
}
