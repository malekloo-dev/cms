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


//Route::post('/login'   , 'AuthController@login');

Route::post('/login', [
    'as' => 'login',
    'uses' => 'AuthController@login'
]);

Route::group(['prefix' => 'users'], function ()
{
    Route::get('/', [
        'as' => 'users.show',
        'uses' => 'UserController@index1',
        'middleware' => 'auth:api'
    ]);


});

//$app->get('login/','UsersController@authenticate');

/*Route::get('/questions'   , 'QuestionsController@questionsForActiveBot');
Route::post('/questions/ajax'   , 'QuestionsController@getQuestionsAjax');

Route::post('/bots/update/ajax'   , 'BotsController@updateBotsAjax');
Route::post('/bots/add/ajax'   , 'BotsController@store');


Route::post('/clients/add'   , 'ClientsController@store');*/

