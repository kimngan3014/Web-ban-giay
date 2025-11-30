<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.category-list', compact('categories'));   
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.category.add');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ], [
            'name.required' => 'Bạn chưa nhập tên danh mục!'
        ]);
        $categories = new Category();
        $categories->name = $request->name;
        $categories->description = $request->description;
        $categories->save();
        return redirect()->route('admin.category.index');    
    }  
    
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('admin.category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.category.index');
    }

    public function show($id)
    {
        //
    }
}

