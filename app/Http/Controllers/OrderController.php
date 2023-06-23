<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlaceOrderRequest;

use Illuminate\Support\Facades\Auth;

use App\Models\Order;

class OrderController extends Controller
{    
    public function placeOrder(PlaceOrderRequest $request)
    {
        //$validatedData = $request->validated();

        // If the validation fails, redirect back with the errors
        if ($request->fails()) {
            return redirect()->back()->withErrors($request->errors())->withInput();
        }
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated
    
            // Validate the input
            $request->validate([
                'nif' => 'required|digits:9',
                'payment_method' => 'required',
                'address' => 'required',
            ]);
    
            // Process the order
            // Add your order processing logic here
    
            // Example: Create an order in the database
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->nif = $request->input('nif');
            $order->payment_method = $request->input('payment_method');
            $order->address = $request->input('address');
            $order->save();
    
            // Redirect to the order confirmation page
            return redirect()->route('order.confirmation', ['orderId' => $order->id]);
        } else {
            // User is not authenticated, redirect to register page
            return redirect()->route('register');
        }
    }

    public function showConfirmation()
    {
        // Retrieve necessary data for the order confirmation
        $order = Order::find($orderId); // Example: Retrieving order details from the database

        // Pass the data to the order confirmation view
        return view('order.confirmation', ['order' => $order]);
    }
    
}
