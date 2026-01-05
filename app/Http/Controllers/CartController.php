<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
public function add($id, Request $request){
    $product = Product::find($id);
    
    $cart = session('cart', []);
    
    if(isset($cart[$id])){
        $cart[$id]['quantity'] = $cart[$id]['quantity'] +1 ;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "quantity" => 1,
            "imagepath" => $product->imagepath,  
            "description" => $product->description,
        ];
    }
    
    session()->put('cart', $cart);  
    
    return redirect()->back()->with('success', 'product added to cart');
}

    public function index(){
        return view('cart');
    }
    public function clearCart(){
            session()->forget('cart');
            return redirect()->back()->with('success', 'Cart cleared');
        }


        public function cartUpdate(Request $request){
            info($request->all());
            $cart = session("cart");
            if($request->type == "update"){
                $cart[$request->product_id]["quantity"] = $request->quantity;
            }else{
                unset($cart[$request->product_id]);
            }
            session()->put("cart",$cart);
            $view = view("cartProducts")->render();
            return response()->json(["success"=> $view]);

        }

}
