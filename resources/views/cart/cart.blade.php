@extends('template.layout')

@section('titulo', 'Carrinho de Compras')

@section('subtitulo')
    <h2>Carrinho de Compras</h2>
@endsection

@section('main')
    <div>
        <h2>hello world</h2>
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
        @else
            <!-- Sem items -->
            <p>Nenhum item no carrinho</p>
        @endif
    </div>
@endsection
