<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

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

    // public function delete()
    // {
    //     dd(2);

    //     $images = $this->images['images'] ?? '';

    //         if (is_array($images)) {
    //             $images =  array_map(function ($item) {
    //                 return trim($item, '/');
    //             }, array_values($images));

    //             dd($images);
    //             File::delete($images);
    //         }

    //     parent::delete();
    // }

    // // this is a recommended way to declare event handlers
    // public static function boot()
    // {

    //     parent::boot();


    //     static::deleting(function ($gallery) { // before delete() method call this
    //         $images = $gallery->images['images'] ?? '';

    //         if (is_array($images)) {
    //             $images =  array_map(function ($item) {
    //                 return trim($item, '/');
    //             }, array_values($images));

    //             dd($images);
    //             File::delete($images);
    //         }

    //         // do the rest of the cleanup...
    //     });
    // }
}
