<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 */
class ContentAttribute extends Model
{
    use HasFactory;
    protected $table = 'content_attribute';

    protected $fillable = [
        'id','field_name','label','element_type','element_input_type','required','filter'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ContentType()
    {
        return $this->belongsToMany(ContentType::class);
    }
    public function contentpivot()
    {
        return $this->hasMany(ContentAttributeContentType::class);

    }
    public function ComboFields()
    {
        return $this->hasMany(ContentAttributeCombo::class);
    }
    public function value()
    {
        //dd( request()->input('content_id'));
       // return $this->hasOne(ContentAttributeValue::class)->where('content_attribute_id', '=', request()->input('content_id'));
        return $this->hasOne(ContentAttributeValue::class);

    }
}
