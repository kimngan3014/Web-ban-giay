<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Nhớ dòng này

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'size' => 'required',
            'product_id' => 'required|exists:products,id'
        ], [
            'size.required' => 'Vui lòng chọn Size giày!'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        $cartKey = $request->product_id . '_' . $request->size;

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {
            $cart[$cartKey] = [
                "product_id" => $product->id, 
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "image" => $product->image,
                "size" => $request->size
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            
            if(isset($cart[$request->id])) {
                $cart[$request->id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Đã cập nhật số lượng!');
            }
        }
    }

    public function remove($id) 
    {
        $cart = session()->get('cart');
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ!');
    }
}