<?php

namespace App\Http\Controllers;

use App\Content;
use App\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ModuleBuilderController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tree = $this->tree_set();
        $menus = $this->convertTemplateTable1($tree);
        return view('admin.moduleBuilder.Edit', compact('menus'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSinglePagePoint($content)
    {
       // {{--#anchor news--}}
        preg_match_all("/({{--#anchor(.*)--}})/U", $content, $pat_array);
        return array_map('trim',$pat_array[2]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {


        //{{--module=category&label=NEWS&count=3&query=last--}}
        //{{--gallery&label=NEWS&count=3&query=last--}}
        $template = 'O:\xampp\htdocs\cms\resources\views\remotyadak\Home.blade.php';
        $content=file_get_contents($template);
        preg_match_all("/({{--category(.*)--}})|({{--product(.*)--}})|({{--post(.*)--}})/U", $content, $pat_array);
        //{gallery&size=10&template=1}
        //parse_str($_SERVER['QUERY_STRING'], $outputArray);


        $module = array('category' => '1', 'product' => '1','post' => '1');
        $count = 0;
        foreach ($pat_array[0] as $key => $val) {

            $moduleStart = substr((explode('--}}', $val)[0]), 4);


            //$value=str_replace('&amp;','&',$moduleStart);
            //parse_str($value, $outputArray);
            // dd($outputArray);
            $moduleStart=str_replace('&amp;','&',$moduleStart);
            $moduleGetAttrArray = (explode('&', $moduleStart));
            $moduleName = $moduleGetAttrArray[0];

            $moduleAttr = array();
            if (count($moduleGetAttrArray) > 1) {
                $queryString = substr($moduleStart, strlen($moduleName));
                parse_str(htmlspecialchars_decode($queryString), $moduleAttr);

            }

            $arrayContent[$count]['type'] = $moduleName;
            $arrayContent[$count]['config'] = $moduleAttr;
            $count++;

        }

        $data['category'] = Content::where('type', '=', '1')
            ->where('publish_date','<=', DB::raw('now()'))
            ->get();

        $data['widgets']= Widget::find(1);
        $data['arrayContent']=$arrayContent;
        //dd($arrayContent);

        return view('admin.moduleBuilder.Edit',$data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $crud = Widget::find(1);
        $data = $request->all();
        $crud->update($data);
       // dd($data);

        return redirect('admin/indexConfig')->with('success', 'Update! Menu Update successfully.');

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
