<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'comment',
        'status'
    ];



    public function content(){
        return $this->belongsTo('App\Models\Content');
    }
}
