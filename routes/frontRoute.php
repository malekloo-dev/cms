<?php

use App\Http\Controllers\CmsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SpiderController;
use Illuminate\Support\Facades\Route;

// Route::get('/search', [InventoryController::class, 'index'])->name('inventory.show');
// Route::post('/search', [InventoryController::class, 'index'])->name('inventory.search');



Route::get('spider', [SpiderController::class, 'spider']);
Route::get('/spider/reload', [SpiderController::class, 'reload']);
Route::post('/spider/addToCms', [SpiderController::class, 'reloadAdd']);
Route::get('spider/instagram/{id}/{count}', [SpiderController::class, 'instagram']);





Route::group(['middleware' => 'HtmlMinifier'], function () {

    Route::get('search', [SearchController::class,'index'])->name('search');
    Route::post('search/suggest', [SearchController::class,'suggest'])->name('search.suggest');

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/reload', [ContentController::class, 'reload']);

    Route::get('/profile/{id?}', [CompanyController::class, 'profileShow'])->name('profile.index');

    Route::get('/wp/getProduct', [CompanyController::class, 'wpGetproduct'])->name('wp.product');

    // WebsiteSetting::where('variable','=',['product','article','category'])->get()->each(function ($prefix) {
    //     Route::prefix($prefix->value)->get('/{slug?}/{b?}', [CmsController::class, 'request']);
    // });

    Route::get('/{slug?}/{b?}', [CmsController::class, 'request']);


    Route::post('/comment', [CommentController::class, 'store'])->name('comment.client.store');
    Route::post('/contact', [CommentController::class, 'store'])->name('contact.client.store');


});
