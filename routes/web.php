<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- 1. IMPORT CÁC CONTROLLER (Dựa trên ảnh cấu trúc thư mục của bạn) ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;     // Quản lý trang Men/Women
use App\Http\Controllers\CartController;     // Quản lý Giỏ hàng
use App\Http\Controllers\CheckoutController; // Quản lý Thanh toán

// --- Admin Controllers ---
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderController;   // Quản lý đơn hàng
use App\Http\Controllers\admin\ProductController as AdminProductController; // Đổi tên để tránh nhầm lẫn

/*
|--------------------------------------------------------------------------
| PHẦN 1: KHÁCH HÀNG (FRONT-END)
|--------------------------------------------------------------------------
*/

// Các route xác thực (Login, Register, Logout...)
Auth::routes();

// --- Trang chủ & Các trang tĩnh ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');     // Khớp với about.blade.php
Route::get('/contact', [HomeController::class, 'contact'])->name('contact'); // Khớp với contact.blade.php

// --- Sản phẩm & Danh mục ---
Route::get('/men', [ShopController::class, 'men'])->name('men');     // Khớp với men.blade.php
Route::get('/women', [ShopController::class, 'women'])->name('women'); // Khớp với women.blade.php

// Trang chi tiết sản phẩm (Khớp với product_detail.blade.php)
Route::get('/product/{id}', [HomeController::class, 'product_detail'])->name('product.detail');

// Trang danh sách sản phẩm khác (Khớp với product_sp.blade.php)
// Bạn cần thêm hàm product_sp vào HomeController nhé
Route::get('/product-list', [HomeController::class, 'product_sp'])->name('product_sp');

// Wishlist (Dự phòng cho add_to_wishlist.blade.php - Chưa có logic thì để redirect)
Route::get('/wishlist', function() { return redirect('/'); })->name('add_to_wishlist');


// --- Giỏ hàng (Cart) ---
Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'index')->name('index');          // Xem giỏ hàng
    Route::post('/add', 'addToCart')->name('add');    // Thêm vào giỏ
    Route::post('/update', 'update')->name('update'); // Cập nhật số lượng
    Route::get('/remove/{id}', 'remove')->name('remove'); // Xóa sản phẩm
});

// --- Thanh toán (Checkout) ---
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout'); // Trang điền thông tin
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder'); // Xử lý đơn hàng
Route::get('/order-complete', [CheckoutController::class, 'complete'])->name('order.complete'); // Trang cảm ơn


/*
|--------------------------------------------------------------------------
| PHẦN 2: ADMIN (QUẢN TRỊ) - Yêu cầu đăng nhập
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard (Khớp với admin.blade.php layout chính)
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Quản lý Danh mục (Categories)
    Route::resource('category', CategoryController::class);

    // Quản lý Sản phẩm (Products)
    // Lưu ý: Route name sẽ là admin.products.index, admin.products.create...
    Route::resource('products', AdminProductController::class);
    
    // Quản lý Đơn hàng (Orders)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});