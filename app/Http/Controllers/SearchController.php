<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\String_;

class SearchController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        list($products, $posts, $companies) = $this->searchService($request);

        $query = $request->q;


        // search page detail
        $detail = new Content;
        $detail->title = 'صفحه جستجو: ' . $query;
        $detail->description = '';
        $detail->slug = 'search';


        $template = env('TEMPLATE_NAME') . '.Search';

        $breadcrumb[0]['title'] = 'جستجوی ' . $query;
        $breadcrumb[0]['slug'] =  $detail->slug;

        return view($template, [
            'detail' => $detail,
            'products' => $products,
            'posts' => $posts,
            'companies' => $companies,
            'breadcrumb' => $breadcrumb

        ]);
    }

    private function searchService($request, $limit = 10)
    {
        // all data fetch
        $productsObj = $this->getProducts()->limit($limit);
        $postsObj = $this->getPosts()->limit($limit);
        $companiesObj = $this->getCompanies()->limit($limit);
        $query = '';


        //if search query is exists
        if (isset($request->q)) {
            $query = $request->q;

            $productsObj->where('title', 'like', '%' . $query . '%');
            $postsObj->where('title', 'like', '%' . $query . '%');
            $companiesObj->where('name', 'like', '%' . $query . '%');
        }


        // filling array
        $products = $productsObj->get();
        $posts = $postsObj->get();
        $companies = $companiesObj->get();

        return [$products, $posts, $companies];
    }

    private function getProducts()
    {
        return Content::where('type', '=', '2')
            ->where('attr_type', '=', 'product')
            ->where('publish_date', '<=', DB::raw('now()'))
            ->orderBy('publish_date', 'desc')
            ->limit(10);
    }

    private  function getPosts()
    {
        return Content::where('type', '=', '2')
            ->where('attr_type', '=', 'article  ')
            ->where('publish_date', '<=', DB::raw('now()'))
            ->orderBy('publish_date', 'desc')
            ->limit(10);
    }

    private  function getCompanies()
    {
        return  Company::limit(10);
    }

    public function suggest(Request $request)
    {

        list($products, $posts, $companies) = $this->searchService($request, 2);

        $searchResult = array();

        if ($products->count())
            $searchResult['products'] = $products->toArray();

        if ($posts->count())
            $searchResult['posts'] = $posts->toArray();

        if ($companies->count())
            $searchResult['companies'] = $companies->toArray();



        return response($searchResult);
    }
}
