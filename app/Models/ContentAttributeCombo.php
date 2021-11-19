<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 */
class ContentAttributeCombo extends Model
{
    use HasFactory;
    protected $table = 'content_attribute_combo';

    protected $fillable = [
        'id','content_type_id','content_attribute_id','name','value','created_at','updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
   /* public function ContentType()
    {
        return $this->belongsToMany(ContentType::class);
    }*/

}
