<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    public $timestamps = false;

    protected $casts = [
        'config' => 'array',
    ];
    protected $fillable = [
        'config'
    ];
}
