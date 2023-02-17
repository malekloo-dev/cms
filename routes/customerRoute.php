<?php
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('/customer')->middleware(['auth', 'role:super admin|customer'])->group(function () {
    Route::get('/', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

    Route::get('/cart', [CustomerController::class, 'cartList'])->name('customer.cart.list');
    Route::post('/cart', [CustomerController::class, 'cartStore'])->name('customer.cart.store');
    Route::delete('cart/{product}', [CustomerController::class, 'cartDestroy'])->name('customer.cart.destroy');
    Route::post('cart/{product}', [CustomerController::class, 'cartUpdate'])->name('customer.cart.update');

    Route::get('/orders', [CustomerController::class, 'orderList'])->name('customer.order.list');
    Route::post('/order', [CustomerController::class, 'orderStore'])->name('customer.order.store');
    Route::get('/order/{order}/detail', [CustomerController::class, 'orderDetail'])->name('customer.order.detail');
    Route::delete('/order/{order}', [CustomerController::class, 'orderDestroy'])->name('customer.order.destroy');


    // Route::get('profile', [CustomerController::class, 'profile'])->name('customer.profile');
    // Route::post('profileChangeLogo', [CustomerController::class, 'profileChangeLogo'])->name('customer.profile.changeLogo');
    // Route::post('profileUpdate', [CustomerController::class, 'profileUpdate'])->name('customer.profile.update');

    // Route::get('products', [CustomerController::class, 'products'])->name('customer.products');
    // Route::get('products/create', [CustomerController::class, 'productsCreate'])->name('customer.products.create');
    // Route::post('products/create', [CustomerController::class, 'productsStore'])->name('customer.products.store');
    // Route::get('products/edit/{content}', [CustomerController::class, 'productsUpdate'])->name('customer.products.update');
    // Route::patch('products/edit/{content}', [CustomerController::class, 'productsEdit'])->name('customer.products.edit');
    // Route::delete('products/{content}', [CustomerController::class, 'productsDestroy'])->name('customer.products.destroy');
    // Route::get('products/powerUp/{content}', [CustomerController::class, 'productPowerUp'])->name('customer.products.powerUp');


    Route::get('invoice', [CustomerController::class, 'invoiceList'])->name('customer.invoice.list');
    Route::get('invoice/{transaction}', [CustomerController::class, 'invoice'])->name('customer.invoice');
    Route::patch('invoice/{content}', [CustomerController::class, 'invoiceStore'])->name('customer.invoice.store');

    Route::patch('sendToBand/{transaction}', [CustomerController::class, 'sendToBand'])->name('customer.sendToBand');

    Route::get('transaction', [CustomerController::class, 'transaction'])->name('customer.transaction');
});
// Route::get('login', [CustomerController::class, 'showLoginForm'])->name('customer.login.form');
// Route::get('register', [CustomerController::class, 'showRegisterForm'])->name('customer.register.form');
Route::get('forgot', [CustomerController::class, 'showPasswordForgotForm'])->name('customer.forgot.request');
