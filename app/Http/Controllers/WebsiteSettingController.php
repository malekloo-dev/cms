<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    public function __construct()
    {
    }

    /* List */
    // public function index()
    // {
    //     $data = WebsiteSetting::all();

    //     return view('admin.WebsiteSetting.index', compact('data'));
    // }

    /* Display add Form */
    // public function create()
    // {
    //     return view('admin.redirectUrl.create');
    // }

    /* Insert */
    // public function store(RedirectUrlRequest $request)
    // {
    //     RedirectUrl::create($request->all());

    //     return redirect()->route('seo.redirectUrl.index')->with('success', $request->url . ' افزوده شد.');
    // }

    /* Display edit form */
    public function edit(WebsiteSetting $websiteSetting)
    {
        $websiteSetting = WebsiteSetting::all();
        $data=array();
        foreach($websiteSetting as $k => $v){
            $data[$v->variable] = $v->value;
        }
        return view('admin.websiteSetting.edit',compact('data'));
    }

    /* Update */
    public function update(Request $request)
    {

        foreach($request->all() as $variabl => $value){
            if(in_array($variabl,array('_token','_method'))) continue;
            $obj = WebsiteSetting::where('variable','=',$variabl)->get();
            if(count($obj)){
                $obj[0]->value = $value;
                $obj[0]->save();
            }
        }

        return redirect()->route('seo.websiteSetting.edit')->with('success', ' ویرایش شد.');
    }

    /* Delete */
    // public function destroy(RedirectUrl $redirectUrl)
    // {
    //     $redirectUrl->delete();

    //     return redirect()->route('seo.redirectUrl.index')->with('success', ' حذف شد.');
    // }

    /* Display specified item */
    // public function show(RedirectUrl $RedirectUrl)
    // {
    //     //
    // }
}
