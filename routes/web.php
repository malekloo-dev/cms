<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/contents/upload-image/', 'ContentController@uploadImageSubject')->name('contents.upload');
//Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');


Route::prefix('/admin')->middleware(['auth'])->group(function () {


    //Auth::routes(['register' => false]);

    Route::get('/', 'IndexController@index')->name('admin');



    /** for adminContent  */
    Route::resource('contents', 'ContentController');
    Route::resource('category', 'CategoryController');



    Route::resources([
        'clients'   => 'ClientsController',
        'users' => 'UserController'
    ]);
});

Auth::routes(['register' => false]);



Route::get('/', 'HomeController@index');
Route::get('/{slug?}/{b?}', 'CmsController@request');
