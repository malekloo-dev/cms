<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use CKSource\CKFinderBridge\Controller\CKFinderController;

App::setLocale(env('SITE_LANG'));

//Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

Route::any('/ckfinder/connector', [CKFinderController::class,'requestAction'])
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', [CKFinderController::class,'browserAction'])
    ->name('ckfinder_browser');

Route::prefix('/admin')->middleware(['auth'])->group(function () {

    Route::post('contents/upload-image/', 'ContentController@uploadImageSubject')->name('contents.upload');

    Route::get('/', 'IndexController@index')->name('admin');


    /** for adminContent  */
    //Route::resource('contents', 'ContentController');
    Route::get('contents', 'ContentController@index')->name('contents.index');
    Route::get('contents/create', 'ContentController@create')->name('contents.create');

    Route::get('contents/{type}', 'ContentController@index')->name('contents.show');
    Route::post('contents', 'ContentController@store')->name('contents.store');
    Route::delete('contents/{content}', 'ContentController@destroy')->name('contents.destroy');
    Route::PATCH('contents/{content}', 'ContentController@update')->name('contents.update');
    Route::get('contents/{content}/edit', 'ContentController@edit')->name('contents.edit');


    Route::prefix('seo')->name('seo.')->group(function () {
        Route::resource('redirectUrl', 'RedirectUrlController');
        Route::get('websiteSetting','WebsiteSettingController@edit')->name('websiteSetting.edit');
        Route::patch('websiteSetting','WebsiteSettingController@update')->name('websiteSetting.update');
    });

    Route::resource('category', 'CategoryController');
    Route::resource('menu', 'MenuController');

    Route::get('indexConfig','ModuleBuilderController@edit')->name('moduleBuilder.edit');
    Route::patch('indexConfig/{id}','ModuleBuilderController@update')->name('moduleBuilder.update');

    Route::get('fileManager','FileManagerController@index')->name('fileManager.index');
    Route::resources([
        'clients'   => 'ClientsController',
        'users' => 'UserController',
        'contact' => 'ContactController',
        'comment' => 'CommentController'
    ]);
});


Route::get('/search', 'InventoryController@index')->name('inventory.show');
Route::post('/search', 'InventoryController@index')->name('inventory.search');

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
Route::post('/contact','ContactController@store')->name('contact.store');
