<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // Trong HomeController.php
    public function index()
    {
    // Lấy 8 sản phẩm mới nhất
        $products = Product::latest()->take(8)->get();
        return view('index', compact('products')); // Đừng redirect sang admin nữa nhé
    }

    public function product_detail($id)
{
    // 1. Lấy sản phẩm chính
    $product = \App\Models\Product::findOrFail($id);
    
    // 2. Lấy sản phẩm liên quan (cùng danh mục, khác ID hiện tại)
    $related_products = \App\Models\Product::where('category_id', $product->category_id)
                        ->where('id', '!=', $id)
                        ->take(4)
                        ->get();

    // 3. Trả về cả 2 biến
    return view('client.product_detail', compact('product', 'related_products'));
}
    public function product_sp()
    {
        $products = Product::paginate(12); // Phân trang, 12 sản phẩm mỗi trang
        return view('product_sp', compact('products'));
    }   
}   