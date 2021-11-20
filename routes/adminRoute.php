<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ModuleBuilderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WebsiteSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('contents/{type}', [ContentController::class, 'index'])->name('contents.type.show');
    //Route::get('contents/{type}/{company?}/{companyId?}', [ContentController::class, 'index'])->name('contents.type.show');
    Route::get('contents/create/{type}', [ContentController::class, 'create'])->name('contents.create');
    Route::post('contents/upload-image/', [ContentController::class, 'uploadImageSubject'])->name('contents.upload');

    Route::delete('gallery/{gallery}', [GalleryController::class,'destroy'])->name('gallery.destroy');

    // Route::get('attribute/getFields/{id}', [AttributeController::class, 'getFields'])->name('attribute.getFields');


    // Route::get('image-cropper', [ImageCropperController::class, 'index']);
    // Route::post('image-cropper/upload', [ImageCropperController::class, 'upload']);






    Route::prefix('seo')->name('seo.')->group(function () {
        Route::resource('redirectUrl', 'RedirectUrlController');
        Route::get('websiteSetting', [WebsiteSettingController::class, 'edit'])->name('websiteSetting.edit');
        Route::patch('websiteSetting', [WebsiteSettingController::class, 'update'])->name('websiteSetting.update');
    });

    Route::get('indexConfig/{fileName}', [ModuleBuilderController::class, 'edit'])->name('moduleBuilder.edit');
    Route::patch('indexConfig/{fileName}', [ModuleBuilderController::class, 'update'])->name('moduleBuilder.update');

    Route::resources([
        'clients'   => 'ClientsController',
        'users' => 'UserController',
        'contact' => 'ContactController',
        'comment' => 'CommentController',
        'role' => 'RoleController',
        'category' => 'CategoryController',
        'menu' => 'MenuController'
    ]);
    Route::resource('contents', 'ContentController')->except([
        'create'
    ]);

    Route::get('role/{role}/permissions', [RoleController::class, 'permissions'])->name('role.permissions.index');
    Route::get('role/{role}/permissions/create', [RoleController::class, 'permissionCreate'])->name('role.permission.create');
    Route::post('role/{role}/permissions', [RoleController::class, 'permissionStore'])->name('role.permission.store');

    Route::get('role/{role}/users', [RoleController::class, 'users'])->name('role.users.index');
    Route::post('role/{role}/users', [RoleController::class, 'usersAssign'])->name('role.users.assign');

    // Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::get('company', [CompanyController::class, 'companyList'])->name('admin.company.index');
    Route::get('company/create', [CompanyController::class, 'companyCreateOrupdate'])->name('admin.company.create');
    Route::post('company/create', [CompanyController::class, 'companyStore'])->name('admin.company.store');
    Route::get('company/edit/{company}', [CompanyController::class, 'companyCreateOrUpdate'])->name('admin.company.update');
    Route::patch('company/edit/{company}', [CompanyController::class, 'companyEdit'])->name('admin.company.edit');
    Route::delete('company/{company}', [CompanyController::class, 'companyDestroy'])->name('admin.company.destroy');
});
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
