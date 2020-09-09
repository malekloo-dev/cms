<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    public $timestamps = false;
    protected $table = 'website_setting';
    protected $fillable = [
        'variable', 'value'
    ];
}
