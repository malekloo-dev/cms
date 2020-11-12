<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = [
        'comment',
        'parent_id',
        'content_id',
        'status'
    ];

}
