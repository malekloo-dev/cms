<?php

namespace App\Http\Controllers;

use App\RedirectUrl;
use App\Http\Requests\RedirectUrlRequest;

class RedirectUrlController extends Controller
{
    public function __construct()
    {
    }

    /* List */
    public function index()
    {
        $RedirectUrl = RedirectUrl::all();

        return view('admin.redirectUrl.index', compact('RedirectUrl'));
    }

    /* Display add Form */
    public function create()
    {
        return view('admin.redirectUrl.create');
    }

    /* Insert */
    public function store(RedirectUrlRequest $request)
    {
        RedirectUrl::create($request->all());

        return redirect()->route('seo.redirectUrl.index')->with('success', $request->url . ' افزوده شد.');
    }

    /* Display edit form */
    public function edit(RedirectUrl $redirectUrl)
    {
        return view('admin.redirectUrl.edit',compact('redirectUrl'));
    }

    /* Update */
    public function update(RedirectUrlRequest $request, RedirectUrl $redirectUrl)
    {
        $redirectUrl->update($request->all());

        return redirect()->route('seo.redirectUrl.index')->with('success',$redirectUrl->url  . ' ویرایش شد.');
    }

    /* Delete */
    public function destroy(RedirectUrl $redirectUrl)
    {
        $redirectUrl->delete();

        return redirect()->route('seo.redirectUrl.index')->with('success', ' حذف شد.');
    }

    /* Display specified item */
    public function show(RedirectUrl $RedirectUrl)
    {
        //
    }
}
