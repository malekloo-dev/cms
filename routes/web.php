<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageCropperController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ModuleBuilderController;
use App\Http\Controllers\RedirectUrlController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpiderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteSettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
// use CKSource\CKFinderBridge\Controller\CKFinderController;

App::setLocale(env('SITE_LANG'));

//Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

Route::prefix('/company')->middleware(['role:company'])->group(function () {
    Route::get('/', [CompanyController::class,'index'])->name('company.panel');

});
Route::prefix('/admin')->middleware(['auth','role:super admin'])->group(function () {

    Route::post('contents/upload-image/', [ContentController::class,'uploadImageSubject'])->name('contents.upload');
    Route::get('image-cropper', [ImageCropperController::class,'index']);
    Route::post('image-cropper/upload', [ImageCropperController::class,'upload']);

    Route::get('/', [IndexController::class,'index'])->name('admin');


    /** for adminContent  */
    //Route::resource('contents', [ContentController::class,');
    Route::get('contents', [ContentController::class,'index'])->name('contents.index');
    Route::get('contents/create', [ContentController::class,'create'])->name('contents.create');
    Route::get('contents/{type}', [ContentController::class,'index'])->name('contents.show');
    Route::post('contents', [ContentController::class,'store'])->name('contents.store');
    Route::delete('contents/{content}', [ContentController::class,'destroy'])->name('contents.destroy');
    Route::PATCH('contents/{content}', [ContentController::class,'update'])->name('contents.update');
    Route::get('contents/{content}/edit', [ContentController::class,'edit'])->name('contents.edit');


    Route::prefix('seo')->name('seo.')->group(function () {
        Route::resource('redirectUrl', 'RedirectUrlController');
        Route::get('websiteSetting', [WebsiteSettingController::class,'edit'])->name('websiteSetting.edit');
        Route::patch('websiteSetting', [WebsiteSettingController::class,'update'])->name('websiteSetting.update');
    });

    Route::resource('category', 'CategoryController');
    Route::resource('menu', 'MenuController');

    Route::get('indexConfig/{fileName}', [ModuleBuilderController::class,'edit'])->name('moduleBuilder.edit');
    Route::patch('indexConfig/{fileName}', [ModuleBuilderController::class,'update'])->name('moduleBuilder.update');

    Route::resources([
        'clients'   => 'ClientsController',
        'users' => 'UserController',
        'contact' => 'ContactController',
        'comment' => 'CommentController',
        'role'=>'RoleController'
    ]);


    Route::get('role/{role}/permissions', [RoleController::class,'permissions'])->name('role.permissions.index');
    Route::get('role/{role}/permissions/create', [RoleController::class,'permissionCreate'])->name('role.permission.create');
    Route::post('role/{role}/permissions', [RoleController::class,'permissionStore'])->name('role.permission.store');

    Route::get('role/{role}/users', [RoleController::class,'users'])->name('role.users.index');
    Route::post('role/{role}/users', [RoleController::class,'usersAssign'])->name('role.users.assign');
});


Route::get('/search', [InventoryController::class,'index'])->name('inventory.show');
Route::post('/search', [InventoryController::class,'index'])->name('inventory.search');

Auth::routes(['register' => false]);

Route::get('spider', [SpiderController::class,'spider']);
Route::get('/spider/reload', [SpiderController::class,'reload']);
Route::post('/spider/addToCms', [SpiderController::class,'reloadAdd']);


//Route::get('/search/', 'inventoryController@index')->name('inventory.show');
//Route::post('/search/', 'inventoryController@index')->name('inventory.search');

Route::get('/', [HomeController::class,'index']);
Route::get('/reload', [ContentController::class,'reload']);

Route::get('/{slug?}/{b?}', [CmsController::class,'request']);

Route::post('/comment', [CommentController::class,'store'])->name('comment.store');
Route::post('/contact', [CommentController::class,'store'])->name('contact.store');
