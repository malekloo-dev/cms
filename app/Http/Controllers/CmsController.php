<?php

namespace App\Http\Controllers;

use App\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use App\RedirectUrl;
use App\Widget;
use PDF;

class CmsController extends Controller
{
    public $breadcrumb;


    public function request($slug)
    {
        // redirect url
        $spesifiedUrl = RedirectUrl::where('url', 'like', '/' . $slug);
        if ($spesifiedUrl->exists()) {
            header("Location: " . url($spesifiedUrl->first()->redirect_to), true, 301);
            exit();
        }

        // detail
        $detail = Content::where('slug', '=', $slug)
            ->where('publish_date', '<=', DB::raw('now()'))
            ->first();
        // dd($detail->comments);
        if ($detail === null) {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return  response()
                ->view(env('TEMPLATE_NAME') . '.NotFound', $data, 404);
        }

        $this->breadcrumb[] = $detail->getAttributes();
        $breadcrumb = $this->get_parent($detail->parent_id);
        if (is_array($breadcrumb)) {
            krsort($breadcrumb);
        } else {
            $breadcrumb = array();
        }

        $seo['meta_keywords'] = $detail->meta_keywords;
        $seo['meta_description'] = $detail->meta_description;
        $seo['url'] = url('/') . '/' . $slug;
        $seo['meta_title'] = $detail->meta_title;
        $seo['og:title'] = $detail->title;
        $seo['og:type'] = 'article';



        $table_of_content = array();
        $table_of_images = array();
        $images = array();
        if (strlen($detail->description)) {
            $resultTableContent = $this->tableOfContent($detail->description);
            $detail->description = $resultTableContent['content'];
            //echo '<pre/>';
            //print_r($resultTableContent);
            //die();
            //dd( $detail->description);
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
        $editorModule = editorModule($detail->description);



        if ($detail->type == 1) {
            $relatedPost = Content::where('type', '=', '2')
                ->where('attr_type', '=', 'article')
                ->where('parent_id', '=', $detail->id)
                ->where('publish_date', '<=', DB::raw('now()'))
                ->get();
            $relatedProduct = Content::where('type', '=', '2')
                ->where('attr_type', '=', 'product')
                ->where('parent_id', '=', $detail->id)
                ->where('publish_date', '<=', DB::raw('now()'))
                ->paginate(20);
            // ->get();


            // dd($relatedProduct->links());
            $subCategory = Content::where('type', '=', '1')
                ->where('parent_id', '=', $detail->id)
                ->where('publish_date', '<=', DB::raw('now()'))
                ->get();

            $template = env('TEMPLATE_NAME') . '.cms.DetailCategory';
            //Widget
            $widget = $this->getWidget('DetailCategory');

            if ($detail->attr_type == 'html') {
                $widget = $this->getWidget($detail->attr['template_name']);
                $template = env('TEMPLATE_NAME') . '.cms.' . $detail->attr['template_name'];
            }
            //dd($detail);
            // dd($relatedProduct->links());



            return view($template, $widget,[
                'detail' => $detail,
                'relatedProduct' => $relatedProduct,
                'relatedPost' => $relatedPost,
                'breadcrumb' => $breadcrumb,
                'table_of_content' => $table_of_content,
                'subCategory' => $subCategory,
                'images' => $images,
                'seo' => $seo,
                'editorModule' => $editorModule
            ]);
        } else {
            $relatedPost = Content::where('type', '=', '2')
                ->where('parent_id', '=', $detail->parent_id)
                ->where('id', '<>', $detail->id)
                ->where('attr_type', '=', 'article')
                ->where('publish_date', '<=', DB::raw('now()'))
                ->inRandomOrder()
                ->limit(4)->get();

            $relatedProduct = Content::where('type', '=', '2')
                ->where('parent_id', '=', $detail->parent_id)
                ->where('id', '<>', $detail->id)
                ->where('attr_type', '=', 'product')
                ->where('publish_date', '<=', DB::raw('now()'))
                ->inRandomOrder()
                ->limit(4)->get();

            $template = env('TEMPLATE_NAME') . '.cms.Detail';
            $widget = $this->getWidget('Detail');
            if ($detail->attr_type == 'html') {
                $widget = $this->getWidget($detail->attr['template_name']);
                $template = env('TEMPLATE_NAME') . '.cms.' . $detail->attr['template_name'];
            }

            //$detail->description=editorModule($detail->description);

            return view($template, $widget,compact([
                'detail',
                'breadcrumb',
                'relatedPost',
                'table_of_content',
                'relatedProduct',
                'table_of_images',
                'seo',
                'editorModule'
            ]));
        }
    }

    public function getWidget($fileName)
    {


        // $attr = Widget::find(1);
        $attr = Widget::where('file_name', '=', $fileName)->first();

        if (is_object($attr)) {
            $attr = $attr->attr;
        } else {
            $attr = array();
        }
        
        $data = array();
        foreach ((array) $attr as $var => $config) {



            if ($config['type'] == 'images') {
                $data[$var] = $config;
                unset($data[$var]['count']);
                unset($data[$var]['type']);

                continue;
            }
            if ($config['type'] == 'counter') {
                $data[$var] = $config;
                unset($data[$var]['count']);
                unset($data[$var]['type']);
                continue;
            }
            $type = '';
            //$data[$var] =new Content();
            $module = new Content();

            if ($config['type'] == 'post') {
                $module = $module->where('type', '=', '2');
                $module = $module->where('attr_type', '=', 'article');
            } else if ($config['type'] == 'product') {
                $module = $module->where('type', '=', '2');
                $module = $module->where('attr_type', '=', 'product');
            } else if ($config['type'] == 'category') {
                $module = $module->where('type', '=', '1');
            } else if ($config['type'] == 'categoryDetail') {
                $module = $module->where('type', '=', '1')->where('id', '=', $config['parent_id']);
            }
            if ($config['parent_id'] != 0 and $config['type'] != 'categoryDetail') {
                $module = $module->where('parent_id', '=', $config['parent_id']);
            }

            $sort = explode(' ', $config['sort']);

            $module = $module->orderby($sort[0], $sort[1]);


            $module = $module
                ->where('publish_date', '<=', DB::raw('now()'))
                ->limit($config['count']);

            if ($config['type'] == 'categoryDetail') {
                $data[$var]['data'] = $module->first();
            } else {
                $data[$var]['data'] = $module->get();

                // get children
                if (isset($config['child']) && $config['child'] == 'true') {
                    $data[$var]['data'] = $this->getCatChildOfcontent($config['parent_id'], $data[$var]['data']);
                }
            }
            if (isset($config['background'])) {
                $data[$var]['meta']['background'] = $config['background'];
            }
        }

        return $data;
    }
    function getCatChildOfcontent($parentId, $temp)
    {
        $cat =  Content::where([['parent_id', '=', $parentId], ['type', '=', 1]])->get()->toArray();


        $content =  Content::where([['parent_id', '=', $parentId], ['type', '=', 2]])
        ->where('publish_date', '<=', DB::raw('now()'))->get();
        $temp = $temp->merge($content);

        if (count($cat) == 0) {
            return $temp;
        } else {
            foreach ($cat as $k => $v) {
                $temp =  $this->getCatChildOfcontent($v["id"], $temp);
            }
            return $temp;
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
        function cleareText($val)
        {
            return  trim(clearHtml(str_replace('&nbsp;', ' ', $val)));
        }

        //$table=$winners;
        $table_of_content = '';
        $count = 0;
        $list['list'] = array();
        foreach ($winners[1] as $key => $val) {
            $item = str_replace(' ', '-', $val);
            $label = cleareText($val);
            $anchor = cleareText($item);
            if (strlen($anchor) == 0) {
                continue;
            }
            $list['list'][$count]['label'] = $label;
            $list['list'][$count]['anchor'] = $anchor;
            $table_of_content = '';
            $anchor = '<a name="' . str_replace(' ', '-', cleareText($val)) . '"></a>' . $winners[0][$key];
            $content = str_replace($winners[0][$key], $anchor, $content);

            $count++;
        }
        //echo '<pre/>';
        //print_r($list);
        //dd();

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
