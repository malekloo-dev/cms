<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/contents/upload-image/', 'ContentController@uploadImageSubject')->name('contents.upload');
//Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');


Route::prefix('/admin')->middleware(['auth'])->group(function () {


    //Auth::routes(['register' => false]);

    Route::get('/', 'IndexController@index')->name('admin');



    /** for adminContent  */
    //Route::resource('contents', 'ContentController');
    //Route::resource('contents', 'ContentController');
    Route::get('contents', 'ContentController@index')->name('contents.index');
    Route::get('contents/{type}', 'ContentController@index')->name('contents.show');
    Route::post('contents', 'ContentController@store')->name('contents.store');
    Route::get('contents/create', 'ContentController@create')->name('contents.create');
    Route::delete('contents/{content}', 'ContentController@destroy')->name('contents.destroy');
    Route::put('contents/{content}', 'ContentController@update')->name('contents.update');
    Route::get('contents/{content}/edit', 'ContentController@edit')->name('contents.edit');

    Route::resource('category', 'CategoryController');



    Route::resources([
        'clients'   => 'ClientsController',
        'users' => 'UserController'
    ]);
});

Auth::routes(['register' => false]);


//Route::get('/search/', 'inventoryController@index')->name('inventory.show');
//Route::post('/search/', 'inventoryController@index')->name('inventory.search');

Route::get('/', 'HomeController@index');
Route::get('/{slug?}/{b?}', 'CmsController@request');
