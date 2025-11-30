<?php

namespace App\Http\Controllers;

use App\Models\Category; // Dùng để lọc sản phẩm theo danh mục
use App\Models\Product;  // Dùng để lấy thông tin sản phẩm
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Hiển thị trang danh mục Giày Nam.
     * Route: /men
     */
    public function men()
    {
        // 1. Tìm danh mục có tên là 'Giày Nam'
        $category = Category::where('name', 'Giày Nam')->first();
        
        $products = collect(); 
        
        if ($category) {
            // 2. Lấy tất cả sản phẩm liên quan và phân trang
            $products = $category->products()->paginate(12); 
        }
        
        // 3. Truyền biến $products sang View (resources/views/men.blade.php)
        return view('men', compact('products'));
    }

    /**
     * Hiển thị trang danh mục Giày Nữ.
     * Route: /women
     */
    public function women()
    {
        // 1. Tìm danh mục có tên là 'Giày Nữ'
        $category = Category::where('name', 'Giày Nữ')->first();
        
        $products = collect(); 
        
        if ($category) {
            // 2. Lấy tất cả sản phẩm liên quan và phân trang
            $products = $category->products()->paginate(12);
        }
        
        // 3. Truyền biến $products sang View (resources/views/women.blade.php)
        return view('women', compact('products'));
    }
}