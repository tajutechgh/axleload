<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Vehicle_type extends Model
{
	protected $table = 'vehicle_types';

    public function axles_numbers()
    {
        return $this->hasMany('App\Model\user\Axles_number','vehicleType_id');  
    }

    public function transactions()
    {
        return $this->hasMany('App\Model\user\Transaction','vehicleType_id');  
    }
}
