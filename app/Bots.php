<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bots extends Model
{

    protected $table = 'bots';
    protected $fillable = ['name','status'];
    public $timestamps = false;
}
