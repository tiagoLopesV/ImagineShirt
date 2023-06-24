<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Http\Requests\PlaceOrderRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Mail\SendOrderConfirmation;
use Illuminate\Support\Facades\Mail;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;

use App\Http\Controllers\Controller;

use PDF;


class OrderController extends Controller
{
    public function placeOrder(PlaceOrderRequest $request)
    {

        $user = Auth::user();
    
        $validatedData = $request->validated();

        $lastOrder = Order::latest()->first();
        $orderId = $lastOrder ? $lastOrder->id + 1 : 1;
    

        $order = new Order();
        $order->status = 'pending';
        $order->customer_id = $user->id;
        $order->date = now()->toDateString();
        $order->total_price = 0;
    

        $order->nif = $validatedData['nif'];
        $order->address = $validatedData['address'];
        $order->payment_type = $validatedData['payType'];
        $order->payment_ref = $validatedData['payRef'];
    
   
        $order->save();
    
        // Generate the PDF
        $pdf = PDF::loadView('order.pdfFile', ['order' => $order, 'cartItems' => session('cartItems', [])]);
        $pdfPath = public_path('storage/orders/' . $orderId . '.pdf');
    
        // Save the PDF file
        $pdf->save($pdfPath);
    
        return view('order.orderConfirmation', ['orderId' => $orderId]);
    }
    
    

    
    public function showConfirmation($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('order/orderConfirmation', ['orderId' => $orderId]);
    }
    



    public function view(Customer $customer): View
    {
        return view('order.order', compact('customer'));
    }
}
