<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use PDF;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public $categoryCombo = array();
    public $listCat;
    public $level = 0;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //$contents = Category::where('type', '=', 1)->orderBy('id', 'desc')->paginate(10);
        $contents = $this->tree_set();
        $contents = $this->convertTemplateTable1($contents);
        //dd($contents);

        // dd($contents);
        return view('admin.category.List', compact('contents'));
    }

    public function index1()
    {

        //return view('vendor.wmenu.scripts');
        // $menulist = Menus::all();
        // return view('vendor.wmenu.menu-html', compact('menulist'));
    }


    protected function uploadImages($file,$type = 'category')
    {
        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";
        $filename = $file->getClientOriginalName();

        $file = $file->move(public_path($imagePath), $filename);
        // $sizes = ["300", "600", "900"];


        $url['images'] = $this->resize($file->getRealPath(), $type, $imagePath, $filename);

        $url['thumb'] = $url['images']['small'];

        return $url;
    }

    private function resize($path, $type, $imagePath, $filename)
    {
        $sizes = array(
                "small"=>env(Str::upper($type).'_SMALL'),
                'medium'=>env(Str::upper($type).'_MEDIUM'),
                'large'=>env(Str::upper($type).'_LARGE')
        );


        $images['original'] = $imagePath . $filename;

        foreach ($sizes as $name => $size) {

            $images[$name] = $imagePath . "{$name}_" . $filename;

            Image::make($path)->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($images[$name]));
        }





        return $images;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $result = $this->tree_set();
        $data['attr_type']=$request->type;
        $data['category'] = $this->convertTemplateSelect1($result);
        return view('admin.category.Create', $data);
    }

    public function convertTemplateSelect1($listCat, $_input = array(), $start = '|-', $befor = '', $after = '', $level = 0)
    {
        static $mainMenu = array();
        if (!count($_input) and count($listCat)) {
            $_input = $listCat[0];
        }
        foreach ($_input as $key => $val) {
            $newStart = str_repeat($befor, $level) . $start;
            $val->level = $level;
            $val->symbol = $newStart;
            $mainMenu[$val->id] = $val;
            ++$level;
            if (isset($listCat[$val['id']])) {
                $this->convertTemplateSelect1($listCat, $listCat[$val['id']], $start, '&nbsp;&nbsp;&nbsp;', $after, $level);
            }
            --$level;
        }

        return $mainMenu;
    }

    public function convertTemplateTable1($listCat, $_input = array(), $start = '|-', $befor = '', $after = '', $level = 0)
    {
        static $mainMenu = array();
        //echo $this->level;
        if (!count($_input) and count($listCat)) {
            $_input = $listCat[0];
        }
        foreach ($_input as $key => $val) {
            $newStart = str_repeat($befor, $level) . $start;

            $val->level = $level;
            $val->symbol = $newStart;
            $mainMenu[$val->id] = $val;
            //$start =  $befor.$start.$after ;
            ++$level;
            //++$this->level;
            if (isset($listCat[$val->id])) {
                $this->convertTemplateTable1($listCat, $listCat[$val->id], $start, '&nbsp;&nbsp;&nbsp;', $after, $level);
            }
            // --$this->level;
            --$level;
            //$len = strlen($space);
            //  $temp = substr($temp, 0, -($len));
        }
        return $mainMenu;
    }


    public function tree_set($searchmap = array())
    {
        $items = Category::where('type', '=', 1);
        foreach ($searchmap as $condition) {
            $items=$items->where($condition[0], $condition[1], $condition[2]);
        }
        $items=$items->orderBy('parent_id', 'desc')->get();
        $list = array();

        foreach ($items as $item) {
            $list[$item->parent_id][] = $item;
        }
        return $list;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $this->validate($request, array(
             'title' => 'required|max:250',
             //'description' => 'required',
             //'body' => 'required',
             //'images' => 'required|mimes:jpeg,png,bmp',

         ));

        $imagesUrl = '';
        if ($request->file('images')) {
            $imagesUrl = $this->uploadImages($request->file('images'));
        }

        $data = $request->all();
        $date = $data['publish_date'];
        $data['publish_date'] = convertJToG($date);
        $data['parent_id'] = $request->parent_id;
        $data['type'] = '1';
        $data['images'] = $imagesUrl;
        if($request->slug==''){
            $data['slug']=$request->title;
        }else{
            $data['slug']=$request->slug;
        }
        $data['slug'] = preg_replace('/\s+/', '-',$data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);

        //Content::create(array_merge($request->all(), ['images' => $imagesUrl]));
        Category::create($data);
        return redirect('admin/category?type=' . $request->attr_type)->with('success', 'Greate! Content created successfully.');
    }

    public function store1(Request $request)
    {
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
        /*print_r($_POST);die();*/

        $data = $request->all();
        $date = $data['publish_date'];
        $data['publish_date'] = convertJToG($date);
        $data['type'] = 1;
        //$data['images']= $imagesUrl;
        if($request->slug==''){
            $data['slug']=$request->title;
        }else{
            $data['slug']=$request->slug;
        }
        $data['slug'] = preg_replace('/\s+/', '-',$data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);

        // Content::create(array_merge($request->all(), ['images' => $imagesUrl]));

        return redirect('admin/category?type=' . $request->attr_type)->with('success', 'Greate! Content created successfully.');
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
        $attr_type = 'CATEGORY';
        $where = array('id' => $id);
        $content_info = Category::where($where)->first();


        /*$searchmap = [
            ['parent_id', '<>', $id],
            ['id', '<>', $id]

        ];*/
        $searchmap=array();
        $result = $this->tree_set($searchmap);

        $category = $this->convertTemplateSelect1($result);
        $filter[$id]='';
        foreach ($category as $id=>$obj) {
            if (isset($filter[$id])) {
                unset($category[$id]);
            }
            if (isset($filter[$obj->parent_id])) {
                $filter[$id]='';
                unset($category[$id]);
            }
        }

        //dd($category);

        //print_r($content_info);
        //die();
        return view('admin.category.Edit', compact(['content_info', 'category','attr_type']));
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

        /*$crud = Content::find($id);
        $crud->title = $request->get('title');
        $crud->brief_description = $request->get('brief_description');
        $crud->description = $request->get('description');
        $crud->publish_date = $request->get('publish_date');
        $crud->status = $request->get('status');
        $crud->save();*/


        $crud = Category::find($id);

        $data = $request->all();
        $date = $data['publish_date'];
        $data['publish_date'] = convertJToG($date);
        $file = $request->file('images');
        //$inputs = $request->all();

        if ($file) {
            $images = $this->uploadImages($request->file('images'));
        } else {
            $images = $crud->images;
            if ($images != '') {
                $images['thumb'] = $request->get('imagesThumb');
            }
        }
        $data['images'] = $images;

        if($request->slug==''){
            $data['slug']=$request->title;
        }else{
            $data['slug']=$request->slug;
        }
        $data['slug'] = preg_replace('/\s+/', '-',$data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);
        $data['slug'] = str_replace('--', '-', $data['slug']);

        $crud->update($data);


        return redirect('admin/category?type=' . $crud->attr_type)->with('success', 'Update! Content created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crud = Category::find($id);
        $attr_type = $crud->attr_type;
        $crud->delete();

        return redirect('admin/category?type=' . $attr_type);
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class);
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

    public function uploadImageSubject1(Request $request)
    {
        //print_r($request);
        $this->validate(request(), [
            'upload' => 'required|mimes:jpeg,png,bmp',
        ]);

        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";

        $file = request()->file('upload');
        $filename = $file->getClientOriginalName();

        if (file_exists(public_path($imagePath) . $filename)) {
            $filename = Carbon::now()->timestamp . $filename;
        }

        $file->move(public_path($imagePath), $filename);
        $url = $imagePath . $filename;

        return "<script>window.parent.CKEDITOR.tools.callFunction(1,'{$url}','')</script>";
    }

    public function categoryTree($parent_id = 0, $sub_mark = '')
    {
        $query = Category::where('type', '=', 1)
            ->where('parent_id', '=', $parent_id)
            ->orderBy('parent_id', 'asc')->get();

        if ($query->count() > 0) {
            foreach ($query as $k => $row) {
                echo $this->categoryCombo[] = '<option value="' . $row->id . '">' . $sub_mark . $row->title . '</option>';
                $this->categoryTree($row->id, $sub_mark . '---');
            }
        }
    }

    public function categoryList()
    {
        $items = category::all();

        $tree = [];
        foreach ($items as $item) {
            $fields['parent_id'] = $item->parent_id;
            $fields['id'] = $item->id;
            $fields['title'] = $item->title;
            $tree[$item->parent_id][] = $fields;


            /*// Create or add child information to the parent node
            if (isset($tree[$pid])) {
                // a node for the parent exists
                // add another child id to this parent
                $tree[$pid]["children"][] = $id;
            } else {
                // create the first child to this parent
                $tree[$pid] = array("children" => array($id));
            }

            // Create or add name information for current node
            if (isset($tree[$id])) {
                // a node for the id exists:
                // set the name of current node
                $tree[$id]["title"] = $title;
            } else {
                // create the current node and give it a name
                $tree[$id] = array("title" => $title);
            }*/
        }

        return $tree;
    }

    public function toUL1(array $array)
    {

        //dd($array);

        $html = '-' . PHP_EOL;
        foreach ($array as $value) {
            //die('dfdfgdf');
            if (!isset($value['title'])) {
                $html .= '-' . 'no parent';
            } else {
                $html .= '-' . $value['title'];
            }

            if (!empty($value['children'])) {
                $html .= $this->toUL($value['children']);
            }
            $html .= '-' . PHP_EOL;
        }

        $html .= '-' . PHP_EOL;
        return $html;
    }

    public function toUL($arr, $pass = 0)
    {
        $html = '<ul>' . PHP_EOL;
        foreach ($arr as $v) {
            $html .= '<li>';
            $html .= str_repeat("--", $pass); // use the $pass value to create the --

            if (!isset($v['title'])) {

                // $html .=  '</li>' . PHP_EOL;
            } else {
                $html .= $v['title'] . '</li>' . PHP_EOL;
            }
            //echo '<pre/>';print_r($v);die();

            if (isset($v['children'])) {

                //if (array_key_exists('children', $v)) {
                $html .= $this->toUL($v['children'], $pass + 1);
            }
        }

        //$html .= '</ul>' . PHP_EOL;
        $html .= '</ul>' . PHP_EOL;
        return $html;
    }

    public function toUL2(array $array)
    {
        $html = '<ul>' . PHP_EOL;

        foreach ($array as $value) {
            if (!isset($value['title'])) {
                $html .= '<li>';
            } else {
                $html .= '<li>' . $value['title'];
            }


            if (!empty($value['children'])) {
                $html .= $this->toUL($value['children']);
            }
            $html .= '</li>' . PHP_EOL;
        }

        $html .= '</ul>' . PHP_EOL;

        return $html;
    }
}
