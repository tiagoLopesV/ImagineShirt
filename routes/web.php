<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TshirtImageController;


Route::view('/', 'home')->name('root');

Auth::routes();

Route::resource('customers', CustomerController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::delete('user/{user}/foto', [UserController::class, 'destroy_photo'])->name('users.photo.destroy');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::resource('categories', CategoryController::class);

Route::resource('tshirt_images', TshirtImageController::class);

Route::resource('order', OrderController::class);

//Cart Routes**************************************************************************
//add item
Route::post('/cart/add-item', [CartController::class, 'addItem'])->name('cart.addItem');

//show
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');

//remove item
Route::delete('cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');



// Order Routes ***********************************************************************
// place order
Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

// confirm order
Route::get('/order/orderConfirmation/{orderId}', [OrderController::class, 'showConfirmation'])->name('order.confirmationOrder');

Route::match(['GET', 'POST'], '/order/view', [OrderController::class, 'view'])->name('order.view');

Route::get('order/downloadPDF/{orderId}', 'OrderController@downloadPDF')->name('order.downloadPDF');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('send/mail', [SendMailController::class, 'send_mail'])->name('send_mail');
