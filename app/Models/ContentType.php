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


}
