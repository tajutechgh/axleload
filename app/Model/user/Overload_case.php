<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Overload_case extends Model
{
    protected $table = "overload_cases";

    public function transaction()
    {
        return $this->belongsTo('App\Model\user\Transaction','transaction_id');  
    }

    public function station()
    {
        return $this->belongsTo('App\Model\user\Station','station_id');  
    }

    public function user()
    {
        return $this->belongsTo('App\Model\user\User','user_id');  
    }
}
