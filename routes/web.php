<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ==============================
// LOGIN & REGISTER (Semua bisa akses)
// ==============================

Route::controller(\App\Http\Controllers\UserController::class)->group(function (){
    Route::middleware(\App\Http\Middleware\MustNotLogin::class)->group(function (){
        Route::get('/login', 'login');
        Route::post('/login', 'postLogin');
        Route::get('/register', 'register');
        Route::post('/register', 'postRegister');
    });

    Route::post('/logout', 'postLogout')
        ->middleware(\App\Http\Middleware\MustLoginFirst::class);
});

// ==============================
// HALAMAN PEMBELI (Hanya role=user)
// ==============================

Route::middleware([\App\Http\Middleware\MustBeBuyer::class])->group(function () {

    Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);

    Route::controller(\App\Http\Controllers\MenuController::class)->group(function (){
        Route::get('/{shopName}/menu', 'menu')->name('showMenu');
    });

    Route::controller(\App\Http\Controllers\CheckoutController::class)->group(function (){
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::post('/checkout', 'process');
        Route::get('/checkout/invoice/{id}', 'invoice')->name('checkout.invoice');
        Route::post('/invoice/{id}/download', 'invoiceDownload');
    });
});

// ==============================
// HALAMAN ADMIN (Hanya role=admin)
// ==============================

Route::prefix('admin')->middleware(\App\Http\Middleware\MustBeAdmin::class)->group(function () {

    // Dashboard
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard']);

    // CRUD Toko
    Route::get('/shops', [\App\Http\Controllers\AdminController::class, 'shopIndex']);
    Route::get('/shops/create', [\App\Http\Controllers\ShopController::class, 'shopAdd']);
    Route::post('/shops', [\App\Http\Controllers\ShopController::class, 'shopAddPost']);
    Route::get('/shops/{id}/edit', [\App\Http\Controllers\ShopController::class, 'shopEdit']);
    Route::put('/shops/{id}', [\App\Http\Controllers\ShopController::class, 'shopUpdate']);
    Route::delete('/shops/{id}', [\App\Http\Controllers\ShopController::class, 'shopDelete']);

    // CRUD Menu (per toko)
    Route::get('/shops/{shopId}/menus', [\App\Http\Controllers\AdminController::class, 'menuIndex']);
    Route::get('/shops/{shopId}/menus/create', [\App\Http\Controllers\MenuController::class, 'menuAdd']);
    Route::post('/shops/{shopId}/menus', [\App\Http\Controllers\MenuController::class, 'menuAddPost']);
    Route::get('/shops/{shopId}/menus/{id}/edit', [\App\Http\Controllers\MenuController::class, 'menuEdit']);
    Route::put('/shops/{shopId}/menus/{id}', [\App\Http\Controllers\MenuController::class, 'menuUpdate']);
    Route::delete('/shops/{shopId}/menus/{id}', [\App\Http\Controllers\MenuController::class, 'menuDelete']);

    // CRUD Kategori
    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('/categories/create', [\App\Http\Controllers\CategoryController::class, 'create']);
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('/categories/{id}/edit', [\App\Http\Controllers\CategoryController::class, 'edit']);
    Route::put('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy']);
});

// ==============================
// CART ROUTES (wildcard - harus di paling bawah!)
// ==============================

Route::controller(\App\Http\Controllers\CartController::class)->group(function (){
    Route::middleware(\App\Http\Middleware\MustBeBuyer::class)->group(function (){
        Route::post('/{menuName}/{menuId}', 'addCart');
        Route::post('/cart/delete/{menuName}/{menuId}', 'deletePerCartItem');
    });
});
