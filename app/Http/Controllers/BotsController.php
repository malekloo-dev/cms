<?php

namespace App\Http\Controllers;

use App\Bots;
use App\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BotsController extends Controller
{
    public function __construct()
    {
        //Auth::loginUsingId(1);
        //$this->middleware('auth');

        //  $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bots = Bots::all();

        return view('bots/index',compact('bots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('bots/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);


        $bots = Bots::whereName($request->get('name'))->get();

        if(!count($bots)){
            $bots = new Bots([
                'name' => $request->get('name'),
                'status' => $request->get('status')
            ]);

            $bots->save();

        }

//        return  redirect()->route('bots.index');
        $res['result'] = 1;
        $res['bot_id'] = $bots->id;
        return json_encode($res);
    }

    /**
     * Display the specified resource.
     *
     * @param Bots $bots
     * @return \Illuminate\Http\Response
     */
    public function show(Bots $bots)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bots $bots
     * @return \Illuminate\Http\Response
     */
    public function edit(Bots $bots)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Bots $bots
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bots $bots)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bots $bots
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bots = Bots::whereId($id)->get();

        if(count($bots)){
            $bots[0]->delete();
        }

        return redirect()->route('bots.index');
    }

    function updateBotsAjax(Request $request){

        foreach ($request->all() as $bot){

            $update = Bots::find($bot['botId']);
            $update->status = $bot['status'];
            $update->save();

        }

        $res['result'] = 1;
        return json_encode($res);

    }


}
