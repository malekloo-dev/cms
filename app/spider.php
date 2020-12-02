<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spider extends Model
{
    public $timestamps = false;

    protected $casts = [
        'attr' => 'array'
    ];
    protected $fillable = [
        'url',
        'title',
        'image',
        'attr'
    ];


}
