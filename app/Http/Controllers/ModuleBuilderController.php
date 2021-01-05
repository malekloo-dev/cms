<?php

namespace App\Http\Controllers;

use App\Content;
use App\Menu;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getSinglePagePoint($content)
    {
        // {{--#anchor news--}}
        preg_match_all("/({{--#anchor(.*)--}})/U", $content, $pat_array);
        return array_map('trim', $pat_array[2]);

    }


    protected function uploadImages($file, $module = '')
    {
        $imagePath = "/upload/images/modules/".$module."/";
        $filename = $file->getClientOriginalName();
        $file = $file->move(public_path($imagePath), $filename);

        return $imagePath . $filename;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        //{{--module=category&label=NEWS&count=3&query=last--}}
        //{{--gallery&label=NEWS&count=3&query=last--}}
        // $template = 'O:\xampp\htdocs\cms\resources\views\remotyadak\Home.blade.php';
        $template = resource_path('views/' . env('TEMPLATE_NAME') . '/Home.blade.php');


        $content = file_get_contents($template);
        preg_match_all("/({{--category&(.*)--}})|({{--categoryDetail&(.*)--}})|({{--product&(.*)--}})|({{--post(.*)--}})|({{--counter(.*)--}})|({{--images(.*)--}})/U", $content, $pat_array);
        //{gallery&size=10&template=1}
        //parse_str($_SERVER['QUERY_STRING'], $outputArray);
        $module = array('category' => '1', 'product' => '1', 'post' => '1');
        $count = 0;

        foreach ($pat_array[0] as $key => $val) {

            $moduleStart = substr((explode('--}}', $val)[0]), 4);


            //$value=str_replace('&amp;','&',$moduleStart);
            //parse_str($value, $outputArray);
            // dd($outputArray);
            $moduleStart = str_replace('&amp;', '&', $moduleStart);
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
            ->where('publish_date', '<=', DB::raw('now()'))
            ->get();
        $data['widgets'] = Widget::find(1);
        $data['arrayContent'] = $arrayContent;
      //  dd($data);

        return view('admin.moduleBuilder.Edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $crud = Widget::find(1);
        $data = $request->all();
        foreach ($data['attr'] as $k => $v) {
            if ($v['type'] == 'images')
            {
                //continue;
                $images = array();
                if (isset($crud['attr'][$k]['images'])) {
                    $images = $crud['attr'][$k]['images'];
                }

                if (isset($v['images'])) {
                    foreach ($v['images'] as $index => $image) {
                        if (isset($v['delete'][$index])) {
                            continue;
                        }
                        //if($image->mimeType)
                        //echo '<pre/>';

                        $pos = strpos($image->getMimeType(), 'video');
                        if ($pos === false) {
                            $images[$index] = $this->uploadImages($image,'images');

                        }else
                        {
                            $images[0] = $this->uploadImages($image,'images');
                            break;

                        }


                    }
                }
                if (isset($v['delete'])) {

                    foreach ($v['delete'] as $index => $image) {
                            unset($images[$index]);
                            continue;
                    }
                }
                $mimeType='image';
                foreach ($images as $index => $image) {
                    $pos = strpos($image, 'mp4');
                    if ($pos === false) {
                        $SortImages[]=$image;

                    }else
                    {
                        $SortImages=array();
                        $SortImages[]=$image;
                        $mimeType='video';
                        break;

                    }
                }
                $data['attr'][$k]['images'] = $SortImages;
                $data['attr'][$k]['mimeType'] = $mimeType;
            }else
            {

                if (isset($v['background'])) {
                    $data['attr'][$k]['background'] = $this->uploadImages($v['background'],'list');
                }

            }

        }

        $crud->update($data);
         //dd($data);

        return redirect('admin/indexConfig')->with('success', 'Update! Menu Update successfully.');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
