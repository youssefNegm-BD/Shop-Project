<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callback(){

        try{
            $googleUser = Socialite::driver('google')->user();
        $user =User::where('email',$googleUser->getEmail())->first();
        if($user){
            $user->update([
                'email_verified_at'=>now()
            ]);

        }else{
            $user = User::create([
                'name'=>$googleUser->getName(),
                'email' =>$googleUser->getEmail(),
                'password'=>Hash::make(str::random(10)),
                'email_verified_at'=>now()
            ]);

        }
        $token = $user->createToken('google-token')->plainTextToken;
        return response()->json([
            'status'=>'success',
            'message'=>'User Logged in successfully',
            'user'=>$user,
            'token'=>$token 
        ]);
    } catch(\Exception $e){
        return response()->json([
            'erorr'=>'login Failed:' . $e->getMessage()
        ],500);
    }
        

    }
}
