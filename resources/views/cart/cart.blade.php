@extends('template.layout')

@section('titulo', 'Carrinho de Compras')

@section('subtitulo')
    <h2>Carrinho de Compras</h2>
@endsection

@section('main')
    <div>
        @if(isset($names))
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($names as $index => $name)
                        <tr>
                            <td>{{ $names[$index] }}</td>
                            <td>{{ $quantities[$index] }}</td>
                            <td>{{ $prices[$index] }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="deleteItem" value="{{ $names[$index] }}">
                                    <button type="submit" class="btn delete-button">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(Auth::check())
                <!-- Show the order button for authenticated user -->
                <form method="POST" action="{{ route('order.place') }}">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn order-button">Place Order</button>
                </form>
            @else
                <!-- Redirect non-authenticated user to register page -->
                <a href="{{ route('register') }}">Register</a> to place an order.
            @endif
        @else
            <!-- Sem items -->
            <p>Nenhum item no carrinho</p>
        @endif
    </div>
@endsection
