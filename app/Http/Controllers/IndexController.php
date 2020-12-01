<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
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
        $data['articlesCount'] = Content::where('type', '=', '1')
            ->orderBy('viewCount', 'desc')
            ->where('publish_date', '<=', DB::raw('now()'))
            ->count();

        $data['productsCount'] = Content::where('type', '=', '2')
            ->where('publish_date', '<=', DB::raw('now()'))
            ->count();

        $data['commentsCount'] = Comment::count();

        return view('admin.index', compact('data'));
    }
}
