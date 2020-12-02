<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\SpiderService;


class SpiderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //Auth::loginUsingId(1);
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function spider(SpiderService $sp)
    {
        $sp::dorsam();
    }
    public function reload(SpiderService $sp)
    {
        return $sp::reload();

    }
    public function addToCms(SpiderService $sp,Request $request)
    {

        return $sp::addToCms($request);
    }


}
