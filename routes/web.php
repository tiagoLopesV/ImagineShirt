<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;


Route::view('/', 'home')->name('root');

Auth::routes();

Route::resource('customer', CustomerController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('category', [CategoryController::class, 'show'])->name('categories.show');


//Cart Routes**************************************************************************
//add item
Route::post('/cart/add-item', [CartController::class, 'addItem'])->name('cart.addItem');

//show
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');

//remove item
Route::delete('cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');

//*************************************************************************************