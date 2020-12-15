<?php

namespace App\Http\Controllers;

use App\Content;
use App\Category;
use App\Widget;
use App\WebsiteSetting;
//use App\Home;
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


        //Content::increment('viewCount');
        /*$data['topViewPost'] = Content::where('type','=','2')
            ->orderBy('viewCount', 'desc')
            ->where('publish_date','<=', DB::raw('now()'))
            ->limit(10)->get();

        $data['newPost'] = Content::where('type','=','2')
            ->where('publish_date','<=', DB::raw('now()'))
            ->orderBy('publish_date', 'desc')
            ->limit(10)
            ->get();

        $data['category'] = Category::where('type', '=', '1')
            ->where('parent_id','<>','0')
            ->where('publish_date','<=', DB::raw('now()'))
            ->get();*/


        $data['seo'] = WebsiteSetting::all()->keyBy('variable')->map(function ($name) {
            return strtoupper($name['value']);
        });

        $atr = Widget::find(1)->attr;

        DB::connection()->enableQueryLog();

        foreach ($atr as $var => $config) {

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
                $module=$module->where('type', '=', '1');
            }
            if($config['parent_id']!=0){
                $module=$module->where('parent_id', '=', $config['parent_id']);

            }

            $sort=explode(' ',$config['sort']);
            //dd($sort);

            $module=$module->orderby($sort[0]);
            $module=$module->limit($sort[1]);

            $data[$var] = $module
                ->where('publish_date', '<=', DB::raw('now()'))
                ->limit($config['count'])
                ->get();

        }
        $queries = DB::getQueryLog();

        //dd($queries);

        //$data['arrayContent']=$arrayContent;
        //dd($data);

        return view(@env('TEMPLATE_NAME') . '.Home', $data);
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
