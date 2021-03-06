<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    public $timestamps = false;
    protected $table = 'website_setting';
    protected $fillable = [
        'variable', 'value'
    ];
}
