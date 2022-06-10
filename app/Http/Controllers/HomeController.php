<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Category;
use App\Models\Company;
use App\Models\Widget;
use App\Models\WebsiteSetting;
use Carbon\Carbon;
use DOMDocument;
use DOMXPath;
// use Contents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $data['seo'] = WebsiteSetting::all()->keyBy('variable')->map(function ($name) {
            return strtoupper($name['value']);
        });

        // $attr = Widget::find(1);
        $attr = Widget::where('file_name', '=', 'Home')->first();
        if (is_object($attr)) {
            $attr = $attr->attr;
        } else {
            $attr = array();
        }
        //DB::connection()->enableQueryLog();
        // dd($attr);
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
            if ($config['type'] == 'post') {
                if ($config['parent_id'] == 0) {

                    $module = new Content();

                    $module = $module->where('type', '=', '2');

                    $sort = explode(' ', $config['sort']);

                    $module = $module->orderby($sort[0], $sort[1]);

                    $module = $module
                        ->where('publish_date', '<=', DB::raw('now()'))
                        ->limit($config['count']);

                    $data[$var]['data'] = $module->get();


                    continue;
                }

                $category = Category::find($config['parent_id']);
                $sort = explode(' ', $config['sort']);


                $data[$var]['data'] = $category->posts($sort[0], $sort[1])->limit($config['count'])->get();
                continue;
            }

            if ($config['type'] == 'product') {

                if ($config['parent_id'] == 0) {
                    // dd(Carbon::now());
                    $data[$var]['data'] = Content::where('publish_date', '<=', Carbon::now())->where('status', '=', 1)->where('attr_type', '=', 'product')->orderBy('publish_date', 'desc')->limit($config['count'])->get();
                    // dd($data[$var]['data']);
                    continue;
                }
                // $data[$var]['data'] = $category->products($sort[0], $sort[1])->limit($config['count'])->get();

                // $category = Category::find($config['parent_id']);

                $category = Category::find($config['parent_id']);
                $sort = explode(' ', $config['sort']);

                // dd($config['parent_id']);
                if ($category)
                    $data[$var]['data'] = $category->products($sort[0], $sort[1])->limit($config['count'])->get();
                continue;
            }
            $type = '';
            //$data[$var] =new Content();
            $module = new Content();

            if ($config['type'] == 'post') {
                // $module = $module->where('type', '=', '2');
                // $module = $module->where('attr_type', '=', 'article');
            } else if ($config['type'] == 'product') {
                // $module = $module->where('type', '=', '2');
                // $module = $module->where('attr_type', '=', 'product');
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
                // if ($var == 'topViewPost') {
                //     echo $config['type'];
                //     dd($module);
                // }
                // get children
                if (isset($config['child']) && $config['child'] == 'true') {
                    $data[$var]['data'] = $this->getCatChildOfcontent($config['parent_id'], $data[$var]['data'], $config);
                }
            }
            if (isset($config['background'])) {
                $data[$var]['meta']['background'] = $config['background'];
            }
        }

        $data['companies'] = Company::limit(6)->where('companies.status','=',1)->orderBy('id','desc')->get();
        // dd($data['companies']);

        // $queries = DB::getQueryLog();

        // dd($queries);
        // dd($data);

        //$data['arrayContent']=$arrayContent;
        // dd($data);
        //dd(env("TEMPLATE_NAME"));

        return view(env("TEMPLATE_NAME") . '.Home', $data);
    }

    function getCatChildOfcontent($parentId, $temp, $config)
    {

        if (count($temp) >= $config['count']) return $temp;

        $cat =  Content::where([['parent_id', '=', $parentId], ['type', '=', 1]])->get()->toArray();


        $content =  Content::where([['parent_id', '=', $parentId], ['type', '=', 2]])
            ->where('publish_date', '<=', DB::raw('now()'))->get();
        $temp = $temp->merge($content);

        if (count($cat) == 0) {
            return $temp;
        } else {
            foreach ($cat as $k => $v) {
                $temp =  $this->getCatChildOfcontent($v["id"], $temp, $config);
            }
            return $temp;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        //Home::create($request->all());

        return Redirect('Homes')->with('success', 'Greate! Home created successfully.');
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
        // $data['Home_info'] = Home::where($where)->first();
        /*print_r($data);

        die();*/
        // return view('Home.edit', $data);
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
        Home->where('id',$id)->update($update);

        return Redirect::to('Homes')
            ->with('success','Great! Product updated successfully');*/

        // $crud = Home::find($id);
        // $crud->title = $request->get('title');
        // $crud->brief_description = $request->get('brief_description');
        // $crud->description = $request->get('description');
        // $crud->publish_date = $request->get('publish_date');
        // $crud->status = $request->get('status');
        // $crud->save();
        // return redirect('Homes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $crud = Home::find($id);
        // $crud->delete();

        // return redirect('Homes');
    }
}
