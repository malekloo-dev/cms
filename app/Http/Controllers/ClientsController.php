<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;


class ClientsController extends Controller
{
    public function __construct()
    {
        //Auth::loginUsingId(1);
        //$this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Clients[]|Collection
     */
    public function index()
    {
        $clients = Clients::all();

        return $clients;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {


        $request->validate([
            'name'=>'required',
            'uniq'=>'required'
        ]);
        $clients = Clients::where("uniq",'=',$request->get('uniq'))->get();


        if(!count($clients)){
            $clients = new Clients([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'uniq' => $request->get('uniq')
            ]);
            $clients->save();

        }

        $res['result'] = 1;
        return  json_encode($res);
    }

    /**
     * Display the specified resource.s
     *
     * @param Clients $clients
     * @return Response
     */
    public function show($id)
    {

        $clients = Clients::findOrFail($id);

        //return view('index', compact('$clients'));
        return $clients;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Clients $clients
     * @return Response
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Clients $clients
     * @return Response
     */
    public function update(Request $request, Clients $clients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Clients $clients
     * @return Response
     */
    public function destroy(Clients $clients)
    {
        //
    }

    function clientChat(UrlGenerator $UrlGenerator){
        $hostname = parse_url($UrlGenerator->asset('/'))['host'];
        return view('clientChat',compact('hostname'));
    }

}
