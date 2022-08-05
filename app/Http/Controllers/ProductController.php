<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    public function add(){
        $categories = DB::table('categories')->get();
        return view('product.add', compact('categories'));
    }


    public function store(Request $request){
        $request->validate([
            'product_name' => 'required|max:64',
            'description' => 'required|max:225',
            'price' => 'required|digits_between:1,6',
            'category_id' => 'required',
            'filenames' => 'required',
            'address'=> 'required|max:120'

        ]);
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->user_id = $request->input('user_id');
        $product->address = $request->input('address');


        if ($request->hasfile('filenames')) {
            $images = $request->file('filenames');
            $allowedfileExtension=['jpeg','JPEG','jpg','JPG','png','PNG','SVG','svg','gif','GIF'];

            foreach($images as $image) {
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if ($check){
                    $filename = rand() . '.' . $extension;
                    $image->move('upload/products/', $filename);
                    $names [] = $filename;
                    $converArr = implode(",",$names);
                }else{
                    return back()->with('fail', 'Allow only images like: jpeg, png, jpg , svg');
                }

            }//end of foreach
           $product->filenames = $converArr;

        }
        $product->save();
        return back()->with('success', 'Product added successfully');
    }


    public function listAllForAdmin(){
        $products = DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->join('users','users.id','=','products.user_id')
            ->select('products.*','categories.name','users.name as user_name')
            ->where('products.isActive', '=','1')
            ->paginate(5);
        return view('product.index')->with('products', $products);
    }

    public function search(Request $request){
        $products = DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->join('users','users.id','=','products.user_id')
            ->select('products.*','categories.name','users.name as user_name')
            ->where('products.isActive', '=','1' )
            ->where('categories.name' ,  'LIKE', "%" . $request->search . "%")
            ->orWhere('products.product_name' ,'LIKE', "%" . $request->search . "%" )
            ->orWhere('products.description' ,'LIKE', "%" . $request->search . "%" )
            ->orWhere('users.name' ,'LIKE', "%" . $request->search . "%" )
            ->paginate(5);
        return view('product.index')->with('products', $products);

    }

    public function productDetails($id){
        $details = DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->join('users','users.id','=','products.user_id')
            ->select('products.*','categories.name','users.name as user_name','users.email','users.phone')
            ->where('products.isActive', '=','1')
            ->where('products.id','=',$id)
            ->get();

        if ($details){
            return view('product.productDetails')->with('details', $details);
        }else{
            return response(404);
        }

    }


    public function listAllForSeller($id){
        $products = DB::table('products')
            ->join('categories','categories.id','=','products.category_id')
            ->join('users','users.id','=','products.user_id')
            ->select('products.*','categories.name')
            ->where('products.isActive', '=','1')
            ->where('users.id','=',$id)
            ->paginate(5);
        return view('product.sellerAllProduct')->with('products', $products);
    }

    public function deleteProduct($id){
            $product = Product::where('id',$id)->delete();
            if ($product){
                return redirect('dashboard/list-products');
            }else{
                return response(404);
            }
    }

}
