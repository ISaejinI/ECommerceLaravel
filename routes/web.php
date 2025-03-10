<?php

use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeleteFromCartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UpdateAddressController;
use App\Http\Controllers\UpdateCartController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', HomeController::class)->name('home');

Route::get('/categories', CategoriesController::class)->name('categories');

Route::get('/category/{slug}', CategoryController::class)->name('category');

Route::get('/product/{product_slug}', ProductController::class)->name('product');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/cart', CartController::class)->name('cart');
    Route::post('/addtocart/{productId}', AddToCartController::class)->name('addToCart');
    Route::delete('/deletefromcart/{product}', DeleteFromCartController::class)->name('deleteFromCart');
    Route::put('/updatecart/{product}', UpdateCartController::class)->name('updateCart');

    Route::put('/updateaddress/{address}', UpdateAddressController::class)->name('updateAddress');
});
