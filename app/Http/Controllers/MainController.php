<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Review;

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

        public function review(){
            $reviews = Review::all();
        return view('review',['reviews'=>$reviews]);
    }

    public function storeReview(Request $request){

                $request ->validate([
                'name'=>'required|max:20',
                'phone'=>'required',
                'email'=>'required|email',
                'message'=>'required',
            ]);
            
        $reviews = new Review();
        $reviews->name =$request->name;
        $reviews->phone =$request->phone;
        $reviews->email =$request->email;
        $reviews->message =$request->message;
        $reviews->save();
        return redirect('/review');

    }

    public function search(Request $request){
        $products = Product::where('name','like', '%'. $request->searchKey.'%')->get();
        return view('product',['products'=>$products]);
    }
}
