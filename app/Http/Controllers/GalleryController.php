<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class GalleryController extends Controller
{
    public function destroy(Gallery $gallery){

        $images = $gallery->images['images'];
        
        if (is_array($images)) {
            $images =  array_map(function ($item) {
                // dd($item);
                return trim($item, '/');
            }, array_values($images));
            // dd($images);
            File::delete($images);
        }

        $gallery->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
