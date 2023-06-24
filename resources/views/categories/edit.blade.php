@extends('template.layout')

@section('titulo', 'Alterar Categoria')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol>
@endsection

@section('main')
<form id="form_category" novalidate class="needs-validation" method="POST"
        action="{{ route('categories.update', ['category' => $category]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3 form-floating">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
     value="{{ old('name', $category->name) }}">
    <label for="inputName" class="form-label">Nome da Categoria</label>
    </div>
        <div class="my-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary" name="ok">Guardar Alterações</button>
            <a href="{{ route('categories.edit', ['category' => $category]) }}"
                class="btn btn-secondary ms-3">Cancelar</a>
        </div>
        
    </form>
@endsection