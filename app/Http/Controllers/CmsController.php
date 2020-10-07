<?php

namespace App\Http\Controllers;

use App\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use App\RedirectUrl;

use PDF;

class CmsController extends Controller
{
    public $breadcrumb;


    public function request($slug)
    {
        $spesifiedUrl = RedirectUrl::where('url', 'like', '/' . $slug);
        if ($spesifiedUrl->exists()) {
            header("Location: ". url($spesifiedUrl->first()->redirect_to), true, 301);
            exit();
        }


        $detail = Content::where('slug', '=', $slug)->first();
        if ($detail === null) {
            return view(@env(TEMPLATE_NAME) . '.NotFound');
        }

        $this->breadcrumb[] = $detail->getAttributes();
        $breadcrumb = $this->get_parent($detail->parent_id);

        $seo['meta_keywords'] = $detail->meta_keywords;
        $seo['meta_description'] = $detail->meta_description;
        $seo['url'] = url('/').'/'.$slug;
        $seo['meta_title'] = $detail->meta_title;
        $seo['og:title'] = $detail->title;
        $seo['og:type'] = ($detail->type == 1)?'article':'product';


        if (is_array($breadcrumb)) {
            krsort($breadcrumb);
        } else {
            $breadcrumb = array();
        }

        $table_of_content = array();
        $table_of_images = array();
        $images = array();
        if (strlen($detail->description)) {
            $resultTableContent = $this->tableOfContent($detail->description);
            $detail->description = $resultTableContent['content'];
            $table_of_content = $resultTableContent['list'];

            $table_of_images = $this->tableOfImage($detail->description);


            //preg_match_all('/<img[^>]+>/i',$detail->description, $result);
            // preg_match_all('/(alt|title|src)=("[^"]*")/i',$img_tag, $img[$img_tag]);

            $a = $detail->description;


            ///dd($result);
        }



        $detail->increment('viewCount');
        $relatedPost = array();
        $subCategory = array();
        $relatedProduct = array();
        $editorModule=editorModule($detail->description);

        if ($detail->type == 1) {
            $relatedPost = Content::where('type', '=', '2')
                ->where('attr_type', '=', 'article')
                ->where('parent_id', '=', $detail->id)
                ->get();
            $relatedProduct = Content::where('type', '=', '2')
                ->where('attr_type', '=', 'product')
                ->where('parent_id', '=', $detail->id)
                ->get();

            $subCategory = Content::where('type', '=', '1')
                ->where('parent_id', '=', $detail->id)
                ->get();
            $template = @env(TEMPLATE_NAME) . '.cms.DetailCategory';
            if ($detail->attr_type == 'html') {
                $template = @env(TEMPLATE_NAME) . '.cms.' . $detail->attr['template_name'];
            }
            //dd($detail);
            return view($template, compact(['detail', 'relatedPost', 'table_of_content', 'subCategory', 'relatedProduct', 'breadcrumb', 'images', 'seo','editorModule']));
        } else {
            $relatedPost = Content::where('type', '=', '2')
                ->where('parent_id', '=', $detail->parent_id)
                ->where('id', '<>', $detail->id)
                ->where('attr_type', '=', 'article')
                ->inRandomOrder()
                ->limit(4)->get();

            $relatedProduct = Content::where('type', '=', '2')
                ->where('parent_id', '=', $detail->parent_id)
                ->where('id', '<>', $detail->id)
                ->where('attr_type', '=', 'product')
                ->inRandomOrder()
                ->limit(4)->get();

            $template = @env('TEMPLATE_NAME') . '.cms.Detail';
            if ($detail->attr_type == 'html') {
                $template = @env(TEMPLATE_NAME) . '.cms.' . $detail->attr['template_name'];
            }

            //$detail->description=editorModule($detail->description);

            //dd($editorModule);
            return view($template, compact(['detail', 'breadcrumb', 'relatedPost', 'table_of_content', 'relatedProduct', 'table_of_images', 'seo','editorModule']));
        }
    }

    public function tableOfImage($content)
    {
        $doc = new \DOMDocument();
        /* use @ or libxml_use_internal_errors
         * libxml_use_internal_errors(true);
        $dom->loadHTML('...');
        libxml_clear_errors();*/
        @$doc->loadHTML($content);

        /*echo '<pre/>';
        print_r($a);
        die();*/
        $tags = $doc->getElementsByTagName('figure');

        $count = -1;
        foreach ($tags as $tag) {
            $count++;
            // echo '<pre/>';
            // print_r($tag);

            foreach ($tag->childNodes as $tag1) {
                //print_r($tag1);
                if ($tag1->tagName == 'img') {
                    foreach ($tag1->attributes as $tag3) {
                        $images[$count]['src'] = $tag3->value;
                        break;
                    }
                }
                if ($tag1->tagName == 'figcaption') {
                    $images[$count]['alt'] = $tag1->nodeValue;
                }
            }
        }
    }

    public function tableOfContent($content)
    {

        //preg_match_all( '|<h[^>]+>(.*)</h[^>]+>|iU',$detail->description, $matches );
        //echo '<pre/>';
        //print_r($matches);
        //$tag = $matches[1];
        // dd($matches);
        $depth = 3;
        $pattern = '/<h[2-' . $depth . ']*[^>]*>.*?<\/h[2-' . $depth . ']>/';
        $pattern = '|<h[^>]+>(.*)</h[^>]+>|iU';

        $whocares = preg_match_all($pattern, $content, $winners);

        //dd(Request::url());
        //dd(url()->current());

        //reformat the results to be more usable
        $heads = implode("\n", $winners[0]);
        //$replace='<a href="'.url()->current().'/';
        //$heads = str_replace('<a href="',$replace,$heads);
        //$heads = str_replace('</a>','',$heads);
        //$heads = preg_replace('/<h([1-'.$depth.'])>/','<li class="toc$1">',$heads);
        //$heads = preg_replace('/<\/h[1-'.$depth.']>/','</a></li>',$heads);

        //dd($detail->description);

        //$table=$winners;
        $table_of_content = '';
        $count = 0;
        $list['list'] = array();
        foreach ($winners[1] as $key => $val) {
            $item = str_replace(' ', '-', $val);
            $list['list'][$count]['label'] = $val;
            $list['list'][$count]['anchor'] = $item;
            $table_of_content = '';
            $anchor = '<a name="' . str_replace(' ', '-', $val) . '"></a>' . $winners[0][$key];

            $content = str_replace($winners[0][$key], $anchor, $content);

            $count++;
        }

        // print_r($winners[0]);
        // die();
        //foreach ()
        $list['content'] = $content;
        //echo $contents;
        //echo '<pre/>';
        //print_r($heads);
        //die();

        //dd($heads);
        return $list;
    }

    protected function uploadImages($file)
    {
        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";
        $filename = $file->getClientOriginalName();

        $file = $file->move(public_path($imagePath), $filename);

        $sizes = ["300", "600", "900"];
        $url['images'] = $this->resize($file->getRealPath(), $sizes, $imagePath, $filename);
        $url['thumb'] = $url['images'][$sizes[0]];

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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data['contents'] = Content::orderBy('id', 'desc')->paginate(10);

        return view('content.List', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = app('App\Http\Controllers\CategoryController')->tree_set();

        $data['category'] = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);

        return view('content.Create', $data);
    }

    public function get_parent($id)
    {
        global $conn;
        $tree_rs = Content::where('id', '=', $id)->first();
        if (!is_object($tree_rs)) {
            return $this->breadcrumb;
        }
        $this->breadcrumb[] = $tree_rs->getAttributes();
        if ($tree_rs->parent_id != 0) {
            $this->get_parent($tree_rs->parent_id);
        }
        return $this->breadcrumb;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, array(
            'title' => 'required|max:250',
            'description' => 'required',
            'body' => 'required',
            'images' => 'required|mimes:jpeg,png,bmp',

        ));*/
        /*$this->validate($request, [
            'title' => 'required',
            'brief_description' => 'required',
            'description' => 'required',
        ]);*/
        /*$request->validate([
            'title' => 'required',
            'product_code' => 'required',
            'description' => 'required',
        ]);*/


        $imagesUrl = $this->uploadImages($request->file('images'));
        //$imagesUrl=json_encode($imagesUrl);
        // auth()->user()->article()->create(array_merge($request->all() , [ 'images' => $imagesUrl]));

        //$request->images=$imagesUrl;

        //Content::create($request->all());
        //$data =
        //unset($data['images']);

        $request->offsetSet('parent_id', $request->parent_id[0]);
        $request->offsetSet('type', '2');

        Content::create(array_merge($request->all(), ['images' => $imagesUrl]));

        return Redirect('contents')->with('success', 'Greate! Content created successfully.');
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
        //dd($content_info->images);
        /*print_r($data);

        die();*/
        return view('content.Edit', compact('content_info'));
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
        /*$update = ['title' => $request->title, 'brief_description' => $request->brief_description
            , 'description' => $request->description
            , 'status' => $request->status
            , 'publish_date' => $request->publish_date];
        Content->where('id',$id)->update($update);

        return Redirect::to('contents')
            ->with('success','Great! Product updated successfully');*/

        $crud = Content::find($id);
        $crud->title = $request->get('title');
        $crud->brief_description = $request->get('brief_description');
        $crud->description = $request->get('description');
        $crud->publish_date = $request->get('publish_date');
        $crud->status = $request->get('status');

        $file = $request->file('images');
        //$inputs = $request->all();

        if ($file) {
            $images = $this->uploadImages($request->file('images'));
        } else {
            $images = $crud->images;
            $images['thumb'] = $request->get('imagesThumb');
        }
        $crud->images = $images;

        //unset($inputs['imagesThumb']);
        //$article->update($inputs);

        //return redirect(route('articles.index'));

        $crud->save();
        return redirect('contents');
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

        return redirect('contents');
    }


    public function uploadImageSubject(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
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
}
