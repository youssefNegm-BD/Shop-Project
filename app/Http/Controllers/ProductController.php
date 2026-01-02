<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;



class ProductController extends Controller
{

    


    public function Allproducts(){

        $products = Product::paginate(6);
        return view('category',['products' => $products ]);
    }

    public function GetCategoryProduct($category_id){
        
        $products = Product::where('category_id',$category_id)->get();
        return view('product',['products'=>$products]);
    }


    public function addproduct(){
        $allCategories = category::all();
        return view('product.addproduct',['allCategories' => $allCategories]);
    }

    public function storeproduct(Request $request){
        $request ->validate([
                'name'=>'required|max:20',
                'description'=>'required',
                'price'=>'required|integer',
                'quantity'=>'required|integer',
                'photo'=>'image|mimes:jpg,png,jpeg,gif|max:2048',

        ]);
            // edit product
        if($request->id){
        
                $curProduct = Product::find($request->id);
                $curProduct -> name = $request -> name;
                $curProduct -> description = $request -> description;
                $curProduct -> price = $request -> price;
                $curProduct -> quantity = $request -> quantity;
                $curProduct ->category_id= $request-> category_id;

                            if($request->has('photo')){
                                $path = $request->photo ->move('uploads' ,
                                Str::uuid()->toString(). '-'
                                .$request->file('photo')->getClientOriginalName()
                            );
                            $curProduct ->imagepath = $path;
                        }

                $curProduct->save();
                return redirect('/Allproducts');

        }else{
            //add new product
            $addpr = new Product();
            $addpr -> name = $request -> name;
            $addpr -> description = $request -> description;
            $addpr -> price = $request -> price;
            $addpr -> quantity = $request -> quantity;

            // upload photo----------------------
            $path='';
                if($request->has('photo')){
                    $path = $request->photo ->move('uploads' ,
                    Str::uuid()->toString(). '-'
                    .$request->file('photo')->getClientOriginalName()
                );
            }
            $addpr ->imagepath= $path ;

            $addpr ->category_id= $request-> category_id;
            $addpr->save();
            return redirect('/addproduct');
        }
    }

    public function deleteProduct(Request $request, $id){

        $currentProduct = Product::find($id);
        if($currentProduct){
            $currentProduct->delete();
            return redirect('/Allproducts');

        }else{
            abort(403);
        }
    }


    public function EditProduct($id){
        $prod = Product::findOrFail($id);
        $allCategories = category::all();

        return view('product.editProduct',['allCategories' => $allCategories,'product' => $prod]);
    }




}
