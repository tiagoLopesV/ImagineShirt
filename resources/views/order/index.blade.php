@extends('template.layout')

@section('titulo', 'Encomendas')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Funcionarios / Administradores</li>
    </ol>
@endsection

@section('main')

    <form method="GET" action="{{ route('order.index') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="nif" id="inputNif"
                            value="{{ old('nif', $filterByNif) }}">
                        <label for="inputNif" class="form-label">Nif</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('order.index') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>

    @include('order.shared.table', [
        'orders' => $orders,
    ])
    <div>
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection