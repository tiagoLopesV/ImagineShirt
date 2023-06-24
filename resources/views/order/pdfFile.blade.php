<!DOCTYPE html>
<html>
<body>
    <h1>Detalhes da Compra</h1>
    
    <p>Encomenda nº: {{ $order->id }}</p>
    <p>Estado: {{ $order->status }}</p>
    <p>Cliente nº: {{ $order->customer_id }}</p>
    <p>Data: {{ $order->date }}</p>
    <p>Total: {{ $order->total_price }}</p>
    <p>NIF: {{ $order->nif }}</p>
    <p>Morada: {{ $order->address }}</p>
    <p>Metodo de Pagamento: {{ $order->payment_type }}</p>
    <p>Referencia Pagamento: {{ $order->payment_ref }}</p>
    <p>Items</p>

    @foreach ($cartItems as $cartItem)
        <hr>
        <p>Produto: {{ $cartItem['name'] }}</p>
        <p>Quantidade: {{ $cartItem['quantity'] }}</p>
        <p>Preço: ${{ $cartItem['price'] }}</p>
        
    @endforeach
</body>
</html>
