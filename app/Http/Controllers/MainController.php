<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;


use App\Models\product;

class mainController extends Controller
{
    public function mainPage(){
        $categories = Category::all();
        return view('welcome',['categories' => $categories]);
    }
        public function category(){
        $categories = Category::all();
        return view('welcome',['categories' => $categories]);
    }



    public function search(Request $request){
        $products = Product::where('name','like', '%'. $request->searchKey.'%')->get();
        return view('product',['products'=>$products]);
    }
}
