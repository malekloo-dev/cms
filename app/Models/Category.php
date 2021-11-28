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
        $comments = $this->hasMany(Comment::class,'content_id')->where('status', '=', '1');

        return $comments;
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class,'company_contents','content_id','company_id');
    }


    public function companiesCategory($sortField='created_at',$sortValue='desc')
    {
        return $this->belongsToMany(Company::class,'company_category','cat_id','company_id')
        ->orderBy($sortField,$sortValue);
    }

    public function content()
    {
        return $this->belongsToMany(Content::class,'contents_category','cat_id','content_id');
    }

    public function products($sortField='publish_date',$sortValue='desc')
    {

        return $this->belongsToMany(Content::class,'contents_category','cat_id','content_id')
            ->where('type', '=', '2')
            ->where('attr_type', '=', 'product')
            ->where('publish_date', '<=', DB::raw('now()'))
            ->orderBy($sortField,$sortValue);
    }

    public function filterAttr($data)
    {
        //dd($data);
        //DB::enableQueryLog();

        $filter = ContentsCategory::select(
            "content_attribute_value.id",
            "content_attribute_value.content_id",
            "content_attribute_value.content_type_id",
            "content_attribute_value.content_attribute_id",
            "content_attribute_value.company_id",
            "content_attribute_value.field_name",
            "content_attribute_value.label",
            "content_attribute_value.type",
            "content_attribute_value.value",
            "content_attribute_value.json"
       )
            ->join("content_attribute_value", "contents_category.content_id", "=", "content_attribute_value.content_id")
            ->where('contents_category.cat_id', '=', $this->id)
            ->where('content_attribute_value.type', '=', 'combo')
            ->groupBy('content_attribute_value.content_attribute_id')
            ->get();
        foreach ($filter as $key => $filterItem)
        {

            $attribute_id = $filterItem->content_attribute_id;
            //$filterItem->filterItemDetails=collect();
            $filterItem->filterItemDetails=collect(json_decode($filterItem['json'], true));

            $remove=collect();

            foreach ($filterItem->filterItemDetails as $k=>$filterOption)
            {
                $filterOption['check']='';

                //$filterItem->filterItemDetails[$k]+=$filterOption;
                //dd($filterItem->filterItemDetails[$k]);
                $filterOption['url']=addFilterUrlGenerator($data,$attribute_id,$filterOption['value']);
                //dd($filterItem->filterItemDetails[$k]);

                if(isset($data['attribute'][$attribute_id]))
                {
                    if(isset($data['attribute'][$attribute_id][$filterOption['value']])){
                        $filterOption['check']='checked';
                        $removeUrl=removeFilterUrlGenerator($data,$attribute_id,$filterOption['value']);
                        $filterOption['url']=$removeUrl;
                        $remove[]=$filterOption;
                        $filterOption['url']='';
                    }
                }
                $filterItem->filterItemDetails[$k]+=$filterOption;

            }

            //echo '<pre>';
            //print_r($filter);
           // dd($filter);

        }

        $result['filter']=$filter;
        $result['removeFilter']=$remove;
        //dd($result);

        return $result;
        //dd($filter);
       //dd(DB::getQueryLog());
    }

    public function posts($sortField='publish_date',$sortValue='desc')
    {

        return $this->belongsToMany(Content::class,'contents_category','cat_id','content_id')
            ->where('type', '=', '2')
            ->where('attr_type', '=', 'article  ')
            ->where('publish_date', '<=', DB::raw('now()'))
            ->orderBy($sortField,$sortValue);

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
