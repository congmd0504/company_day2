<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('register', function(){
    return view('users.register');
})->name('register');
Route::get('login', function(){
    return view('users.login');
})->name('login');
Route::post('postRegister',[UserController::class,'postRegister'])->name('postRegister');
Route::post('postLogin',[UserController::class,'postLogin'])->name('postLogin');

Route::middleware(CheckLogin::class)->group(function () {
Route::resource('products', ProductController::class);
Route::resource('carts',CartController::class);
Route::resource('orders',OrderController::class);
Route::get('logout',[UserController::class,'logout'])->name('logout');
Route::get('history',[UserController::class,'history'])->name('history');
});


