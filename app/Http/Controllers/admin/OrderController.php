<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Xem danh sách đơn hàng
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    // Xem chi tiết đơn hàng (Sản phẩm, Size, Giá)
    public function show($id)
    {
        $order = Order::with('details')->findOrFail($id);
        return view('admin.order.detail', compact('order'));
    }

    // Cập nhật trạng thái giao hàng
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        // Status: pending (chờ xử lý) -> shipping (đang giao) -> completed (đã giao) -> cancelled (hủy)
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}