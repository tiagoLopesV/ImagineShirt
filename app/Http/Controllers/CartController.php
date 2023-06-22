<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Arr;
use App\Models\TshirtImage;
//use App\Models\Product;

class CartController extends Controller
{
    public function show()
    {
        // Receives the user's cart
        $user = Auth::user();
        $cart = $user->cart;
    
        // Retrieve the cart items
        $cartItems = $cart ? $cart->items : [];
    
        // Extract the productId, name, and quantity from each cart item
        $productIds = array_column($cartItems, 'productId');
        $names = array_column($cartItems, 'name');
        $quantities = array_column($cartItems, 'quantity');
    
        return view('cart.cart', compact('productIds', 'names', 'quantities'));
    }
    

    

    public function addItem(Request $request)
    {
        $productId = $request->input('productId');
        $cartItems = session('cartItems', []);
        $productName = '';
        
    
        // Check if item is already added to cart
        $itemExists = Arr::first($cartItems, function ($item) use ($productId) {
            return $item['productId'] == $productId;
        });

        $tshirtImage = TshirtImage::find($productId);
        $productName = $tshirtImage ? $tshirtImage->name : '';
    
        // If item exists, increment quantity
        if ($itemExists) {
            $quantity = $itemExists['quantity'] + 1;
            $itemExists['quantity'] = $quantity;
            $itemExists['name'] = $productName;
            echo "Item já Existe!\n";
            echo "\nQuantidade: ";
            echo $itemExists['quantity'];
            // Find the index of the existing item in the cart array
            $index = array_search($itemExists, $cartItems);

            // Update the existing item in the cart array with the updated quantity
            $cartItems[$index] = $itemExists;
            
        } else { // If item doesn't exist, add it to the cart
            
    
            $itemExists = [
                'productId' => $productId,
                'name' => $productName,
                'quantity' => 1,
            ];
            
            echo "\nItem Não existe\n";
        }

        $cartItems[] = $itemExists;
    
        // Store and update cart items
        session(['cartItems' => $cartItems]);
        echo "\nID do produto: ";
        echo $productId;
        echo "\nID do produto: ";
        echo $productName;
        return redirect()->route('cart.show')->getTargetUrl();
    }
    
    
    

    
    public function removeItem(Request $request)
    {
        $request->validate(['item_id' => 'required|exists:cart_items,id',]);

        $user = Auth::user();
        $cart = $user->cart;

        $cartItem = CartItem::findOrFail($request->item_id);

        if ($cartItem->cart_id != $cart->id) {
            abort(403, 'Unauthorized action.');
        }

        $cartItem->delete();

        return redirect()->route('cart.show')->with('success', 'Item removed from cart successfully.');
    }
    

}