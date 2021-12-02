<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
        $comments = $this->hasMany(Comment::class, 'content_id')->where('status', '=', '1');

        return $comments;
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_contents', 'content_id', 'company_id');
    }


    public function companiesCategory($sortField = 'created_at', $sortValue = 'desc')
    {
        return $this->belongsToMany(Company::class, 'company_category', 'cat_id', 'company_id')
            ->orderBy($sortField, $sortValue);
    }

    public function content()
    {
        return $this->belongsToMany(Content::class, 'contents_category', 'cat_id', 'content_id');
    }

    public function products($sortField = 'publish_date', $sortValue = 'desc')
    {

        return $this->belongsToMany(Content::class, 'contents_category', 'cat_id', 'content_id')
            ->where('type', '=', '2')
            ->where('attr_type', '=', 'product')
            ->where('publish_date', '<=', DB::raw('now()'))
            ->orderBy($sortField, $sortValue);
    }
    public function posts($sortField = 'publish_date', $sortValue = 'desc')
    {

        return $this->belongsToMany(Content::class, 'contents_category', 'cat_id', 'content_id')
            ->where('type', '=', '2')
            ->where('attr_type', '=', 'article  ')
            ->where('publish_date', '<=', DB::raw('now()'))
            ->orderBy($sortField, $sortValue);
    }


    public function childs()
    {

        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    /**
     * Get all of the post's comments.
     */
    public function gallery()
    {
        return $this->morphMany(Gallery::class, 'model');
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

            // do the rest of the cleanup...
        });
    }
}
