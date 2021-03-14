<?php

namespace App\Models;

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
        'slug',
        'brief_description',
        'description',
        'status',
        'parent_id',
        'type',
        'meta_keywords',
        'publish_date',
        'images',
        'meta_description',
        'attr',
        'attr_type',
        'meta_title',

    ];

    public function comments()
    {
        $comments = $this->hasMany('App\Models\Comment')->where('status', '=', '1');

        return $comments;
    }
}