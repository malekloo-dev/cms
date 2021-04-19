<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'contents';
    protected $casts = [
        'images' => 'array',
        'attr' => 'array'
    ];
    //public $timestamps = false;
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
        'meta_title'


    ];
    public function comments()
    {
        $comments = $this->hasMany(Comment::class,'content_id')->where('status', '=', '1');

        return $comments;
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class,'company_contents','content_id','company_id');
    }

    public function content()
    {
        return $this->belongsToMany(Content::class,'contents_category','cat_id','content_id');
    }

    public function childs()
    {

        return $this->hasMany('Category', 'parent_id', 'id');

    }

}
