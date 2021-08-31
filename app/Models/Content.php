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


//    public function category()
//    {
//        return $this->belongsToMany('App\Models\Category','contents_category','content_id','cat_id');
//    }



    public function comments()
    {
        $comments = $this->hasMany(Comment::class)->where('status', '=', '1')->orderBy('id','desc');

        return $comments;
    }


    public function companies()
    {
        return $this->belongsToMany(Company::class,'company_contents','content_id','company_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','parent_id');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'contents_category', 'content_id', 'cat_id')/*->withTimestamps()*/ ;
    }

    /**
     * Get all of the post's comments.
     */
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    /**
     * Get all of the post's comments.
     */
    public function gallery()
    {
        return $this->morphMany(Gallery::class, 'model');
    }

}
