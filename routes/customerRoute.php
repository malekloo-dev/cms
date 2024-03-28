<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('/customer')->middleware(['auth', 'role:super admin|customer'])->group(function () {
    Route::get('/', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

    Route::get('/shipping', [CustomerController::class, 'shippingList'])->name('customer.shipping');

    Route::get('/orders', [CustomerController::class, 'orderList'])->name('customer.order.list');
    Route::post('/order', [CustomerController::class, 'orderStore'])->name('customer.order.store');
    Route::get('/order/{order}/detail', [CustomerController::class, 'orderDetail'])->name('customer.order.detail');
    Route::delete('/order/{order}', [CustomerController::class, 'orderDestroy'])->name('customer.order.destroy');



    Route::get('profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::post('profileChangeLogo', [CustomerController::class, 'profileChangeLogo'])->name('customer.profile.changeLogo');
    Route::post('profileUpdate', [CustomerController::class, 'profileUpdate'])->name('customer.profile.update');


    Route::get('invoice', [CustomerController::class, 'invoiceList'])->name('customer.invoice.list');
    Route::get('invoice/{transaction}', [CustomerController::class, 'invoice'])->name('customer.invoice');
    Route::patch('invoice/{content}', [CustomerController::class, 'invoiceStore'])->name('customer.invoice.store');

    Route::post('uploadBill/{order}', [CustomerController::class, 'uploadBill'])->name('customer.uploadBill');
    Route::patch('sendToBand/{transaction}', [CustomerController::class, 'sendToBand'])->name('customer.sendToBand');

    Route::get('transaction', [CustomerController::class, 'transaction'])->name('customer.transaction');
});
Route::prefix('/customer')->group(function () {
    Route::get('/cart', [CustomerController::class, 'cartList'])->name('customer.cart.list');
    Route::post('/cart', [CustomerController::class, 'cartStore'])->name('customer.cart.store');
    Route::delete('cart/{product}', [CustomerController::class, 'cartDestroy'])->name('customer.cart.destroy');
    Route::post('cart/{product}', [CustomerController::class, 'cartUpdate'])->name('customer.cart.update');
});

Route::get('login', [CustomerController::class, 'showLoginForm'])->name('customer.login');
Route::get('register', [CustomerController::class, 'showRegisterForm'])->name('customer.register');
Route::get('forgot', [CustomerController::class, 'showPasswordForgotForm'])->name('customer.forgot.request');
