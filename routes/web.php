<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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





Route::resources ([
    'users'     => 'UserController',


    'clients'   => 'ClientsController'
]);

});

//for auth
Auth::routes();


Route::get('/','HomeController@index');
Route::get('/{slug?}/{b?}','CmsController@request');


