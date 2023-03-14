<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Axles_number extends Model
{
    public function vehicle_type()
    {
        return $this->belongsTo('App\Model\user\Vehicle_type','vehicleType_id');  
    }
}
