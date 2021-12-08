<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    protected $table = 'content_type';

    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function contentAattributeFields()
    {
        return $this->belongsToMany(ContentAttribute::class);
    }


    public function attributes()
    {
        return $this->belongsToMany(ContentAttribute::class,'content_attribute_content_type','content_type_id','content_attribute_id');
    }




}
