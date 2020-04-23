<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'name', 'uniq','email'
    ];
    public $timestamps = false;
}
