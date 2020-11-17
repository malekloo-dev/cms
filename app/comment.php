<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'comment',
        'parent_id',
        'content_id',
        'status'
    ];

}
