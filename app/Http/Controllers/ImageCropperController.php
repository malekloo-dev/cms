<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ImageCropperController extends Controller
{

    public function index()
    {
        return view('cropper');
    }

    public function upload(Request $request)
    {
        $year = Carbon::now()->year;
        $folderPath = public_path("upload/images/{$year}/");

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        // dd($image_type_aux);
        $image_base64 = base64_decode($image_parts[1]);
        // $file = $folderPath . uniqid() . '.png';
        $fileName = $request->fileName ?? uniqid();
        // echo $fileName;
        // dd($image_type);
        $image_type = ($image_type == 'jpeg')?'jpg':$image_type;
        $file = $folderPath . $fileName . '.'.$image_type;
        file_put_contents($file, $image_base64);

        return response()->json(['success'=>'success']);
    }
}
