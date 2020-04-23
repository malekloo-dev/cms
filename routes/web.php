<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** for clients  */
use Illuminate\Support\Facades\Route;

Route::get('clientChat','ClientsController@clientChat');

Route::post('/contents/upload-image/' , 'ContentController@uploadImageSubject')->name('contents.upload');
//Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');


//Route::resource('home','HomeController');

Route::middleware(['auth'])->group(/**
 *
 */
    function () {

    /** for adminContent  */
    Route::resource('contents', 'ContentController');
    Route::resource('category', 'CategoryController');

/** for admins  */
Route::get('/admin','IndexController@index');

//for questions
Route::post      ('questions/updateBot'   , 'QuestionsController@updateBot');

//for conversation
Route::get      ('conversation/{id}'                        , 'ConversationController@index');
Route::post     ('conversation/find'                        , 'ConversationController@find');
//Route::post     ('conversation/store'                       , 'ConversationController@store');
//Route::post     ('conversation/getConversationByUniqueId'   , 'ConversationController@getConversationByUniqueId');
//Route::post     ('conversation/removeConversationByUniqueId', 'ConversationController@removeConversationByUniqueId');
//Route::post     ('conversation/assignConversationToAdmin'   , 'ConversationController@assignConversationToAdmin');
Route::get      ('offline'                                  , 'ConversationController@offline');
Route::get      ('offline/filter'                           , 'ConversationController@filter');



//for chat list
Route::group(['prefix' => 'chatlist'], function ()
{

    Route::get('/', [
        'as' => 'chatlist.show',
        'uses' => 'ChatListController@index',
        'middleware' => 'auth'
    ]);

    Route::delete('/{id}', [
        'as' => 'chatlist.destroy',
        'uses' => 'ChatListController@destroy',
        'middleware' => 'auth'
    ]);

});

//for users
/*Route::group(['prefix' => 'users'], function ()
{

    Route::get('/', [
        'as' => 'users.index',
        'uses' => 'UserController@index',
        //'middleware' => 'auth'
    ]);


    Route::get('/{user}/edit', [
        'as' => 'users.edit',
        'uses' => 'UserController@edit',
        //'middleware' => 'auth'
    ]);

    Route::PUT('/{user}', [
        'as' => 'users.update',
        'uses' => 'UserController@update',
        //'middleware' => 'auth'
    ]);

    Route::delete('/create', [
        'as' => 'users.create',
        'uses' => 'UserController@destroy',
        //'middleware' => 'auth'
    ]);

});*/


/*Route::get('chatlist', 'ChatListController@index')->middleware('auth');
Route::delete('chatlist/{id}' , 'ChatListController@destroy');*/


Route::resources ([
    'users'     => 'UserController',
    'bots'      => 'BotsController',
    'questions' => 'QuestionsController',
    'clients'   => 'ClientsController'
]);

});
//for auth
Auth::routes();


Route::get('/','HomeController@index');
Route::get('/{slug?}/{b?}','CmsController@request');


