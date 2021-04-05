<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function dashboard()
    {
        return view('auth.dashboard');
    }




    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }
    public function profileChangeLogo(Request $request)
    {
        $user = Auth::user();

        $imagesUrl = $this->uploadImages($request, $user);

        $user->company->logo = $imagesUrl;
        $user->company->save();

        return response(array('status' => true, 'url' => $imagesUrl), 200);
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $name = $request->all()['data'][0]['name'];
        $value = $request->all()['data'][0]['value'];
        $user->company->$name = $value;
        $user->company->save();

        return response(array('status' => true, 'data' => ['name' => $name, 'value' => $value]), 200);
    }




    public function products()
    {
        $user = Auth::user();
        return view('auth.products', compact('user'));
    }

    protected function uploadImages($request, $user)
    {
        $file = $request->image;
        // $fileOrg = $request->file('images');
        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";
        // $filenameOrg = $fileOrg->getClientOriginalName();
        // dd($filenameOrg);


        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $fileName = $user->company->id;
        $fileType = ($image_type == 'jpeg') ? 'jpg' : $image_type;
        $fileNameAndType = $fileName . '.' . $fileType;


        // dd(public_path() . $imagePath . $fileNameAndType);
        // $file = $fileOrg->move(public_path($imagePath), $fileName.'-org.'.$fileType); // original
        // dd(public_path($imagePath));
        // $sizes = ["300", "600", "900"];
        file_put_contents(public_path() . $imagePath . $fileNameAndType, $image_base64); // croped

        // dd($file->getRealPath());
        // $url['images'] = $this->resize($file->getRealPath(), $type, $imagePath, $filename);
        // $url['images'] = $this->resize(base_path() .'/public'. $imagePath . $fileNameAndType, $type, $imagePath, $fileNameAndType, $fileName, $fileType);
        // $url['thumb'] = $url['images']['small'];
        $url = $imagePath . $fileNameAndType;
        // dd($url);
        return $url;
    }


    function profileShow(Request $request, $id)
    {

        $company = Company::find($id);

        $produsct = Content::where('publish_date', '<=', DB::raw('now()'));
        $produsct = $produsct->where('type', '=', '2');
        $produsct = $produsct->where('attr_type', '=', 'product');
        $produsct = $produsct->orderby('id', 'desc');
        $produsct = $produsct->get();
        

        return view('auth.profileShow', compact('company','produsct'));
    }
}
