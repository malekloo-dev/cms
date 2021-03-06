<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'label',
        'link',
        'parent',
        'sort',
        'class',
        'menu',
        'depth',
        'type',
        'created_at',
        'updated_at',
        'module',
        'module_id'
    ];
}
