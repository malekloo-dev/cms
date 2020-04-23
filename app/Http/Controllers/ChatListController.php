<?php

namespace App\Http\Controllers;

use App\User;
use App\Clients;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;

class ChatListController extends Controller
{
    public function __construct()
    {
        //Auth::loginUsingId(1);
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @param UrlGenerator $UrlGenerator
     */
    public function index(UrlGenerator $UrlGenerator)
    {

        $operatorId = Auth::user()->id;

        $operatorName = Auth::user()->name;

        $hostname = parse_url($UrlGenerator->asset('/'))['host'];


        $clients = Clients::query()
            ->leftJoin('conversations','conversations.uniq','=','clients.uniq')
            ->leftJoin('users','users.id','=','conversations.operator_id')
            ->select([
                "clients.uniq",
                "clients.name",
                "clients.email",
                "conversations.message",
                "conversations.sender",
                "conversations.operator_id",
                "conversations.date",
                "users.name as operator_name"
            ])
            ->get()
            ->groupBy('uniq');
        $clients = $clients->toArray();
        $users = array();

        foreach ($clients as $k => $client){


            $users[$k]['uniq'] = $k;
            $users[$k]['name'] = array_column($client,'name')[0];
            $users[$k]['email'] = array_column($client,'email')[0];
            foreach ($client as $conv){

                $type = ($conv['sender'] == 'client')? 'client' : 'operator';
                $name = ($conv['sender'] == 'client') ? $users[$k]['name'] : (($conv['operator_name'] != '') ? $conv['operator_name']:'bot') ;
                $icon = ($conv['sender'] == 'bot') ? 'bot' : $type ;
                $users[$k]['conversations'][] = array(
                    "message" => $conv['message'],
                    "sender" => $conv['sender'],
                    "operator_id" => $conv['operator_id'],
                    "date" => $conv['date'],
                    "type" => $type,
                    "name" => $name,
                    "icon" => $icon

                );
            }
        }

        return view('chatlist',compact('operatorId','operatorName','hostname','users'));
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
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();
    }
}
