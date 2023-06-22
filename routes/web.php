<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CartController;


Route::view('/', 'home')->name('root');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('categorie', [CategorieController::class, 'show'])->name('categorie.show');

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');



//Cart Routes**************************************************************************
//add item
Route::post('/cart/add-item', [CartController::class, 'addItem'])->name('cart.addItem');

//remove item
Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');

//update quantity
Route::patch('/cart/update/{itemId}', [CartController::class, 'updateQuantity'])->name('cart.update');

//display cart
//Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

//Route::get('/cart', [CartController::class, 'addItem'])->name('cart');
//*************************************************************************************