@extends('template.layout')

@section('titulo', 'Carrinho de Compras')

@section('subtitulo')
    <h2>Carrinho de Compras</h2>

@section('main')
    <div>
        @if(count($cartItems) > 0)

            <ul>
                @foreach($cartItems as $item)
                    <li>{{ $item->name }}</li>
                @endforeach
            </ul>
        @else
            <!-- Sem items -->
            <p>Nenhum item no carrinho</p>
        @endif
    </div>
@endsection