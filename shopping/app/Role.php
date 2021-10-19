<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded=[];
    function permissions() {
        return $this->belongsToMany(Permission::class,'role_permission','role_id','permission_id');
    }
}
