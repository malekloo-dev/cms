<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\export;
use App\Sitemap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

//use PDF;

class ContentController extends Controller
{
    protected function uploadImages($request, $type = 'article')
    {
        $file = $request->imageJson;
        $fileOrg = $request->file('images');
        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";
        $filenameOrg = $fileOrg->getClientOriginalName();
        // dd($filenameOrg);


        $image_parts = explode(";base64,", $file);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $fileName = str_replace(' ','-',$request->title) ?? $filenameOrg;
        $fileType = ($image_type == 'jpeg') ? 'jpg' : $image_type;
        $fileNameAndType = $fileName . '.' . $fileType;


        // dd(public_path() . $imagePath . $fileNameAndType);
        $file = $fileOrg->move(public_path($imagePath), $fileName.'-org.'.$fileType); // original
        // dd(public_path($imagePath));
        // $sizes = ["300", "600", "900"];
        file_put_contents(public_path() . $imagePath . $fileNameAndType, $image_base64); // croped

        // dd($file->getRealPath());
        // $url['images'] = $this->resize($file->getRealPath(), $type, $imagePath, $filename);

        $url['images'] = $this->resize( $imagePath . $fileNameAndType, $type, $imagePath, $fileNameAndType, $fileName, $fileType);
        $url['thumb'] = $url['images']['small'];
        $url['images']['org'] = $imagePath . $fileName.'-org.'.$fileType;
        // dd($url);
        return $url;
    }

    private function resize($path, $type, $imagePath, $fileNameAndType, $fileName, $fileType)
    {

        $sizes = array(
            "small" => @env(Str::upper($type) . '_SMALL'),
            'medium' => @env(Str::upper($type) . '_MEDIUM'),
            'large' => @env(Str::upper($type) . '_LARGE')
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = 'article';
        if (isset($request->type)) {
            $type = $request->type;
        }
        $data['type'] = $type;
        $data['contents'] = Content::where('type', '=', '2')->where('attr_type', '=', $type)->orderBy('id', 'desc')->paginate(1000);

        $data['category'] = Content::where('type', '=', '1')->orderBy('id', 'desc')->get()->keyBy('id');
        //dd($data);

        return view('admin.content.List', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$type)
    {
        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $data['category'] = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);
        $data['attr_type'] = $type;
        /*if($request->type=='html')
        {
            return view('admin.content.CreateHtml',$data);

        }else
        {*/
        return view('admin.content.Create', $data);

        //}
    }

    public function storeService(Request $request)
    {

        //dd($request->all());
        $this->validate($request, array(
            'parent_id' => 'required',
            //'description' => 'required',
            //'body' => 'required',
            //'images' => 'required|mimes:jpeg,png,bmp',
        ));

        $imagesUrl = '';
        //dd($request->file('images'));
        if ($request->file('images')) {
            $imagesUrl = $this->uploadImages($request);
        }

        $data = $request->all();
        $date = $data['publish_date'];
        $data['publish_date'] = convertJToG($date);


        $data['parent_id'] = $request->parent_id_hide[0];
        $data['type'] = '2';
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
        $object = Content::create($data);
        $object->categories()->attach($request->parent_id_hide);

        return $object;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $where = array('id' => $id);
        $content_info = Content::where($where)->first();

        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);

        $template = 'admin.content.Edit';

        /*if($content_info->attr_type=='html')
        {
            $template='admin.content.EditHtml';
        }*/

        return view($template, compact(['content_info', 'category']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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

        $data['parent_id'] = $request->parent_id_hide[0];

        $file = $request->file('images');
        //$inputs = $request->all();

        if ($file) {
            $images = $this->uploadImages($request);
        } elseif ($crud->images != '') {
            $images = $crud->images;
            $images['thumb'] = $request->get('imagesThumb');
        } else {
            $images = '';
        }
        $data['images'] = $images;

        if ($request->slug == '') {
            $data['slug'] = $request->title;
        } else {
            $data['slug'] = $request->slug;
        }
        $data['slug'] = preg_replace('/\s+/', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);

        $crud->update($data);
        $crud->categories()->sync($request->parent_id_hide);

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

        return redirect('admin/contents?type=' . $crud->attr_type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crud = Content::find($id);
        $crud->delete();
        $crud->categories()->detach();

        return redirect('admin/contents?type=' . $crud->attr_type);
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
        $postList = Content::where('publish_date', '<=', DB::raw('now()'))->get();


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
            ->setDefultPriority('0.9')
            ->setDefultChangefreq('weekly')
            ->addByCollection($postList)
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
