<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Content;
use Intervention\Image\Facades\Image;



class AdminController extends Controller
{
    protected function uploadImages($file)
    {
        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";
        $filename = $file->getClientOriginalName();

        $file = $file->move(public_path($imagePath), $filename);

        $sizes = ["300", "600", "900"];
        $url['images'] = $this->resize($file->getRealPath(), $sizes, $imagePath, $filename);
        // $url['thumb'] = $url['images'][$sizes[0]];

        return $url;
    }

    private function resize($path, $sizes, $imagePath, $filename)
    {
        $images['original'] = $imagePath . $filename;
        foreach ($sizes as $size) {
            $images[$size] = $imagePath . "{$size}_" . $filename;

            Image::make($path)->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($images[$size]));
        }

        return $images;
    }

    public function index()
    {

        $data['articlesCount'] = Content::where('type', '=', '2')
            ->where('attr_type', '=', 'article')
            ->count();

        $data['productsCount'] = Content::where('type', '=', '2')
            ->where('attr_type', '=', 'product')
            ->count();

        $data['commentsCount'] = Comment::count();

        $data['companiesCount'] = Company::count();

        // dd($data);

        return view('admin.index', compact('data'));
    }


}
