<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function add(){
        $categories = DB::table('categories')->get();
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'icon' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        $category = new Category();
        $category->name = $request->input('name');
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('upload/categories/', $filename);
            $category->icon = $filename;
        } else {
            $category->icon = NULL;
        }
        $category->save();
        return back()->with('success', 'Category added successfully');
    }
}
