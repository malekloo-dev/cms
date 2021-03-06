<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    public $timestamps = false;

    protected $casts = [
        'attr' => 'array',
    ];
    protected $fillable = [
        'attr','file_name'
    ];
}
