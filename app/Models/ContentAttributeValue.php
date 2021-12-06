<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentAttributeValue extends Model
{
    use HasFactory;
    protected $table = 'content_attribute_value';
    protected $fillable = [
        'content_id','content_type_id','content_attribute_id','company_id','label','type','value','json','field_name',
    ];

    public function Attribute()
    {
        //return $this->belongsTo(ContentAttribute::class);
    }
}
