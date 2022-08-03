<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function add(){
        $categories = DB::table('categories') ->paginate(3);
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

    public function delete($id){
        $category = DB::table('categories')->find($id);
        if ($category){
            return view('category.delete', compact('category'));
        }else{
            return response(404);
        }

    }

    public function accDelete($id){
        $category = Category::where('id',$id)->delete();
        if ($category){
            return redirect('dashboard/add-category')->with('success', 'Category deleted successfully!');
        }
        else{
            return response(404);
        }
    }

    public function edit($id){
        $category = DB::table('categories')->find($id);
        if ($category){
            return view('category.update', compact('category'));
        }else{
            return response(404);
        }

    }
    public function accEdit(Request $request, $id){
        $category = Category::find($id);
        if ($category){
            $request->validate([
                'name' => 'max:255',
                'icon' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

            ]);
            $category->name = $request->input('name');
            if ($request->hasFile('icon')){
                $destination = 'upload/categories/'.$category->icon;
                if (File::exists($destination)){
                    File::delete($destination);
                }
                $file = $request->file('icon');
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $file->move('upload/categories/',$filename);
                $category->icon = $filename;
            }
            $category->update();
            return redirect('dashboard/add-category')->with('success', 'Category updated successfully!');
        }
        else{
            return response(404);
        }
    }
}
