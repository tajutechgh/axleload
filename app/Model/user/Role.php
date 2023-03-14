<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
    	return $this->belongsToMany('App\Model\user\Permission','permission_roles','permission_id','role_id')->withTimestamps();
    }

    public function users()
    {
    	return $this->belongsToMany('App\Model\user\User','user_roles','user_id','role_id')->withTimestamps();
    }
}