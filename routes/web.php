<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


App::setLocale(env('LANG'));


//Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

Route::prefix('/admin')->middleware(['auth'])->group(function () {

    Route::post('contents/upload-image/', 'ContentController@uploadImageSubject')->name('contents.upload');

    //Auth::routes(['register' => false]);

    Route::get('/', 'IndexController@index')->name('admin');



    /** for adminContent  */
    //Route::resource('contents', 'ContentController');
    //Route::resource('contents', 'ContentController');
    Route::get('contents', 'ContentController@index')->name('contents.index');
    Route::get('contents/create', 'ContentController@create')->name('contents.create');

    Route::get('contents/{type}', 'ContentController@index')->name('contents.show');
    Route::post('contents', 'ContentController@store')->name('contents.store');
    Route::delete('contents/{content}', 'ContentController@destroy')->name('contents.destroy');
    Route::PATCH('contents/{content}', 'ContentController@update')->name('contents.update');
    Route::get('contents/{content}/edit', 'ContentController@edit')->name('contents.edit');

    Route::get('comment','CommentController@index')->name('comment.index');
    Route::delete('comment','CommentController@destroy')->name('comment.destroy');
    Route::get('comment/{comment}/edit','CommentController@edit')->name('comment.edit');
    Route::patch('comment/{comment}','CommentController@update')->name('comment.update');
    Route::delete('comment/{comment}', 'CommentController@destroy')->name('comment.destroy');

    Route::prefix('seo')->name('seo.')->group(function () {
        Route::resource('redirectUrl', 'RedirectUrlController');
        Route::get('websiteSetting','WebsiteSettingController@edit')->name('websiteSetting.edit');
        Route::patch('websiteSetting','WebsiteSettingController@update')->name('websiteSetting.update');
    });

    Route::resource('category', 'CategoryController');
    Route::resource('menu', 'MenuController');

    Route::get('indexConfig','ModuleBuilderController@edit')->name('moduleBuilder.edit');
    Route::patch('indexConfig/{id}','ModuleBuilderController@update')->name('moduleBuilder.update');

    Route::resources([
        'clients'   => 'ClientsController',
        'users' => 'UserController'
    ]);
});

Auth::routes(['register' => false]);

Route::get('spider','SpiderController@spider');
Route::get('/spider/reload', 'SpiderController@reload');
Route::post('/spider/addToCms', 'SpiderController@reloadAdd');


//Route::get('/search/', 'inventoryController@index')->name('inventory.show');
//Route::post('/search/', 'inventoryController@index')->name('inventory.search');

Route::get('/', 'HomeController@index');
Route::get('/reload', 'ContentController@reload');

Route::get('/{slug?}/{b?}', 'CmsController@request');

Route::post('/comment','CommentController@store')->name('comment.store');
