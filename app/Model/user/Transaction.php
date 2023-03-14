<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    public function trans_axles()
    {
        return $this->hasMany('App\Model\user\Trans_axles','transaction_id');  
    }

    public function vehicle_type()
    {
        return $this->belongsTo('App\Model\user\Vehicle_type','vehicleType_id');  
    }

    public function commodity()
    {
        return $this->belongsTo('App\Model\user\Commodity','commodity_id');  
    }

    public function height()
    {
        return $this->belongsTo('App\Model\user\Height','height_id');  
    }

    public function user()
    {
        return $this->belongsTo('App\Model\user\User','user_id');  
    }

    public function station()
    {
        return $this->belongsTo('App\Model\user\Station','station_id');  
    }

    public function overload()
    {
        return $this->hasOne('App\Model\user\Overload_case','transaction_id');  
    }
}
