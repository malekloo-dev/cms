<?php

namespace App;

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
        return $this->belongsTo('App\content');
    }
}
