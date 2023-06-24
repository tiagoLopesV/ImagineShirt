<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <style>
        /* Add your CSS styling for the PDF here */
    </style>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order. Here are the order details:</p>
    
    <!-- Display the order details from the $order variable -->
    <p>Order ID: {{ $order->id }}</p>
    <p>Status: {{ $order->status }}</p>
    <p>Customer ID: {{ $order->customer_id }}</p>
    <p>Date: {{ $order->date }}</p>
    <p>Total Price: {{ $order->total_price }}</p>
    <p>NIF: {{ $order->nif }}</p>
    <p>Address: {{ $order->address }}</p>
    <p>Payment Type: {{ $order->payment_type }}</p>
    <p>Payment Reference: {{ $order->payment_ref }}</p>
    
    <!-- Add any additional order details here -->
    
    <!-- You can include any other HTML content for the PDF -->
</body>
</html>
