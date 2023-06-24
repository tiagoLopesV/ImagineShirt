@extends('template.layout')

@section('titulo', 'Nova Imagem')

@section('subtitulo')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Criar Nova</li>
    </ol>
@endsection

@section('main')
    <form id="form_image" method="POST" action="{{ route('tshirt_images.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-column flex-sm-row justify-content-start align-items-start">
            <div class="flex-grow-1 pe-2">
                @include('tshirt_images.shared.fields', ['tshirt_image' => $tshirt_image, 'readonlyData' => false])
    <label for="inputCategory">Categoria</label>
        <select class="form-select" name="category_id" id="inputCategory">
     @foreach ($categories as $category)
                <option {{ old('category') == $category->id ? 'selected' : '' }}
            value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>
                <div class="my-1 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="ok" form="form_image">Guardar nova imagem</button>
                    <a href="{{ route('tshirt_images.create', ['tshirt_image' => $tshirt_image]) }}"
                        class="btn btn-secondary ms-3">Cancelar</a>
                </div>
            </div>
            <div class="ps-2 mt-5 mt-md-1 d-flex mx-auto flex-column align-items-center justify-content-between"
                style="min-width:260px; max-width:260px;">
                @include('tshirt_images/shared/fields_foto', [
                    'tshirt_image' => $tshirt_image,
                    'allowUpload' => true,
                ])
            </div>
        </div>
    </form>
@endsection
