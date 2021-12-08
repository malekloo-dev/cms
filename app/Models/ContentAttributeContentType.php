<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ContentAttributeContentType extends Model
{
    protected $table = 'content_attribute_content_type';

    protected $fillable = [
        'content_type_id','content_attribute_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ContentTypes()
    {
        return $this->hasOne(ContentType::class);
    }

}
