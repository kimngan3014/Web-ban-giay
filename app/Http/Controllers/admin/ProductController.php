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
    $products = Product::orderBy('id', 'desc')->get();
    view()->share('products', $products);
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.product.product-list', compact('products'));    
    }

    public function create()
    {
        return view('admin.product.add');
    }

    public function store(Request $request){
        $products = new Product();
        $products->name = $request->name;
        $products->price = $request->price;
        $products->description = $request->description;
        $products->save();
        return redirect()->route('admin.product.index');    
    }  
    
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.product.index');
    }

    public function show($id)
    {
        //
    }
}