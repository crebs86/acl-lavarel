<?php

namespace Crebs86\Acl\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function havePermissions(){
        return $this->hasMany(Permission::class);
    }
}
