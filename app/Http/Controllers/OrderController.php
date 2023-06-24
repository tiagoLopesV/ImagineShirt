<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Http\Requests\PlaceOrderRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;

use App\Http\Controllers\Controller;

use PDF;


class OrderController extends Controller
{
    public function placeOrder(PlaceOrderRequest $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();
    
        // Validate the input
        $validatedData = $request->validated();
    
        // Generate the incremented orderId
        $lastOrder = Order::latest()->first();
        $orderId = $lastOrder ? $lastOrder->id + 1 : 1;
    
        // Create a new order instance
        $order = new Order();
        $order->status = 'pending';
        $order->customer_id = $user->id;
        $order->date = now()->toDateString();
        $order->total_price = 0; // Set the initial total price as 0
    
        // Set the order details from the validated data
        $order->nif = $validatedData['nif'];
        $order->address = $validatedData['address'];
        $order->payment_type = $validatedData['payType'];
        $order->payment_ref = $validatedData['payRef'];
    
        // Save the order to the database
        $order->save();
        // Generate the PDF
        $pdf = PDF::loadView('order/pdfFile', ['order' => $order]);
        $pdfPath = public_path('storage/orders/' . $orderId . '.pdf');

        

        // Save the PDF file
        $pdf->save($pdfPath);

        $orderId = $order->id;
    
        // Redirect to the order confirmation page
        return view('order.orderConfirmation', ['orderId' => $orderId]);
    }
    

    // The showConfirmation method remains the same as in your previous code
    
    public function showConfirmation($orderId)
    {
        // Retrieve the order details from the database
        $order = Order::findOrFail($orderId);

        // Pass the order data to the confirmationOrder view
        return view('order/orderConfirmation', ['order' => $order]);
    }
    



    public function view(Customer $customer): View
    {
        return view('order.order', compact('customer'));
    }
}
