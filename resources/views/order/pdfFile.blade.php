<div>
    <h1>Order Confirmation</h1>
    <!-- Add your order confirmation content here -->
    <p>Order ID: {{ $order->id }}</p>
    <p>Customer: {{ $order->customer_id }}</p>
    <p>Date: {{ $order->date }}</p>
    <!-- Include other order details -->

    <!-- You can also include a link to download the PDF directly -->
    <a href="{{ asset($pdfPath) }}" download>Download PDF</a>
</div>
