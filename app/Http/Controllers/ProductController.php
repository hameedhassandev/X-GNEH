<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function add(){
        $categories = DB::table('categories')->get();
        return view('product.index', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required',
            'category_id' => 'required',
            'filenames' => 'required',

        ]);
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->isActive = 1;

        if ($request->hasfile('filenames')) {
            $images = $request->file('filenames');
            $allowedfileExtension=['jpeg','jpg','png','svg'];
            foreach($images as $image) {
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if ($check){
                    $filename = rand() . '.' . $extension;
                    $image->move('upload/products/', $filename);
                    $names [] = $filename;
                    $json = json_encode($names);
                }else{
                    return back()->with('fail', 'Allow only images like: jpeg, png, jpg , svg');
                }

            }//end of foreach
           $product->filenames = $json;

        }
        $product->save();
        return back()->with('success', 'Product added successfully');
    }

}
