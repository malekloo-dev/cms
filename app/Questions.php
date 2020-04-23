<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'bot_id', 'element_id','title','type','params','priority','message'
    ];
    public $timestamps = false;

}
