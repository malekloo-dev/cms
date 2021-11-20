<?php
function get_web_page( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}

function file_get_contents_curl( $url ) {

$ch = curl_init();

  curl_setopt( $ch, CURLOPT_AUTOREFERER, TRUE );
  curl_setopt( $ch, CURLOPT_HEADER, 0 );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt( $ch, CURLOPT_URL, $url );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER,FALSE);
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, TRUE );

  $data = curl_exec( $ch );
  print_r($data);
  die();
  curl_close( $ch );

  return $data;

}
//$a=get_web_page('https://emalls.ir/%D9%84%DB%8C%D8%B3%D8%AA-%D9%82%DB%8C%D9%85%D8%AA_%D8%AF%D8%B1%D8%A8-%D8%B6%D8%AF-%D8%B3%D8%B1%D9%82%D8%AA-~Category~25236');
//echo '<pre/>';
//print_r($a);

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageCropperController;
// use App\Http\Controllers\IndexController;
// use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ModuleBuilderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpiderController;
use App\Http\Controllers\WebsiteSettingController;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

App::setLocale(env('SITE_LANG'));

//DB::listen(function ($query) {
//    echo '<pre style="background-color:yellow;' .
//        'font-size:x-small;">' .
//        'Query fired ' .
//        '"' . $query->sql . '" ' .
//        '<small>(' . __FILE__ . ' - ' . __LINE__ . ')</small>' .
//        '</pre>';
//
//});

forceRedirect();


Route::post('/returnBank', [CompanyController::class, 'returnBank'])->name('company.products.returnBank')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);;
// dd(app('request')->all());
Route::prefix('/company')->middleware(['auth', 'role:super admin|company'])->group(function () {
    Route::get('/', [CompanyController::class, 'dashboard'])->name('company.dashboard');

    Route::get('profile', [CompanyController::class, 'profile'])->name('company.profile');
    Route::post('profileChangeLogo', [CompanyController::class, 'profileChangeLogo'])->name('company.profile.changeLogo');
    Route::post('profileUpdate', [CompanyController::class, 'profileUpdate'])->name('company.profile.update');

    Route::get('products', [CompanyController::class, 'products'])->name('company.products');
    Route::get('products/create', [CompanyController::class, 'productsCreate'])->name('company.products.create');
    Route::post('products/create', [CompanyController::class, 'productsStore'])->name('company.products.store');
    Route::get('products/edit/{content}', [CompanyController::class, 'productsUpdate'])->name('company.products.update');
    Route::patch('products/edit/{content}', [CompanyController::class, 'productsEdit'])->name('company.products.edit');
    Route::delete('products/{content}', [CompanyController::class, 'productsDestroy'])->name('company.products.destroy');
    Route::get('products/powerUp/{content}', [CompanyController::class, 'productPowerUp'])->name('company.products.powerUp');


    Route::get('invoice', [CompanyController::class, 'invoiceList'])->name('company.invoice.list');
    Route::get('invoice/{transaction}', [CompanyController::class, 'invoice'])->name('company.invoice');
    Route::patch('invoice/{content}', [CompanyController::class, 'invoiceStore'])->name('company.invoice.store');

    Route::patch('sendToBand/{transaction}', [CompanyController::class, 'sendToBand'])->name('company.sendToBand');

    Route::get('transaction', [CompanyController::class, 'transaction'])->name('company.transaction');
});





Route::prefix('/admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('contents/{type}', [ContentController::class, 'index'])->name('contents.type.show');
    //Route::get('contents/{type}/{company?}/{companyId?}', [ContentController::class, 'index'])->name('contents.type.show');
    Route::get('contents/create/{type}', [ContentController::class, 'create'])->name('contents.create');
    Route::post('contents/upload-image/', [ContentController::class, 'uploadImageSubject'])->name('contents.upload');

    Route::delete('gallery/{gallery}', [GalleryController::class,'destroy'])->name('gallery.destroy');

    Route::get('attribute/getFields/{id}', [AttributeController::class, 'getFields'])->name('attribute.getFields');


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

Auth::routes();

// Route::get('/search', [InventoryController::class, 'index'])->name('inventory.show');
// Route::post('/search', [InventoryController::class, 'index'])->name('inventory.search');


Route::get('spider', [SpiderController::class, 'spider']);
Route::get('/spider/reload', [SpiderController::class, 'reload']);
Route::post('/spider/addToCms', [SpiderController::class, 'reloadAdd']);


Route::group(['middleware' => 'HtmlMinifier'], function () {
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
