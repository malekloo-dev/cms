<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

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
        $comments = $this->hasMany(Comment::class)->where('status', '=', '1')->orderBy('id', 'desc');

        return $comments;
    }


    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_contents', 'content_id', 'company_id')->where('companies.status','=',1);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'contents_category', 'content_id', 'cat_id')/*->withTimestamps()*/;
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

    public function attributeValue()
    {
        return $this->hasMany(ContentAttributeValue::class);
    }


    // this is a recommended way to declare event handlers
    public static function boot()
    {

        parent::boot();

        static::deleting(function ($content) { // before delete() method call this
            $images = $content->images['images'] ?? '';

            if (is_array($images)) {
                $images =  array_map(function ($item) {
                    return trim($item, '/');
                }, array_values($images));

                File::delete($images);
            }

            $content->gallery()->delete();


            // do the rest of the cleanup...
        });
    }
}
