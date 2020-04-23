<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();


});*/




Route::post('/login', [
    'as' => 'login',
    'uses' => 'AuthController@login'
]);


Route::group(['prefix' => 'questions'], function ()
{
    Route::get('/', [
        'as' => 'users.show.active.questions.bot',
        'uses' => 'QuestionsController@questionsForActiveBot',
        'middleware' => 'auth:api'
    ]);

    Route::post('/ajax', [
        'as' => 'questions.get.ajax',
        'uses' => 'QuestionsController@getQuestionsAjax',
        'middleware' => 'auth:api'
    ]);

});


Route::group(['prefix' => 'conversation'], function ()
{

    Route::post('/getConversationByUniqueId', [
        'as' => 'conversation.getConversationByUniqueId',
        'uses' => 'ConversationController@getConversationByUniqueId',
        'middleware' => 'auth:api'
    ]);

    Route::post('/store', [
        'as' => 'conversation.store',
        'uses' => 'ConversationController@store',
        'middleware' => 'auth:api'
    ]);

    Route::post('/assignConversationToAdmin', [
        'as' => 'conversation.assignConversationToAdmin',
        'uses' => 'ConversationController@assignConversationToAdmin',
        'middleware' => 'auth:api'
    ]);



    Route::post('/conversation/removeConversationByUniqueId', [
        'as' => 'conversation.removeConversationByUniqueId',
        'uses' => 'ConversationController@removeConversationByUniqueId',
        'middleware' => 'auth:api'
    ]);


});



Route::group(['prefix' => 'clients'], function ()
{

    Route::post('/', [
        'as' => 'clients.store',
        'uses' => 'ClientsController@store',
    ]);

    Route::get('/', [
        'as' => 'clients.index',
        'uses' => 'ClientsController@index',
        'middleware' => 'auth:api'
    ]);



});


Route::group(['prefix' => 'bots'], function ()
{
    Route::get('/update/ajax', [
        'as' => 'bots.update.ajax',
        'uses' => 'BotsController@updateBotsAjax',
        'middleware' => 'auth:api'
    ]);
    Route::get('/add/ajax', [
        'as' => 'bots.add.ajax',
        'uses' => 'BotsController@store',
        'middleware' => 'auth:api'
    ]);

});

