<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\AuthenticateController;




Route::get('/',[MainController::class ,'mainPage'])->name('homePage');
Route::get('/category',[MainController::class ,'category'])->name('categories');
Route::get('/review',[MainController::class ,'review'])->name('reviews');
Route::post('/storeReview',[MainController::class ,'storeReview'])->name('storeReview');
Route::post('/search',[MainController::class ,'search'])->name('search');
Route::get('/product/{category_id}', [ProductController::class,'GetCategoryProduct'])->name('singleProduct');
Route::get('/Allproducts',[ProductController::class,'Allproducts'])->name('products');

Route::middleware(['auth'])->group(function () {

    Route::middleware('admin')->group(function () {
        Route::get('/addproduct',[ProductController::class ,'addproduct'])->name('addProduct');
        Route::post('/storeproduct',[ProductController::class ,'storeproduct'])->name('storeProduct');
        Route::get('/editProduct/{id}',[ProductController::class ,'EditProduct'])->name('editProduct');
        Route::get('/deleteProduct/{id}',[ProductController::class ,'deleteProduct'])->name('deleteProduct');
    });
    Route::get('/profile',[AuthenticateController::class,'profile'])->name('profile');
    Route::post('updateProfile',[AuthenticateController::class,'updateProfile'])->name('updateProfile');
    Route::get('productList',[AuthenticateController::class,'productList'])->name('productList');
    Route::get('logout',[AuthenticateController::class,'logout'])->name('logout');
});

Route::group(['middleware'=>'guest'],function(){
        Route::get('/register',[AuthenticateController::class,'register'])->name('register');
        Route::post('/processRegister',[AuthenticateController::class,'processRegister'])->name('processRegister');
        Route::get('/login',[AuthenticateController::class,'login'])->name('login');
        Route::post('authenticate',[AuthenticateController::class,'authenticate'])->name('authenticate');

});




