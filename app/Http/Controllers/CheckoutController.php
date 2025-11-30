<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
   public function index()
    {
        $cart = session()->get('cart');

        // Kiểm tra: Nếu giỏ hàng trống thì đá về trang chủ
        if (!$cart || count($cart) == 0) {
            return redirect()->route('home')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        return view('checkout', compact('cart'));
    }

    // 2. Xử lý đặt hàng (Lưu vào DB)
    public function placeOrder(Request $request)
    {
        // a. Validate dữ liệu người mua
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ], [
            'fname.required' => 'Vui lòng nhập họ.',
            'lname.required' => 'Vui lòng nhập tên.',
            'address.required' => 'Vui lòng nhập địa chỉ nhận hàng.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
        ]);

        $cart = session()->get('cart');
        
        // Tính tổng tiền
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // b. Dùng Transaction: Để đảm bảo lưu Order thành công thì mới lưu OrderDetail
        // Nếu 1 trong 2 lỗi thì rollback lại hết (tránh đơn hàng ảo)
        DB::beginTransaction();
        try {
            // Bước 1: Tạo đơn hàng
            $order = new Order();
            // Nếu khách đã đăng nhập thì lưu user_id, không thì null
            $order->user_id = auth()->check() ? auth()->id() : null; 
            $order->first_name = $request->fname;
            $order->last_name = $request->lname;
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->email = $request->email;
            $order->total_price = $total;
            $order->status = 'pending'; // Trạng thái: Chờ xử lý
            $order->save();

            // Bước 2: Lưu chi tiết đơn hàng (Từng đôi giày)
            foreach($cart as $key => $item) {
                $detail = new OrderDetail();
                $detail->order_id = $order->id;
                $detail->product_id = $item['product_id'];
                $detail->product_name = $item['name'];
                $detail->quantity = $item['quantity'];
                $detail->price = $item['price'];
                $detail->size = $item['size']; // Lưu size để soạn hàng cho đúng
                $detail->save();
            }

            DB::commit(); // Xác nhận lưu thành công

            // Bước 3: Xóa giỏ hàng và chuyển trang
            session()->forget('cart');
            return redirect()->route('order.complete')->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollBack(); // Có lỗi thì hủy hết thao tác lưu
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau. ' . $e->getMessage());
        }
    }

    // 3. Trang thông báo thành công
    public function complete()
    {
        return view('order'); // Trang cảm ơn (order.blade.php)
    }
}
