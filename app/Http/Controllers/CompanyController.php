<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Content;
use App\Models\CompanyContents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;



class CompanyController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        return view('auth.dashboard', compact('user'));
    }




    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }
    public function profileChangeLogo(Request $request)
    {
        $user = Auth::user();

        $imagesUrl = $this->uploadImages($request->image, $user->company->id, 'company');

        $user->company->logo = $imagesUrl['images'];
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

        // dd($user->company);

        return view('auth.products', compact('user'));
    }

    public function productsCreate()
    {
        $user = Auth::user();

        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);

        // dd($category);

        return view('auth.productsCreateOrUpdate', compact('user', 'category'));
    }

    public function productsStore(Request $request)
    {
        $user = Auth::user();

        //dd($request->all());
        $this->validate($request, array(
            'parent_id' => 'required',
            'title' => 'required',
            //'body' => 'required',
            //'images' => 'required|mimes:jpeg,png,bmp',
        ));

        $imagesUrl = '';

        if ($request->file('images')) {
            $imagesUrl = $this->uploadImages($request->imageJson, $request->title);
        }

        $data = $request->all();
        $date = $data['publish_date'];
        // $data['publish_date'] = convertJToG($date);


        $data['parent_id'] = $request->parent_id[0];
        $data['type'] = '2';
        $data['attr_type'] = 'product';
        $data['attr'] = ["brand" => $user->company->name, "price" => 0];

        $data['images'] = $imagesUrl;
        if ($request->slug == '') {
            $data['slug'] = $request->title;
        } else {
            $data['slug'] = $request->slug;
        }
        $data['slug'] = preg_replace('/\s+/', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        //Content::create(array_merge($request->all(), ['images' => $imagesUrl]));
        // $data['status'] = '1';
        $content = Content::create($data);
        // dd(new CompanyContent(['company_id' => $user->id, 'content_id' => $content->id]));
        // $content->companies()->create(new CompanyContent(['company_id' => $user->id, 'content_id' => $content->id]));
        CompanyContents::create(['company_id' => $user->company->id, 'content_id' => $content->id]);
        // dd($content->companies);


        return redirect()->route('company.products')->with('success', Lang::get('messages.Greate! Content created successfully.'));
    }



    public function productsUpdate(Content $content)
    {
        $post = $content;

        //todo check user id and content id correctly

        $user = Auth::user();

        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);


        return view('auth.productsCreateOrUpdate', compact('user', 'category', 'post'));
    }

    public function productsEdit(Request $request, Content $content)
    {
        $user = Auth::user();

        //dd($request->all());
        $this->validate($request, array(
            'parent_id' => 'required',
            //'description' => 'required',
            //'body' => 'required',
            //'images' => 'required|mimes:jpeg,png,bmp',
        ));

        $imagesUrl = '';
        // dd($request->images);
        if ($request->file('images')) {
            $imagesUrl = $this->uploadImages($request->imageJson, $content->slug);
        }

        $data = $request->all();
        $date = $data['publish_date'];
        // $data['publish_date'] = convertJToG($date);


        $data['parent_id'] = $request->parent_id[0];
        // $data['type'] = '2';
        $data['attr_type'] = 'product';
        $data['attr'] = ["brand" => $user->company->name, "price" => 0];

        $data['images'] = $imagesUrl;

        $data['slug'] = $request->title;

        $data['slug'] = preg_replace('/\s+/', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        //Content::create(array_merge($request->all(), ['images' => $imagesUrl]));
        $data['status'] = '1';

        $content->update($data);

        // $content = Content::create($data);
        // dd(new CompanyContent(['company_id' => $user->id, 'content_id' => $content->id]));
        // $content->companies()->create(new CompanyContent(['company_id' => $user->id, 'content_id' => $content->id]));
        //CompanyContents::create(['company_id' => $user->company->id, 'content_id' => $content->id]);
        // dd($content->companies);


        return redirect()->route('company.products')->with('success', Lang::get('messages.Greate! Content created successfully.'));
    }

    protected function uploadImages($file, $fileName, $type = 'product')
    {
        // $fileJson = $request->imageJson;
        // $file = $request->image;
        // $fileOrg = $request->file('images');
        $year = Carbon::now()->year;
        if ($type == 'company')
            $imagePath = "/upload/images/company/";
        else
            $imagePath = "/upload/images/{$year}/";
        // $filenameOrg = $fileOrg->getClientOriginalName();
        // dd($filenameOrg);


        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // $fileName = $user->company->id;
        $fileName = str_replace(' ', '-', $fileName);
        $fileType = ($image_type == 'jpeg') ? 'jpg' : $image_type;
        $fileNameAndType = $fileName . '.' . $fileType;


        // dd(public_path() . $imagePath . $fileNameAndType);
        // $file = $fileOrg->move(public_path($imagePath), $fileName.'-org.'.$fileType); // original
        // dd(public_path($imagePath));
        // $sizes = ["300", "600", "900"];
        file_put_contents(public_path() . $imagePath . $fileNameAndType, $image_base64); // croped

        // dd($file->getRealPath());
        // $url['images'] = $this->resize($file->getRealPath(), $type, $imagePath, $filename);
        $url['images'] = $this->resize($imagePath . $fileNameAndType, $type, $imagePath, $fileNameAndType, $fileName, $fileType);
        $url['thumb'] = $url['images']['small'];
        // $url = $imagePath . $fileNameAndType;
        // dd($url);
        return $url;
    }

    private function resize($path, $type, $imagePath, $fileNameAndType, $fileName, $fileType)
    {

        $sizes = array(
            "small" => @env(Str::upper($type) . '_SMALL_W'),
            'medium' => @env(Str::upper($type) . '_MEDIUM_W'),
            'large' => @env(Str::upper($type) . '_LARGE_W')
        );

        $images['crop'] = $imagePath . $fileNameAndType;
        foreach ($sizes as $name => $size) {
            $images[$name] = $imagePath  . $fileName . "-{$name}." . $fileType;

            // dd($path);
            $img = Image::make(public_path($path));
            // dd($path);
            $img->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($images[$name]), 75);
        }


        return $images;
    }


    function profileShow(Request $request, $id)
    {

        $company = Company::find($id);

        // $produsct = Content::where('publish_date', '<=', DB::raw('now()'));
        // $produsct = $produsct->where('company_id', '=', $company->id);
        // $produsct = $produsct->where('type', '=', '2');
        // $produsct = $produsct->where('attr_type', '=', 'product');
        // $produsct = $produsct->orderby('id', 'desc');
        // $produsct = $produsct->get();


        return view('auth.profileShow', compact('company'));
    }


    public function productsDestroy(Content $content)
    {
        $content->delete();

        return redirect()->route('company.products')->with('success', Lang::get('messages.Greate! Content created successfully.'));
    }












    public function companyList()
    {
        $companies = Company::all();

        return view('admin.company.index', compact('companies'));
    }

    public function companyCreateOrUpdate(Request $request, Company $company)
    {
        $categoryImplode = $cropperPreview = '';
        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);
        // dd($company->exists());

        if ($company->exists) {
            $categoryImplode = "'" . implode("','", $company->categories->pluck('id')->toArray()) . "'";
            $cropperPreview = $company->logo['large'] ?? '';
        }


        return view('admin.company.createOrUpdate', compact(
            'company',
            'cropperPreview',
            'category',
            'categoryImplode'
        ));
    }

    public function companyStore(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required',
            'manager' => 'required',
            'mobile' => 'required',
            'email' => 'required|unique:users,email'
        ));
        $data = $request->all();
        $data['password'] = Hash::make(123456);


        $user = $this->companyStoreService($data, new Company);

        return redirect()->route('admin.company.index')->with('success', Lang::get('messages.Greate! Company created successfully.'));
    }

    public function companyEdit(Request $request, Company $company)
    {
        $this->validate($request, array(
            'name' => 'required',
            'manager' => 'required',
            'mobile' => 'required',
        ));

        $data = $request->all();

        $this->companyStoreService($data, $company);

        return redirect()->route('admin.company.index')->with('success', Lang::get('messages.Greate! Company edited successfully.'));
    }



    public function companyStoreService($data, $company)
    {

        $parent_id_hide = $data['parent_id_hide'];
        $data['parent_id_hide'] = $data['parent_id'];
        $data['parent_id'] = $parent_id_hide;
        if( $data['parent_id']==''){
            $data['parent_id']=$data['parent_id_hide'][0];
        }

        if ($company->exists) {
            $company->update($data);
            $user = User::where('id', '=', $company->user_id)->first();

            $company->categories()->detach();
        } else {
            $user = User::create($data);
            $data['user_id'] = $user->id;
            $company = Company::create($data);

            $user->company()->save($company);
        }
        $user->assignRole('company');

        $company->categories()->attach($data['parent_id_hide']);


        if ($data['imageJson']) {
            $imagesUrl = $this->uploadImages($data['imageJson'], $user->company->id, 'company');
            $user->company->logo = $imagesUrl['images'];
            $user->company->save();
        }


        return $user;
    }
    public function companyDestroy(Company $company)
    {
        // $company->delete();
        // $companu->dettach();
        // $compnay->contents;
        // unllink

        return redirect()->route('admin.company.index')->with('success', Lang::get('messages.deleted'));


    }
}
