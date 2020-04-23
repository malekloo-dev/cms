<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use FilterBuilder;
    protected $fillable = [
        'uniq', 'message','sender','operator_id'
    ];
    protected $table = 'conversations';
    public $timestamps = false;
}
