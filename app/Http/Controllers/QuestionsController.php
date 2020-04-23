<?php

namespace App\Http\Controllers;

use App\Bots;
use App\Questions;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    public function __construct()
    {
        //Auth::loginUsingId(1);
        //$user->unsignid()
        //$this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $botId
     * @param UrlGenerator $UrlGenerator
     * @return \Illuminate\Http\Response
     */
    public function show($botId,UrlGenerator $UrlGenerator)
    {

        $operatorId = Auth::user()->id;
        $name = Auth::user()->name;

        $hostname = parse_url($UrlGenerator->asset('/'))['host'];

        return view('questions/index', compact('botId','hostname','operatorId','name'));
    }

    function questionsForActiveBot(){
        $activeBot = Bots::where('status','=',1)->first();
        $questions = Questions::where('bot_id','=',$activeBot->id)->orderBy('priority','asc')->get()->keyBy('element_id');
        foreach ($questions as $k => $question){

            $questions[$k]->params = json_decode($question->params);
        }
        return $questions;
    }

    function getQuestions($botId)
    {
        return  Questions::where('bot_id','=',$botId)->orderBy('priority','asc')->get();
    }

    function getQuestionsAjax(Request $request)
    {

        $botId = $request->botId;
        $questions = $this->getQuestions($botId);
        foreach ($questions as $k => $question){

            $questions[$k]->params = json_decode($question->params);
        }

        return $questions;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $questions)
    {
        //
    }

    public function updateBot(Request $request)
    {


        $data = json_decode($request->data);
        Questions::where('bot_id','=',(int)$request->bot_id)->delete();
        foreach ($data as $item){

            $question = new Questions([
                'bot_id' => (int)$request->bot_id,
                'element_id' => $item->element_id,
                'message' => $item->message,
                'type' => $item->type,
                'params' => json_encode($item->params),
                'priority' => $item->priority

            ]);

            $question->save();

        }

        $result['result'] = 1;
        $result['msg'] = "Create successfully.";

        return $result;

    }
}
