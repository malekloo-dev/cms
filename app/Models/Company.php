<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $casts = [
        'phone' => 'array',
        'logo' => 'array'
    ];

    protected $fillable = [
        'name','parent_id', 'manager','description', 'sale_manager', 'address', 'city', 'province', 'mobile','location',
        'phone', 'email', 'site', 'whatsapp', 'telegram', 'instagram', 'logo', 'user_id','meta_keywords','meta_description','meta_title'
    ];


    public function contents()
    {
        return $this->belongsToMany(Content::class,'company_contents','company_id','content_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','parent_id');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'company_category', 'company_id', 'cat_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

     /**
     * Get all of the post's comments.
     */
    public function gallery()
    {
        return $this->morphMany(Gallery::class, 'model');
    }


}
