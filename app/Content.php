<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //public $timestamps = false;
    protected $casts = [
        'images' => 'array',
        'attr' => 'array'
    ];
    protected $fillable = [
        'title',
        'brief_description',
        'description',
        'status',
        'parent_id',
        'type',
        'meta_keywords',
        'publish_date',
        'images',
        'slug',
        'meta_description',
        'attr',
        'attr_type'

    ];


}
