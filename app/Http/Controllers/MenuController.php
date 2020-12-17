<?php

namespace App\Http\Controllers;

use App\Content;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use App\Services\MenuService;


class MenuController extends Controller
{
    //protected $menuService;


    /**
     * MenuController constructor.
     * @param PostService $postService
     */
    public function __construct()
    {
        //$this->menuService = $menuService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tree = $this->tree_set();
        $menus = $this->convertTemplateTable1($tree);
        return view('admin.menu.List', compact('menus'));
    }

    public function tree_set($searchmap = array())
    {

        $tree = new Menu();
        foreach ($searchmap as $condition) {
            $items=$tree->where($condition[0], $condition[1], $condition[2]);
        }

        $items=$tree->orderBy('parent', 'desc')->get();
        $list = array();
        foreach ($items as $item) {
            $list[$item->parent][] = $item;
        }
        return $list;
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $data['post'] = Content::where('type', '=', '2')
            ->where('attr_type', '=', 'article')
            ->where('publish_date','<=', DB::raw('now()'))
            ->get();

        $data['product'] = Content::where('type', '=', '2')
            ->where('attr_type', '=', 'product')
            ->where('publish_date','<=', DB::raw('now()'))
            ->get();

        $data['category'] = Content::where('type', '=', '1')
            ->where('publish_date','<=', DB::raw('now()'))
            ->get();

       // O:\xampp\htdocs\cms\resources\views\remotyadak
       // $template= asset(env('TEMPLATE_NAME')) ;
       // $template = 'resources'.'/views/'.env('TEMPLATE_NAME') . '/Home.blade.php';
        // $template = 'O:\xampp\htdocs\cms\resources\views\remotyadak\Home.blade.php';
        $template = resource_path('views/'. env('TEMPLATE_NAME') .'/Home.blade.php');

        $data['single_page']=$this->getSinglePagePoint(file_get_contents($template));

        /*$data['type'][0]['lable']='internal';
        $data['type'][0]['lable']='externl';
        $data['type'][0]['lable']='single page';*/
        $tree = $this->tree_set();
        $data['menu'] = $this->convertTemplateSelect1($tree);
        return view('admin.menu.Create', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, array(
            'label' => 'required|max:250',
            'sort' => 'required',
            //'description' => 'required',
            //'body' => 'required',
            //'images' => 'required|mimes:jpeg,png,bmp',

        ));

        $data = $request->all();

        if($data["type" ] =="internal"){
            $data['link'] =Content::find($data["module_id" ])->slug;
        }else
        {
            $data['module']=null;
            $data['module_id']=null;
        }
        //dd($data);
        //Content::create(array_merge($request->all(), ['images' => $imagesUrl]));

        Menu::create($data);
        return redirect('admin/menu')->with('success', 'Greate! Menu created successfully.');
    }
    public function getSinglePagePoint($content)
    {
       // {{--#anchor news--}}
        preg_match_all("/({{--#anchor(.*)--}})/U", $content, $pat_array);
        return array_map('trim',$pat_array[2]);

    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $data['menu_info'] = Menu::where($where)->first();

        /*$searchmap = [
            ['parent_id', '<>', $id],
            ['id', '<>', $id]

        ];*/

        $data['post'] = Content::where('type', '=', '2')
            ->where('attr_type', '=', 'article')
            ->where('publish_date','<=', DB::raw('now()'))
            ->get();

        $data['product'] = Content::where('type', '=', '2')
            ->where('attr_type', '=', 'product')
            ->where('publish_date','<=', DB::raw('now()'))
            ->get();

        $data['category'] = Content::where('type', '=', '1')
            ->where('publish_date','<=', DB::raw('now()'))
            ->get();

        $template = 'O:\xampp\htdocs\cms\resources\views\remotyadak\Home.blade.php';
        $data['single_page']=$this->getSinglePagePoint(file_get_contents($template));


        $searchmap=array();
        $tree = $this->tree_set($searchmap);
        $data['menu'] = $this->convertTemplateSelect1($tree);
        $filter[$id]='';
        foreach ($data['menu'] as $id=>$obj) {
            if (isset($filter[$id])) {
                unset($data['menu'][$id]);
            }
            if (isset($filter[$obj->parent])) {
                $filter[$id]='';
                unset($data['menu'][$id]);
            }
        }

        //print_r($content_info);
        //die();
        return view('admin.menu.Edit',$data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $crud = Menu::find($id);

        $data = $request->all();

        if($data["type" ] =="internal"){

            $data['link'] =Content::find($data["module_id" ])->slug;
        }else
        {
            $data['module']=null;
            $data['module_id']=null;
        }

        $crud->update($data);

        return redirect('admin/menu')->with('success', 'Update! Menu Update successfully.');

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
