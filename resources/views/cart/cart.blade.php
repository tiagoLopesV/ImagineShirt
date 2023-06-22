@extends('template.layout')

@section('titulo', 'Carrinho de Compras')

@section('subtitulo')
    <h2>Carrinho de Compras</h2>
@endsection

@section('main')
    <div>
        <h2>hello world</h2>
        @if(count($productIds) > 0)
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productIds as $index => $productId)
                        <tr>
                            <td>{{ $names[$index] }}</td>
                            <td>{{ $quantities[$index] }}</td>
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
