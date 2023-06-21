<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
//use App\Models\Product;

class CartController extends Controller
{
    public function show()
    {
        // Recebe o carrinho do user
        $user = Auth::user();
        $cart = $user->cart;

        // Retrieve the cart items
        $cartItems = $cart ? $cart->items : [];

        return view('cart.cart', compact('cartItems'));
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $cart = $user->cart;

        $product = Product::findOrFail($request->product_id);

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
            $cart->items()->save($cartItem);
        }

        return redirect()->route('cart.show')->with('success', 'Item added to cart successfully.');
    }

    /*
    public function removeItem(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
        ]);

        $user = Auth::user();
        $cart = $user->cart;

        $cartItem = CartItem::findOrFail($request->item_id);

        if ($cartItem->cart_id != $cart->id) {
            abort(403, 'Unauthorized action.');
        }

        $cartItem->delete();

        return redirect()->route('cart.show')->with('success', 'Item removed from cart successfully.');
    }
    */

}