<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // public function permisstion(){
    //     return $this->hasOneThrough(
    //         Permission::class,
    //         RolHasPermission::class,
    //         'mechanic_id', // Foreign key on the cars table...
    //         'car_id', // Foreign key on the owners table...
    //         'id', // Local key on the mechanics table...
    //         'id' // Local key on the cars table...
    //     );

    //     return $this->hasMany('Permission', 'parent_id', 'id');

    //     return $this->belongsTo('App\Permission');
    // }
}
