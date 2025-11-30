<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product.product-list', compact('products'));    
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.add', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);
        $products = new Product();
        $products->name = $request->name;
        $products->price = $request->price;
        $products->description = $request->description;
        $products->save();
        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công');    }  
    
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công');    }
        
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công');
    }

    public function show($id)
    {
        //
    }
}