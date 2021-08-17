<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $casts = [
        'images' => 'array'
    ];
    protected $fillable = [
        'title',
        'description',
        'images',
        'model_type',
        'model_id',
    ];
    public function model()
    {
        return $this->morphTo();
    }

}
