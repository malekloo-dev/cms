<?php
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

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
