<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Trans_axles extends Model
{
    public function transaction()
    {
        return $this->belongsTo('App\Model\user\Transaction','transaction_id');  
    }
}
