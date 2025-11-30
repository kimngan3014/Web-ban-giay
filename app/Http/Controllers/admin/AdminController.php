<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        // 1. Get total number of orders
        $totalOrders = Order::count();

        // 2. Get total revenue (sum of total_price from completed orders)
        // Note: Only sum orders that are not cancelled
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_price');

        // 3. Get total number of products
        $totalProducts = Product::count();

        // 4. Get total number of registered users (if needed)
        $totalUsers = User::count();

        // 5. Get recent orders (e.g., last 5)
        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin', compact('totalOrders', 'totalRevenue', 'totalProducts', 'totalUsers', 'recentOrders'));
    }
}