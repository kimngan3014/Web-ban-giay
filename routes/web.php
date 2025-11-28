<?php

use App\Http\Controllers\admin\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\AdminController;


/*
|--------------------------------------------------------------------------
| PHẦN 1: KHÁCH HÀNG (FRONT-END)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/product_sp', function () {
    return view('product_sp');
})->name('product_sp');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/add_to_wishlist', function () {
    return view('add_to_wishlist');
})->name('add_to_wishlist');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/text', function () {
    return view('text');
})->name('text');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/men', function () {
    return view('men');
})->name('men');

Route::get('/order', function () {
    return view('order');
})->name('order');

Route::get('/women', function () {
    return view('women');
})->name('women');


/*
|--------------------------------------------------------------------------
| PHẦN 2: ADMIN (QUẢN TRỊ) - Phải đăng nhập mới vào được
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
// Route::get('/admin', function () {
//     return view('admin');
// })->name('admin');

// Route::get('/admin/category/', function () {
//     return view('admin/category/category-list');
// })->name('admin.category');

// Route::get('/admin/product', function () {
//     return view('admin/product/product-list');
// })->name('admin.product');

Route::get('/', [AdminController::class, 'index'])->name('dashboard');
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


