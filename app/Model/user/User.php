<?php

namespace App\Model\user;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'user_id', 'username', 'station_id', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Model\user\Role','user_roles','user_id','role_id')->withTimestamps();
    }

    public function station()
    {
        return $this->belongsTo('App\Model\user\Station','station_id');  
    }
}
