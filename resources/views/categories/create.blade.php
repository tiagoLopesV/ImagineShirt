@extends('template.layout')

@section('titulo', 'Criar Categoria')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol>
@endsection

@section('main')

<form method="POST" action="{{ route('categories.store') }}">
        @csrf
       
        <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
     value="{{ old('name', $category->name) }}">
    <label for="inputName" class="form-label">Nome da Categoria</label>
    </div>

        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar nova categoria</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-3">Cancelar</a>
        </div>
    </form>
    
@endsection