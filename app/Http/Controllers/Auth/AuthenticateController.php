<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use App\Models\User;

use App\Models\Product;
use App\Models\Category;

class AuthenticateController extends Controller
{

    public function Register(){
        return view('Auth.register');
    }
    public function processRegister(Request $request){

            $validator = Validator::make($request->all(),[
            'name' =>'required|min:3',
            'email' =>'required|email|unique:users',
            'password' =>'required',
        ]);
        if($validator->fails()){
            return redirect()->route('register')->withInput()->withErrors($validator);
        }else{
        $newUser = new user();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->save();
        return redirect()->route('login')->with('success','You Have Registerd Successfully.');
        }
        


    }
    public function login(){
        return view('auth.login');

    }
        public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' =>'required|email',
            'password'=>'required'
        ]);
        if ($validator->fails()){
                
            return redirect()->route('login')->withInput()->withErrors($validator);
        }

        if (Auth::attempt(['email' =>$request->email,'password'=>$request->password])){
            return redirect()->route('homePage');
        }else{
            return redirect()->route('login')->with('error','Email or Password is incorrect');

        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('homePage'); 
    }


    public function profile(){
        $user = User::find(Auth::user()->id);
        
        return view('Auth.profile',[
            'user'=>$user
        ]);
        
        
    }

    public function updateProfile(Request $request){


        $rules =[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.Auth::user()->id.'id'
            
        ];
        
        $validator= Validator::make($request->all(),$rules);
        
        if($validator->fails()){
            return redirect()->route('profile')->withInput()->withErrors($validator);
        }
        $user = User::find(Auth::user()->id);
        $user->name =$request->name;
        $user->email =$request->email;
        $user->save();

        return redirect()->route('profile')->with('success','Profile Updated successfully');
    }


    public function productList(){
        
    $products = Product::with('category')
                            ->orderBy('created_at', 'ASC')
                            ->paginate(5);
    $categories = Category::all();
    
    return view('productlist', [
        'categories' => $categories,
        'products' => $products
    ]);
}

// change password------------------------------
    public function changePass(){
        return view('Auth.changepassword');
    }
    
    public function authPass(Request $request){
        $user = User::find(Auth::user()->id);
            if(trim($request->newPass) == trim($request->confirmPass)){
                if(Hash::check($request->oldPass, $user->password)){
                    $user->password = Hash::make($request->newPass);
                    $user->save();
                    return redirect()->back()->with('success', 'Password changed successfully');
                }else{
                    return redirect()->back()->with('error', 'Old password Not Validate');
                }
            }else{
                return redirect()->back()->with('error', 'Password Not confirmed');
            }
    }










}