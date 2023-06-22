<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

use App\Models\TshirtImage;
use App\Models\Cart;
use App\Models\CartItem;

use Illuminate\Http\Request;
use App\Http\Requests\RemoveItemRequest;
//use App\Models\Product;

class CartController extends Controller
{
    public function show()
    {

        $user = Auth::user();
        $cart = $user->cart;

        // Retrieve the cart items
        $cartItems = session('cartItems', []);
    
        // If $cartItems is null, initialize it as an empty array
        if ($cartItems === null) {
            $cartItems = [];
        }
    
        // Extract the names, quantities, and prices from cart items
        $names = [];
        $quantities = [];
        $prices = [];

        foreach ($cartItems as $cartItem) {
            if (isset($cartItem['name'])) {
                $names[] = $cartItem['name'];
            }
            if (isset($cartItem['quantity'])) {
                $quantities[] = $cartItem['quantity'];
            }
            if (isset($cartItem['price'])) {
                $prices[] = $cartItem['price'];
            }
        }
    
        return view('cart.cart', compact('names', 'quantities', 'prices'));
    }
    
    

    

    public function addItem(Request $request)
    {
        $productId = $request->input('productId');
        $cartItems = session('cartItems', []);
        //$productName = '';
        
    
        // Check if item is already added to cart
        $itemExists = Arr::first($cartItems, function ($item) use ($productId) {
            return $item['productId'] == $productId;
        });

        $tshirtImage = TshirtImage::find($productId);
        $productName = $tshirtImage ? $tshirtImage->name : '';
        $price = 10;
    
        // If item exists, increment quantity
        if ($itemExists) {
            $quantity = $itemExists['quantity'] + 1;

            if($quantity >= 3){
                $price == 20;
            }

            $itemExists['quantity'] = $quantity;
            $itemExists['name'] = $productName;
            $itemExists['price'] = $price;
            
            

            // Find the index of the existing item in the cart array
            $index = array_search($itemExists, $cartItems);

            // Update the existing item in the cart array with the updated quantity
            $cartItems[$index] = $itemExists;
            
        } else { // If item doesn't exist, add it to the cart
            
    
            $itemExists = [
                'productId' => $productId,
                'name' => $productName,
                'quantity' => 1,
                'price' => 10,
            ];
            
        }

        $cartItems[] = $itemExists;
    
        // Store and update cart items
        session(['cartItems' => $cartItems]);

        return $this->show();;
    }
    

    public function removeItem(RemoveItemRequest $request)
    {
        $user = Auth::user();
        $cart = $user->cart;
    
        // Retrieve the cart items
        $cartItems = session('cartItems', []);
    
        // Find the cart item by name
        $cartItem = Arr::first($cartItems, function ($item) use ($request) {
            return $item['name'] == $request->deleteItem;
        });
    
        if (!$cartItem) {
            abort(404, 'Item not found in cart.');
        }
    
        // Remove the cart item from the cart items array
        $cartItems = array_filter($cartItems, function ($item) use ($request) {
            return $item['name'] !== $request->deleteItem;
        });
    
        // Store and update cart items
        session(['cartItems' => $cartItems]);
    
        return redirect()->route('cart.show');
    }
    
    
    

}