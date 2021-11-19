<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Content;
use App\Models\export;
use App\Models\Gallery;
use App\Services\attribute\Attribute;
use App\Sitemap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPUnit\Framework\assertIsArray;

//use PDF;

class ContentController extends Controller
{
    protected function uploadImages($request, $type = 'article', $mainImage = true)
    {

        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";


        if ($mainImage) {
            $file = $request->imageJson;
            $fileOrg = $request->file('images');
            $filenameOrg = $fileOrg->getClientOriginalName();
            $fileName = str_replace(' ', '-', $request->title) ?? $filenameOrg;

            $image_parts = explode(";base64,", $file);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $fileType = ($image_type == 'jpeg') ? 'jpg' : $image_type;
            $fileNameAndType = $fileName . '.' . $fileType;


            $file = $fileOrg->move(public_path($imagePath), $fileName . '-org.' . $fileType); // original


            file_put_contents(public_path() . $imagePath . $fileNameAndType, $image_base64); // croped


            $url['images'] = $this->resize($imagePath . $fileNameAndType, $type, $imagePath, $fileNameAndType, $fileName, $fileType);
            // $url['thumb'] = $url['images']['small'];
            $url['images']['org'] = $imagePath . $fileName . '-org.' . $fileType;
        } else {
            foreach ($request->imageJsonGallery as $ga) {
                $file = $ga;
                $fileName = uniqid();

                $image_parts = explode(";base64,", $file);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                $fileType = ($image_type == 'jpeg') ? 'jpg' : $image_type;
                $fileNameAndType = $fileName . '.' . $fileType;


                file_put_contents(public_path() . $imagePath . $fileNameAndType, $image_base64); // croped


                $url[]['images'] = $this->resize($imagePath . $fileNameAndType, $type, $imagePath, $fileNameAndType, $fileName, $fileType);
            }
        }

        if (isset($request->watermark)) {
            foreach ($url['images'] as $size => $image) {

                if (in_array($size, ['crop'])) {
                    $size = 'large';
                }

                $imgFile = Image::make(public_path($image));

                $imgFile->text($request->watermark, env(Str::upper($type) . '_' . Str::upper($size) . '_W') / 2, env(Str::upper($type) . '_' . Str::upper($size) . '_H') / 2, function ($font) use ($size, $type) {
                    $font->file(public_path('/adminAssets/fonts/IRANSans/ttf/IRANSansWeb.ttf'));
                    $font->size(env(Str::upper($type) . '_' . Str::upper($size) . '_W') / 10);
                    $font->color('rgba(0,0,0,0.2)');
                    $font->align('center');
                    $font->valign('bottom');
                    $font->angle(45);
                });

                $imgFile->save(public_path($image), 60, 'jpg');

                // echo "<img src='".url($image)."'>";
            }
        }
        // dd(1);
        return $url;
    }

    private function resize($path, $type, $imagePath, $fileNameAndType, $fileName, $fileType)
    {

        $sizes = array(
            "small" => env(Str::upper($type) . '_SMALL_W'),
            'medium' => env(Str::upper($type) . '_MEDIUM_W'),
            'large' => env(Str::upper($type) . '_LARGE_W')
        );
        // dd($sizes);
        $images['crop'] = $imagePath . $fileNameAndType;
        foreach ($sizes as $name => $size) {
            $images[$name] = $imagePath . $fileName . "-{$name}." . $fileType;

            // dd($path);
            $img = Image::make(public_path($path));
            // dd($path);
            $img->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($images[$name]), 60, 'jpg');

            // echo "<img src='".url($images[$name])."'>";

        }

        // dd(1);
        return $images;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type = 'article')
    {

        if (isset($request->type)) {
            $type = $request->type;
        }
        $companyId = $request->companyId;

        $data['type'] = $type;


        $contents = Content::where('type', '=', '2')->where('attr_type', '=', $type)->orderBy('id', 'desc');

        if ($companyId != '') {
            $data['company'] = Company::find($companyId);
            $contents = $contents->whereHas('companies', function ($q) use ($companyId) {
                $q->where('company_id', '=', $companyId);
            });
        }

        if (isset($request->qtitle)) {
            $contents->where('title', 'like', '%' . $request->qtitle . '%');
        }

        if (isset($request->qslug)) {
            $contents->where('slug', 'like', '%' . $request->qslug . '%');
        }


        $contents = $contents->paginate(10);
        // dd($contents->links());

        $data['contents'] = $contents;
        // dd($data);

        $data['category'] = Content::where('type', '=', '1')->orderBy('id', 'desc')->get()->keyBy('id');
        //dd($data);

        return view('admin.content.List', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $type)
    {

        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $data['category'] = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);
        $data['attr_type'] = $type;
        $data['attrId'] = $request->attr;

        $data['attribute'] = Attribute::getFormFieldsByContentTypeId($request->attr);
        /*if($request->type=='html')
        {
            return view('admin.content.CreateHtml',$data);
        }else
        {*/
        return view('admin.content.CreateOrEdit', $data);

        //}
    }

    public function storeService(Request $request)
    {

        // dd($request->all());
        $this->validate($request, array(
            'parent_id' => 'required',
            'title' => 'required',
            //'description' => 'required',
            //'body' => 'required',
            //'images' => 'required|mimes:jpeg,png,bmp',
        ));

        $imagesUrl = '';
        //dd($request->file('images'));
        if ($request->file('images')) {
            // dd($request->attr_type);
            $imagesUrl = $this->uploadImages($request, $request->attr_type);
        }

        $data = $request->all();
        $date = $data['publish_date'];
        $data['publish_date'] = convertJToG($date);
        $data['parent_id_hide'] = $request->parent_id;
        $data['parent_id'] = $request->parent_id_hide;
        if ($data['parent_id'] == '') {
            $data['parent_id'] = $data['parent_id_hide'][0];
        }

        $data['type'] = '2';
        $data['images'] = $imagesUrl;

        $data['slug'] = uniqueSlug(Content::class, ($request->slug != '') ? $request->slug : $request->title);


        //Content::create(array_merge($request->all(), ['images' => $imagesUrl]));
        $content_id = 1;
        $content_type_id = 1;

        //call careate attr service
        $attrObject = Attribute::create($data, $content_id, $content_type_id);

        $object = Content::create($data);

        $object->categories()->attach($data['parent_id_hide']);
        //gallery
        if (isset($request->imageJsonGallery)) {
            // dd($crud->gallery);
            $imagesGallery = $this->uploadImages($request, $object->attr_type, false);
            foreach ($imagesGallery as $galleryFile) {

                $object->gallery()->save(new Gallery(['images' => $galleryFile, 'model_type' => Content::class, 'model_id' => $object->id]));
            }
            // dd($imagesGallery);
        }

        return $object;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->storeService($request);

        $this->sitemap();

        return redirect('/admin/contents?type=' . $request->attr_type)->with('success', Lang::get('messages.Greate! Content created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {

        $where = array('id' => $id);
        $content_info = Content::where($where)->first();

        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);
        //$attribute = Attribute::getFormFieldsByContentTypeId($request->attr);

        $attribute=Attribute::getFormValue($id);
        //dd($attribute->contentAattributeFields->load('val'));

        $template = 'admin.content.CreateOrEdit';

        /*if($content_info->attr_type=='html')
        {
            $template='admin.content.EditHtml';
        }*/

        return view($template, compact(['content_info', 'category','attribute']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        // dd(convertGToJ($convertDate));

        //$convert = (new Jalalian($date))->toCarbon()->toDateTimeString();
        /* $this->validate($request, [
             'title' => 'required|title',
             'brief_description' => 'required|brief_description',
             'description' => 'required|description',
             'status' => 'required|status',
             'publish_date' => 'required|publish_date',
         ]);
       /*$request->validate([
             'title' => 'required',
             'product_code' => 'required',
             'description' => 'required',
         ]);
        */

        $this->validate($request, array(
            'parent_id' => 'required',
        ));
        /*$update = ['title' => $request->title, 'brief_description' => $request->brief_description
            , 'description' => $request->description
            , 'status' => $request->status
            , 'publish_date' => $request->publish_date];
        Content->where('id',$id)->update($update);

        return Redirect::to('contents')
            ->with('success','Great! Product updated successfully');*/

        // $crud = Content::find($id);

        $crud = Content::find($id);

        $data = $request->all();

        $date = $data['publish_date'];
        $data['publish_date'] = convertJToG($date);


        $data['parent_id_hide'] = $request->parent_id;
        $data['parent_id'] = $request->parent_id_hide;
        if ($data['parent_id'] == '') {
            $data['parent_id'] = $data['parent_id_hide'][0];
        }

        $file = $request->file('images');
        //$inputs = $request->all();
        if ($file) {
            // dd($file);
            $images = $crud->images['images'] ?? '';
            if (is_array($images)) {
                $images = array_map(function ($item) {
                    return trim($item, '/');
                }, array_values($images));

                File::delete($images);
            }

            $images = $this->uploadImages($request, $crud->attr_type);
        } elseif ($crud->images != '') {
            $images = $crud->images;
            // dd($crud->images);
        } else {
            $images = '';
        }

        $data['images'] = $images;


        //gallery
        if (isset($request->imageJsonGallery)) {
            // dd($crud->gallery);
            $imagesGallery = $this->uploadImages($request, $crud->attr_type, false);
            foreach ($imagesGallery as $galleryFile) {

                $crud->gallery()->save(new Gallery(['images' => $galleryFile, 'model_type' => Content::class, 'model_id' => $crud->id]));
            }
            // dd($imagesGallery);
        }

        // dd($request->slug);

        $data['slug'] = uniqueSlug(Content::class, $crud, ($request->slug != '') ? $request->slug : $request->title);
        // dd($data);
        //dd($data);
        $content_type_id=1;
        $attrObject = Attribute::upsert($data, $crud->id, $content_type_id);

        $crud->update($data);
        // dd(1);

        //$crud->categories()->sync($request->parent_id_hide);
        $crud->categories()->detach();
        $crud->categories()->attach($data['parent_id_hide']);
        //dd($crud);

        //        $crud->title = $request->get('title');
        //        $crud->brief_description = $request->get('brief_description');
        //        $crud->description = $request->get('description');
        //        $crud->publish_date = $request->get('publish_date');
        //        $crud->status = $request->get('status');
        //
        //        $file = $request->file('images');
        //        //$inputs = $request->all();
        //
        //        if($file) {
        //            $images = $this->uploadImages($request);
        //        } else {
        //            $images = $crud->images;
        //            $images['thumb'] =  $request->get('imagesThumb');
        //        }
        //        $crud->images=$images;
        //
        //        //unset($inputs['imagesThumb']);
        //        //$article->update($inputs);
        //
        //        //return redirect(route('articles.index'));
        //
        //        $crud->save();

        $this->sitemap();


        return redirect('admin/contents/' . $crud->attr_type . '?page=' . $request->page . '&qtitle=' . rawurldecode($request->qtitle) . '&qslug=' . rawurldecode($request->qslug))->with('success', Lang::get('messages.updated'));
        // return redirect($request->input('url'))->with('success',Lang::get('messages.updated'));
        // return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $crud = Content::find($id);
        $images = $crud->images['images'] ?? '';
        $crud->delete();
        $crud->categories()->detach();

        if (is_array($images)) {
            $images = array_map(function ($item) {
                return trim($item, '/');
            }, array_values($images));

            File::delete($images);
        }


        return redirect('admin/contents/' . $crud->attr_type);
    }


    public function uploadImageSubject(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $year = Carbon::now()->year;
            $request->file('upload')->move(public_path('upload/images/' . $year . '/'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = url('upload/images/' . $year . '/' . $fileName);
            $msg = 'Image uploaded successfully';
            //$response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            //return "<script>window.parent.CKEDITOR.tools.callFunction(1,'{$url}','')</script>";

            //@header('Content-type: text/html; charset=utf-8');
            //echo $response;
            echo '{
        "uploaded": true,
        "url": "' . $url . '"}';
        }
    }

    /*public function uploadImageSubject1(Request $request)
    {
        //print_r($request);
        $this->validate(request() , [
            'upload' => 'required|mimes:jpeg,png,bmp',
        ]);

        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";

        $file = request()->file('upload');
        $filename = $file->getClientOriginalName();

        if(file_exists(public_path($imagePath) . $filename)) {
            $filename = Carbon::now()->timestamp . $filename;
        }

        $file->move(public_path($imagePath) , $filename);
        $url = $imagePath . $filename;

        return "<script>window.parent.CKEDITOR.tools.callFunction(1,'{$url}','')</script>";
    }*/


    public function reload()
    {
        $this->sitemap();
    }

    /**
     * @return mixed
     */
    public function sitemap()
    {
        $category = Content::where('publish_date', '<=', DB::raw('now()'))
            ->where('type', '=', '1')->get();
        $post = Content::where('publish_date', '<=', DB::raw('now()'))
            ->where('type', '=', '2')
            ->where('attr_type', '=', 'article')->get();
        $product = Content::where('publish_date', '<=', DB::raw('now()'))
            ->where('type', '=', '2')
            ->where('attr_type', '=', 'product')->get();

        // $sitemap = siteMap::createIndex()
        //     ->add()->setLoc('post.xml')
        //     ->add()->setLoc('category.xml')
        //     ->add()->setLoc('product.xml')
        //     ->writeToFile('sitemap.xml');

        $sitemap = siteMap::create()
            ->add()->setPriority('1')
            ->setLoc('/')
            ->setLastMod('2020')
            ->setChangefreq('weekly')
            ->setLocFieldName('slug')
            ->setLastModFieldName('updated_at')
            ->setDefultPriority('1')
            ->setDefultChangefreq('weekly')
            ->addByCollection($category)
            ->setDefultPriority('0.9')
            ->setDefultChangefreq('weekly')
            ->addByCollection($post)
            ->setDefultPriority('0.6')
            ->setDefultChangefreq('weekly')
            ->addByCollection($product)
            ->writeToFile('sitemap.xml');

        /*  ->add(array(
              'loc'=>'decor/4',
              'lastmod'=>'11-1-90',
              'changefreq'=>'weekly',
              'priority'=>'0.2',))*/
        // ->add()->setPriority('0.1')->setLoc('decor/1')->setLastMod('11-1-90')
        // ->add()->setLoc('decor/2')->setLastMod('11-12-99');
        return true;
        dd($sitemap);

        /*$postList = Content::all();
        $sitemap=export::CreateSitemap();
        $sitemap->setBaseUrl='remotyadak.ir/';
        $sitemap->setFieldLoc='slug';
        $sitemap->setFieldLastmod='updated_at';
        $sitemap->setFieldLastmod='updated_at';
        $sitemap->setDefultPriority='0.9';*/


        //$sitemap->add($post);
        // $sitemap->multyAdd($postList,);

        //            <?xml version="1.0" encoding="UTF-8"
        //            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        //                    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
        //                <url>
        //                    <loc>
        //                        https://www.digikala.com/product/dkp-3372620/%D8%AA%D8%AA%D9%88-%D9%85%D9%88%D9%82%D8%AA-%D9%85%D8%AF%D9%84-%D8%A8%D8%A8%D8%B1-%DA%A9%D8%AF-k1001
        //                    </loc>
        //                    <changefreq>weekly</changefreq>
        //                    <priority>0.8</priority>
        //                    <image:image>
        //                        <image:loc>
        //                            https://dkstatics-public.digikala.com/digikala-products/86c27c0070faec109c30d4a4fd0db519fc3bd483_1599682136.jpg?x-oss-process=image/resize,m_lfit,h_350,w_350/quality,q_60
        //                        </image:loc>
        //                        <image:caption>تتو موقت مدل ببر کد k1001</image:caption>
        //                    </image:image>
        //                </url>
    }
}
