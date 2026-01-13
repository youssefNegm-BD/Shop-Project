<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
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


        public function order(){
            $order =Order::create([
                "user_id"=> Auth::user()->id 
            ]);
            $amount = 0;
            foreach (session("cart") as $key => $value) {
                $order->products()->create([
                    "product_id"=>$key,
                    "quantity"=>$value["quantity"],
                    "price"=>$value["price"]
                ]);
                $amount = $amount + ($value["quantity"] * $value["price"]);

            }
            $order->amount = $amount;
            $order->save();

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.success'),
                    "cancel_url" => route('paypal.cancel'),
                ],
                "purchase_units" => [
                    [
                        "reference_id" => $order->id,
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => number_format($amount, 2, '.', '')
                        ]
                    ]
                ]
    ]);
                if (isset($response['id']) && $response['id'] != null) {
                    // حفظ PayPal Order ID
                    $order->paypal_id = $response['id'];
                    $order->save();
                    // dd($order);
                    
                    // توجيه المستخدم لصفحة الدفع
                    foreach($response['links'] as $link) {
                        if ($link['rel'] === 'approve') {

                            return redirect()->away($link['href']);
                        }
                    }
                    
                }
            return redirect()->route('cart')->with('error', 'حدث خطأ في عملية الدفع');

}
// دالة جديدة للنجاح
        public function paypalSuccess(Request $request)
        {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            
            $response = $provider->capturePaymentOrder($request->token);
            
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                // تحديث حالة الطلب
                $orderId = $response['purchase_units'][0]['reference_id'];
                $order = Order::find($orderId);
                $order->status = 1; // مدفوع
                $order->save();
                
                // مسح السلة
                session()->forget('cart');
                
                return redirect()->route('home')->with('success', 'تم الدفع بنجاح!');
            }
            
            return redirect()->route('cart')->with('error', 'فشلت عملية الدفع');
        }

        // دالة جديدة للإلغاء
        public function paypalCancel()
        {
            return redirect()->route('cart')->with('error', 'تم إلغاء عملية الدفع');
        }

}
