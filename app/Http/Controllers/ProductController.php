<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function add(){
        $categories = DB::table('categories')->get();
        return view('product.add', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'product_name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'filenames' => 'required',

        ]);
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->user_id = $request->input('user_id');


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

    public function list(){

        $products = DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->select('products.*','categories.*')
            ->paginate(5);
        print_r($products);
        return view('product.index')->with('products', $products);
    }

    public function delete($id){
        $product = DB::table('products')->find($id);
        if ($product){
            return view('product.delete', compact('product'));
        }else{
            return response(404);
        }
    }

}
