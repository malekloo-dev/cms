<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Conversation;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ConversationController extends Controller
{
    public function __construct()
    {
        //Auth::loginUsingId(1);
        //$this->middleware('auth');
    }

    public function assignConversationToAdmin(Request $request)
    {

        $conversations = Conversation::where('uniq','=',$request->uniq)
        ->where('operator_id' ,'=',NULL)
        ->get();


        foreach ($conversations as $key=>$conversation)
        {
            $conversation->operator_id=$request->operator_id;
            $conversation->save();
        }
        return json_encode($conversations->toArray(),true);


    }


    public function getConversationByUniqueId(Request $request)
    {

        $conversationsResult = Conversation::where('conversations.uniq','=',$request->uniq)
            ->select('conversations.message','conversations.date','conversations.sender','users.name as operator','clients.name as client')
            ->leftJoin('users'   , 'conversations.operator_id', '=' , 'users.id')
            ->leftJoin('clients' , 'clients.uniq'        , '=' ,'conversations.uniq'  )
            ->get();

        //return $conversationsResult;
        /*{"type":"bot"
        "data":{"message":"vaght mikhay?",
        "name":"admin"}*/
        $conversation=array();

        foreach ($conversationsResult as $k => $conv){

            //$name = ($conv->sender == 'bot') ? 'Bot' : $conversationsResult[$k]['name'] ;
            if($conv->sender == 'bot')
            {
                $name='Bot';
            }else if($conv->sender == 'client')
            {
                $name=$conv->client;
            }else if($conv->sender == 'operator')
            {
                $name=$conv->operator;
            }
            $conversation[$k]['type']=$conv->sender;
            $conversation[$k]['name']=$name;
            $conversation[$k]['data']['message']=$conv->message;
            $conversation[$k]['data']['date']=$conv->date;
        }
        return response()->json($conversation);


    }

    public function removeConversationByUniqueId(Request $request)
    {

        return Conversation::where('conversations.uniq','=',$request->uniq)->delete();

    }

    //    public function getConversationByUniqueId(Request $request)
    //    {
    //
    //        $conversations = Conversation::where('conversations.uniq','=',$request->uniq)
    //            ->select('conversations.message','conversations.sender','users.name as operator','clients.name as client')
    //            ->leftJoin('users'   , 'conversations.operator_id', '=' , 'users.id')
    //            ->leftJoin('clients' , 'clients.uniq'        , '=' ,'conversations.uniq'  )
    //            ->get();
    //
    //        /*{"type":"bot"
    //        "data":{"message":"vaght mikhay?",
    //        "name":"admin"}*/
    //
    //        foreach ($conversations as $k => $conv){
    //
    //            $name = ($conv['sender'] == 'bot') ? 'Bot' : $conversations[$k]['name'] ;
    //            $conversations[$k]['name'] = $name;
    //        }
    //
    //        return $conversations;
    //
    //    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {

        $conversation = Conversation::where('operator_id','=',$request->operator_id)
                                    ->where('uniq' ,'=',$request->uniq)
                                    ->get();
        //$conversation = Conversation::where($request->operator_id, $request->uniq);
        print_r($conversation);
        //return $conversation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        print_r('index');

        //die('dffd');
        //echo $request->get('id');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'uniq'=>'required',
            'message'=>'required',
            'sender'=>'required'
        ]);
        $conversation = new Conversation([

            'uniq' => $request->get('uniq'),
            'message' => $request->get('message'),
            'sender' => $request->get('sender'),
            'operator_id' => $request->get('operator_id')

        ]);

        /*if (isset($request->operator_id)){
            $conversation->operator_id=$request->operator_id;
        }*/
        $conversation->save();

        return json_encode($conversation);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }

    public function offline()
    {
        return view('offline');
    }
    public function filter(Request $request)
    {

        //print_r($request);
        //die();
        $properties=array( 'uniq', 'message','sender','operator_id');
        //$data=Conversation::query()->where('operator_id','=','offline')->filter($request->all(),$properties);
        $data=Conversation::query()->filter($request->all(),$properties);


        return response()->json($data);

    }
}
