<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedirectUrl extends Model
{
    protected $table = 'redirect_url';
    protected $fillable = [
        'url', 'redirect_to'
    ];
    // public $timestamps = false;
}
