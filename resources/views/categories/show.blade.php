@extends('template.layout')

@section('titulo', 'Catalogo')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Catalogo</li>
    </ol>
@endsection

@section('main')
    <form method="GET" action="{{ route('categories.show') }}">
        <div class="d-flex justify-content-between">
            <div class="flex-grow-1 pe-2">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 mb-3 form-floating">
                        <select class="form-select" name="id" id="inputCategory">
                            <option {{ old('category', $filterByCategory) === '' ? 'selected' : '' }} value="">Todas as Categorias </option>
                            @foreach ($categories as $category)
                                <option {{ old('category', $filterByCategory) == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="inputCategory" class="form-label">Categoria</label>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="name" id="inputName"
                            value="{{ old('name', $filterByName) }}">
                        <label for="inputName" class="form-label">Nome</label>
                    </div>
                    <div class="mb-3 me-2 flex-grow-1 form-floating">
                        <input type="text" class="form-control" name="description" id="inputDescription"
                            value="{{ old('description', $filterByDescription) }}">
                        <label for="inputDescription" class="form-label">Descrição</label>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-1 d-flex flex-column justify-content-between">
                <button type="submit" class="btn btn-primary mb-3 px-4 flex-grow-1" name="filtrar">Filtrar</button>
                <a href="{{ route('categories.show') }}" class="btn btn-secondary mb-3 py-3 px-4 flex-shrink-1">Limpar</a>
            </div>
        </div>
    </form>
    @include('categories.shared.table', [
        'tshirtImages' => $tshirtImages,
    ])
    <div>
        {{ $tshirtImages->withQueryString()->links() }}
    </div>
@endsection
